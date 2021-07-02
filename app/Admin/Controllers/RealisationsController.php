<?php

namespace App\Admin\Controllers;

use App\RealisationCategory;
use finfo;
use App\Realisation;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Class RealisationsController
 *
 * @package App\Admin\Controllers
 */

class RealisationsController extends Controller
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

            $content->header(trans('admin::lang.realisations'));
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

            $content->header(trans('admin::lang.realisations'));
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

            $content->header(trans('admin::lang.realisations'));
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
        return Admin::grid(Realisation::class, function (Grid $grid) {

            $grid->model()->with('categories.translation');

            $grid->id('ID')->sortable();

            $grid->image(trans('admin::lang.image'))->value(function($image) {
                if (empty($image)) {
                    return trans('admin::lang.no_image_found');
                }
                return sprintf("<img src='%s' height='100px'>", asset('upload') . DIRECTORY_SEPARATOR . $image);
            });

            $grid->translation()->name(trans('admin::lang.name'))->value(function($value) {
                return $value;
            });

            $grid->categories()->display(function ($categories) {
                return collect($categories)->map(function($category) {
                    return sprintf(
                        '<span class="label label-success" style="margin-right: 5px;">%s</span>',
                        array_get($category,'translation.name', '-')
                    );
                })->implode(' ');
            });

            $grid->actions(function(Grid\Displayers\Actions $actions) {
                $actions->prepend(sprintf(
                    '<a href="%s">%s</a>',
                    route('admin.content.realisations.images.index', [
                        'realisation' => $actions->row->id
                    ]),
                    trans('admin::lang.gallery')
                ));
            });

            $grid->order(trans('admin::lang.order'))->sortable();

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
        return Admin::form(Realisation::class, function (Form $form) {

            $form->hasManyTranslated('translations', function (Form\NestedForm $form) {
                $form->hidden('locale')->rules('required');
                $form->text('name', trans('admin::lang.name'));
                
                $form->textarea('short_description', trans('admin::lang.short_description'));
                $form->editor('description', trans('admin::lang.description'));
            });

            $form->image('image', trans('admin::lang.image'))
                ->uniqueName()
                ->rules('required')
                ->dir($dir = 'realisations/');

            $form->multipleSelect('categories', trans('admin::lang.categories'))->options(
                RealisationCategory::active()
                    ->translated()
                    ->withTranslation()
                    ->get()
                    ->pluck('translation.name', 'id')
                    ->toArray()
            );

            $form->number('order', trans('admin::lang.order'));

            $form->switch('status', trans('admin::lang.status'))->states([
                'on' => ['value' => Realisation::STATUS_ON],
                'off' =>  ['value' => Realisation::STATUS_OFF]
            ]);

            $form->saved(function(Form $form) use ($dir) {
                $this->moveUploadedImage($form, $dir);
            });
        });
    }
}
