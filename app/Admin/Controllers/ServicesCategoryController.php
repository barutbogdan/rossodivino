<?php

namespace App\Admin\Controllers;

use App\Page;
use App\ServiceCategory;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Waavi\Translation\Models\Language;

/**
 * Class ServicesCategoryController
 * @package App\Admin\Controllers
 */
class ServicesCategoryController extends Controller
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

            $content->header(trans('admin::lang.service_categories'));
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

            $content->header(trans('admin::lang.service_categories'));
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

            $content->header(trans('admin::lang.service_categories'));
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
        return Admin::grid(ServiceCategory::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->image(trans('admin::lang.icon'))->display(function($icon) {
                return Controller::displayImage($icon);
            });

            $grid->translation()->name(trans('admin::lang.name'))->value(function ($value) {
                return $value;
            });

            $grid->order(trans('admin::lang.order'))->sortable();
            $grid->order_home(trans('admin::lang.order_home'))->sortable();

            $grid->status(trans('admin::lang.status'))->value(function ($value) {
                return $value == ServiceCategory::ENUM_ACTIVE ? trans('admin::lang.active') : trans('admin::lang.inactive');
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
        return Admin::form(ServiceCategory::class, function (Form $form) {

            $form->hasManyTranslated('translations', function(Form\NestedForm $form) {

                $form->hidden('locale')->rules('required');

                $form->text('name', trans('admin::lang.name'));
                $form->text('slug', trans('admin::lang.slug'));
                $form->text('seo_title', trans('admin::lang.seo_title'));
                $form->text('seo_keywords', trans('admin::lang.seo_keywords'));
                $form->text('seo_description', trans('admin::lang.seo_description'));

                $form->textarea('short_description', trans('admin::lang.short_description'));
                $form->editor('description', trans('admin::lang.description'));
            });

            $form->image('image', trans('admin::lang.icon'))
                ->dir($dir = 'services/icons/')
                ->help(trans('admin::lang.image_size_of', ['size' => '42 x 42']))
                ->uniqueName();

            $form->number('order', trans('admin::lang.order'));
            $form->number('order_home', trans('admin::lang.order_home'));

            $form->switch('is_home', trans('admin::lang.is_home'))->states([
                'on'  => ['value' => 'active'],
                'off' => ['value' => 'inactive'],
            ]);

            $form->select('page_id', trans('admin::lang.menu'))->options(
                ['' => trans('admin::lang.none')] +
                Page::active()
                    ->translated()
                    ->withTranslation()
                    ->get()
                    ->pluck('translation.name', 'id')
                    ->toArray()
            );

            $form->switch('status', trans('admin::lang.status'))->states([
                'on'  => ['value' => ServiceCategory::ENUM_ACTIVE],
                'off' => ['value' => ServiceCategory::ENUM_INACTIVE]
            ]);

            $form->preparing(function (Form $form) {
                $this->saveTranslationSlug($form);
            });

            $form->saved(function (Form $form) use ($dir) {
                $this->moveUploadedImage($form, $dir);
            });
        });
    }
}
