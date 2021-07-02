<?php

namespace App\Admin\Controllers;

use App\Setting;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\Artisan;
use Encore\Admin\Controllers\ModelForm;

class SettingController extends Controller
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
            $content->header(trans('admin::lang.settings'));
            $content->description(trans('admin::lang.list'));
            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     *
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header(trans('admin::lang.settings'));
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
            $content->header(trans('admin::lang.settings'));
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
        return Admin::grid(Setting::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->key(trans('admin::lang.key'))->sortable();
            $grid->column('value', trans('admin::lang.value'))->sortable();

            $grid->status(trans('admin::lang.status'))->value(function ($status) {
                if ($status === 'active') {
                    return '<i class="fa fa-check" style="color: green"></i>';
                }
                return '<i class="fa fa-times" style="color: red"></i>';
            })->sortable();

            $grid->disableExport();
            $grid->disableRowSelector();
            $grid->disableBatchDeletion();

            $grid->actions(function(Grid\Displayers\Actions $actions) {
                $actions->disableDelete();
            });

            $grid->filter(function ($filter) {
                $filter->like('key', trans('admin::lang.key'));
                $filter->like('value', trans('admin::lang.value'));
                $filter->is('status', trans('admin::lang.status'))->select([
                    Setting::STATUS_ON => trans('admin::lang.active'),
                    Setting::STATUS_OFF => trans('admin::lang.inactive')
                ]);
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Setting::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('key', trans('admin::lang.key'))->rules('required');
            $form->textarea('value', trans('admin::lang.value'))->rules('required');

            $form->switch('status', trans('admin::lang.status'))->states([
                'on' => ['value' => Setting::STATUS_ON],
                'off' =>  ['value' => Setting::STATUS_OFF]
            ]);

            $form->display('created_at', trans('admin::lang.created_at'));
            $form->display('updated_at', trans('admin::lang.updated_at'));

            $form->saved(function() {
                Artisan::call('cache:clear');
            });
        });
    }
}
