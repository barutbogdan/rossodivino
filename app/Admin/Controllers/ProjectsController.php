<?php

namespace App\Admin\Controllers;

use App\Project;
use App\ProjectCategory;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

/**
 * Class ProjectsController
 *
 * @package App\Admin\Controllers
 */
class ProjectsController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header(trans('admin::lang.projects'));
            $content->description(trans('admin::lang.list'));

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header(trans('admin::lang.projects'));
            $content->description(trans('admin::lang.edit'));

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header(trans('admin::lang.projects'));
            $content->description(trans('admin::lang.create'));

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Project::class, function (Grid $grid) {

            $grid->model()->with('categories.translation');

            $grid->id('ID')->sortable();

            $grid->translation()->name(trans('admin::lang.name'))->value(function($value) {
                return $value;
            });

            $grid->image(trans('admin::lang.image'))->value(function($image) {
                if (empty($image)) {
                    return trans('admin::lang.no_image_found');
                }
                return sprintf("<img src='%s' height='30px'>", asset('upload') . DIRECTORY_SEPARATOR . $image);
            });

            $grid->images(trans('admin::lang.gallery'))->value(function($images) {

                if (empty($images)) {
                    return trans('admin::lang.no_image_found');
                }

                $show = '';

                foreach ($images as $image) {
                    $show .= sprintf("<img style='margin: 5px' src='%s' height='30px'>", asset('upload') . DIRECTORY_SEPARATOR . $image['file']);
                }

                return $show;
            });

            $grid->categories()->display(function ($categories) {
                return collect($categories)->map(function($category) {
                    return sprintf(
                        '<span class="label label-success" style="margin-right: 5px;">%s</span>',
                        array_get($category,'translation.name', '-')
                    );
                })->implode(' ');
            });

            $grid->published_at(trans('admin::lang.date'));
            $grid->order(trans('admin::lang.order'))->sortable();

            $grid->status(trans('admin::lang.status'))->value(function ($value) {
                return $value ? trans('admin::lang.active') : trans('admin::lang.inactive');
            });

            $grid->actions(function(Grid\Displayers\Actions $actions) {
                $actions->prepend(sprintf(
                    '<a href="%s">%s</a>',
                    route('admin.content.projects.images.index', [
                        'project' => $actions->row->id
                    ]),
                    trans('admin::lang.gallery')
                ));
            });

            $grid->created_at()->sortable();
            $grid->disableExport();
            $grid->disableRowSelector();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Project::class, function (Form $form) {

            $form->hasManyTranslated('translations', function (Form\NestedForm $form) {
                $form->hidden('locale')->rules('required');
                $form->text('name', trans('admin::lang.name'))->rules('required');
                $form->text('slug', trans('admin::lang.slug'));
                $form->text('seo_title', trans('admin::lang.seo_title'));
                $form->text('seo_keywords', trans('admin::lang.seo_keywords'));
                $form->text('seo_description', trans('admin::lang.seo_description'));
                $form->text('author');
                $form->textarea('services')->help('Chaque élément doit être une nouvelle ligne.');
                $form->textarea('short_description', trans('admin::lang.short_description'));
                $form->editor('description', trans('admin::lang.description'));
            });

            $form->slimImage('image', trans('admin::lang.image'))
                ->dir($dir = 'projects/')
                ->formName()
                ->options([
                    'minSize' => [
                        'width' => '370',
                        'height' => '370'
                    ],
                ])
                ->help(trans('admin::lang.image_size_of', [
                    'size' => '370 x 370'
                ]));

            $form->date('published_at', trans('admin::lang.date'));

            $form->number('order', trans('admin::lang.order'));

            $form->multipleSelect('categories', trans('admin::lang.categories'))->options(
                ProjectCategory::active()
                    ->translated()
                    ->withTranslation()
                    ->get()
                    ->pluck('translation.name', 'id')
                    ->toArray()
            );

            $form->switch('status', trans('admin::lang.status'))->states([
                'on'  => ['value' => Project::STATUS_ON],
                'off' => ['value' => Project::STATUS_OFF]
            ]);

            $form->preparing(function (Form $form) {
                $this->saveTranslationSlug($form);
            });
        });
    }
}
