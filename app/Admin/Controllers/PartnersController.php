<?php

namespace App\Admin\Controllers;

use App\Slide;
use App\Partner;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Exception\NotWritableException;
use Intervention\Image\Facades\Image;
use Intervention\Image\Filters\DemoFilter;

/**
 * Class PartnersController
 *
 * @package App\Admin\Controllers
 */
class PartnersController extends Controller
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

            $content->header(trans('admin::lang.partners'));
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

            $content->header(trans('admin::lang.partners'));
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

            $content->header(trans('admin::lang.partners'));
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
        return Admin::grid(Partner::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->name(trans('admin::lang.name'));
            $grid->link(trans('admin::lang.link'));

            $grid->icon(trans('admin::lang.icon'))->display(function($icon) {
                return $icon ?: '-';
            });

            $grid->image(trans('admin::lang.image'))->value(function($image) {
                if (empty($image)) {
                    return trans('admin::lang.no_image_found');
                }
                return sprintf("<img src='%s' width='50px'>", asset('upload') . DIRECTORY_SEPARATOR . $image);
            });

            $grid->order(trans('admin::lang.order'))->sortable();

            $grid->created_at()->sortable();

            $grid->status('Status')->value(function ($status) {
                return $status ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
            })->sortable();

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
        return Admin::form(Partner::class, function (Form $form) {

            $form->text('name', trans('admin::lang.name'))->rules('required');
            $form->text('link', trans('admin::lang.link'));

            $form->file('image', trans('admin::lang.image'));

            $form->textarea('icon', trans('admin::lang.icon'));

            $form->number('order', trans('admin::lang.order'));

            $form->switch('status', trans('admin::lang.status'))->states([
                'on' => ['value' => Partner::STATUS_ON],
                'off' =>  ['value' => Partner::STATUS_OFF]
            ]);
        });
    }
}
