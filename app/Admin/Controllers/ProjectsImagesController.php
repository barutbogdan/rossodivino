<?php

namespace App\Admin\Controllers;

use App\Project;
use App\ProjectImage;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\File;

/**
 * Class ProjectsImagesController
 *
 * @package App\Admin\Controllers
 */
class ProjectsImagesController extends Controller
{
    /**
     * Index interface.
     *
     * @param Project $project
     * @return Content
     */
    public function index(Project $project)
    {
        return Admin::content(function (Content $content) use ($project) {

            $content->header(trans('admin::lang.projects_images') . ' - ' . $project->translation->name);
            $content->description(trans('admin::lang.list'));

            $content->body($this->grid($project));
        });
    }

    /**
     * Edit interface.
     *
     * @param Project $project
     * @param $id
     * @return Content
     */
    public function edit(Project $project, $id)
    {
        return Admin::content(function (Content $content) use ($project, $id) {

            $content->header(trans('admin::lang.projects_images') . ' - ' . $project->translation->name);
            $content->description(trans('admin::lang.edit'));

            $content->body($this->form($project)->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @param Project $project
     * @return Content
     */
    public function create(Project $project)
    {
        return Admin::content(function (Content $content) use ($project) {

            $content->header(trans('admin::lang.projects_images') . ' - ' . $project->translation->name);
            $content->description(trans('admin::lang.create'));

            $content->body($this->form($project));
        });
    }

    /**
     * Make a grid builder.
     *
     * @param Project $project
     * @return Grid
     */
    protected function grid(Project $project)
    {
        return Admin::grid(ProjectImage::class, function (Grid $grid) use ($project) {

            $grid->model()->where('project_id', $project->id);

            $grid->id('ID')->sortable();

            $grid->name(trans('admin::lang.name'))->value(function($value) {
                return $value;
            });

            $grid->file(trans('admin::lang.image'))->value(function($file) {

                if (empty($file)) {
                    return trans('admin::lang.no_image_found');
                }

                return sprintf("<img src='%s' height='50px'>", asset('upload') . DIRECTORY_SEPARATOR . $file);
            });

            $grid->order(trans('admin::lang.order'))->sortable();

            $grid->status(trans('admin::lang.status'))->value(function ($value) {
                return $value ? trans('admin::lang.active') : trans('admin::lang.inactive');
            });

            $grid->tools(function (Grid\Tools $tools) use ($project) {

                $tools->prepend(sprintf(
                    '<a class="btn btn-sm btn-primary" href="%s"><i class="fa fa-arrow-left"></i> %s</a>',
                    route('admin.content.projects.index'),
                    trans('admin::lang.back')
                ));

                $tools->disableRefreshButton();
            });

            $grid->created_at()->sortable();
            $grid->disableExport();
            $grid->disableRowSelector();
        });
    }

    /**
     * Make a form builder.
     *
     * @param Project $project
     * @return Form
     */
    protected function form(Project $project)
    {
        return Admin::form(ProjectImage::class, function (Form $form) use ($project) {

            $form->hidden('project_id')->value($project->getKey());
            $form->text('name', trans('admin::lang.name'))->rules('required|max:255');

            $form->number('order', trans('admin::lang.order'));

            $form->switch('status', trans('admin::lang.status'))->states([
                'on' => ['value' => ProjectImage::STATUS_ON],
                'off' =>  ['value' => ProjectImage::STATUS_OFF]
            ]);

            $form->slimImage('file', trans('admin::lang.image'))
                ->dir($dir = 'projects/')
                ->formName()
                ->options([
                    'ratio' => '16:9',
                    'minSize' => [
                        'width' => '1920',
                        'height' => '1080'
                    ],
                ])
                ->help(trans('admin::lang.image_size_of', [
                    'size' => '1920 x 1080'
                ]));
        });
    }

    public function show(Project $project, $id)
    {
        return $this->edit($project, $id);
    }

    public function store(Project $project)
    {
        return $this->form($project)->store();
    }

    public function update(Project $project, $id)
    {
        return $this->form($project)->update($id);
    }

    public function destroy(Project $project, $id)
    {
        if ($this->form($project)->destroy($id)) {
            return response()->json([
                'status'  => true,
                'message' => trans('admin::lang.delete_succeeded'),
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => trans('admin::lang.delete_failed'),
            ]);
        }
    }

}
