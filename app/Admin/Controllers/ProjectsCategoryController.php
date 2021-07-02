<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use App\ProjectCategory;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

/**
 * Class ProjectsCategoryController
 * @package App\Admin\Controllers
 */
class ProjectsCategoryController extends Controller
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

            $content->header(trans('admin::lang.project_categories'));
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

            $content->header(trans('admin::lang.project_categories'));
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

            $content->header(trans('admin::lang.project_categories'));
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
        return Admin::grid(ProjectCategory::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->translation()->name(trans('admin::lang.name'))->value(function ($value) {
                return $value;
            });

            $grid->order(trans('admin::lang.order'))->sortable();

            $grid->status(trans('admin::lang.status'))->value(function ($value) {
                return $value == ProjectCategory::ENUM_ACTIVE ? trans('admin::lang.active') : trans('admin::lang.inactive');
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
        return Admin::form(ProjectCategory::class, function (Form $form) {

            $form->hasManyTranslated('translations', function(Form\NestedForm $form) {
                $form->hidden('locale')->rules('required');
                $form->text('name', trans('admin::lang.name'));
            });

            $form->number('order', trans('admin::lang.order'));

            $form->switch('status', trans('admin::lang.status'))->states([
                'on'  => ['value' => ProjectCategory::ENUM_ACTIVE],
                'off' => ['value' => ProjectCategory::ENUM_INACTIVE]
            ]);
        });
    }
}
