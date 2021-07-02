<?php

namespace App\Admin\Controllers;

use App\Realisation;
use App\RealisationImage;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\File;

/**
 * Class RealisationsImagesController
 *
 * @package App\Admin\Controllers
 */

class RealisationsImagesController extends Controller
{
    /**
     * Index interface.
     *
     * @param Realisation $realisation
     * @return Content
     */
    public function index(Realisation $realisation)
    {
        return Admin::content(function (Content $content) use ($realisation) {

            $content->header(trans('admin::lang.realisation_images') . ' - ' . $realisation->translation->name);
            $content->description(trans('admin::lang.list'));

            $content->body($this->grid($realisation));
        });
    }

    /**
     * Edit interface.
     *
     * @param Realisation $realisation
     * @param $id
     * @return Content
     */
    public function edit(Realisation $realisation, $id)
    {
        return Admin::content(function (Content $content) use ($realisation, $id) {

            $content->header(trans('admin::lang.realisation_images') . ' - ' . $realisation->translation->name);
            $content->description(trans('admin::lang.edit'));

            $content->body($this->form($realisation)->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @param Realisation $realisation
     * @return Content
     */
    public function create(Realisation $realisation)
    {
        return Admin::content(function (Content $content) use ($realisation) {

            $content->header(trans('admin::lang.realisation_images') . ' - ' . $realisation->translation->name);
            $content->description(trans('admin::lang.create'));

            $content->body($this->form($realisation));
        });
    }

    /**
     * Make a grid builder.
     *
     * @param Realisation $realisation
     * @return Grid
     */
    protected function grid(Realisation $realisation)
    {
        return Admin::grid(RealisationImage::class, function (Grid $grid) use ($realisation) {

            $grid->model()->where('realisation_id', $realisation->id);

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

            $grid->tools(function (Grid\Tools $tools) use ($realisation) {

                $tools->prepend(sprintf(
                    '<a class="btn btn-sm btn-primary" href="%s"><i class="fa fa-arrow-left"></i> %s</a>',
                    route('admin.content.realisations.index'),
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
     * @param Realisation $realisation
     * @return Form
     */
    protected function form(Realisation $realisation)
    {
        return Admin::form(RealisationImage::class, function (Form $form) use ($realisation) {

            $form->hidden('realisation_id')->value($realisation->getKey());
            $form->text('name', trans('admin::lang.name'))->rules('required|max:255');

            $form->number('order', trans('admin::lang.order'));

            $form->switch('status', trans('admin::lang.status'))->states([
                'on' => ['value' => RealisationImage::STATUS_ON],
                'off' =>  ['value' => RealisationImage::STATUS_OFF]
            ]);

            $form->slimImage('file', trans('admin::lang.image'))
                ->dir($dir = 'realisation/')
                ->formName()
                ->options([
                    'ratio' => '16:9',
                    'minSize' => [
                        'width' => '200',
                        'height' => '200'
                    ],
                ])
                ->help(trans('admin::lang.image_size_of', [
                    'size' => '200 x 200'
                ]));
        });
    }

    public function show(Realisation $realisation, $id)
    {
        return $this->edit($Rralisation, $id);
    }

    public function store(Realisation $realisation)
    {
        return $this->form($realisation)->store();
    }

    public function update(Realisation $realisation, $id)
    {
        return $this->form($realisation)->update($id);
    }

    public function destroy(Realisation $realisation, $id)
    {
        if ($this->form($realisation)->destroy($id)) {
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
