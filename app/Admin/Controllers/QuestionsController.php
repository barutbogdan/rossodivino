<?php

namespace App\Admin\Controllers;

use App\Page;

use App\PageTag;
use App\Question;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\ModelForm;

class QuestionsController extends Controller
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

            $content->header(trans('admin::lang.questions'));
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

            $content->header(trans('admin::lang.questions'));
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

            $content->header(trans('admin::lang.questions'));
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
        return Admin::grid(Question::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->translation()->name(trans('admin::lang.name'))->sortable();

            $grid->order(trans('admin::lang.order'))->sortable();

            $grid->created_at(trans('admin::lang.created_at'))->sortable();

            $grid->is_home(trans('admin::lang.is_home'))->value(function ($status) {
                return $status ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
            })->sortable();

            $grid->status(trans('admin::lang.status'))->value(function ($status) {
                return $status ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
            })->sortable();

            $grid->disableExport();
            $grid->disableRowSelector();

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->like('translation.name', trans('admin::lang.name'));
                $filter->is('status', trans('admin::lang.status'))->select([
                    Question::STATUS_ON => trans('admin::lang.active'),
                    Question::STATUS_OFF => trans('admin::lang.inactive')
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
        return Admin::form(Question::class, function (Form $form) {

            $form->hidden('translation.locale')->default(app()->getLocale())->rules('required');

            $form->text('translation.name', trans('admin::lang.name'))->rules('required');

            $form->switch('status', trans('admin::lang.status'))->states([
                'on'  => ['value' => Question::STATUS_ON],
                'off' => ['value' => Question::STATUS_OFF],
            ]);

            $form->switch('is_home', trans('admin::lang.is_home'))->states([
                'on'  => ['value' => Question::STATUS_ON],
                'off' => ['value' => Question::STATUS_OFF],
            ]);

            $form->number('order')->rules('integer|min:0');

            $form->textarea('translation.description', trans('admin::lang.description'));
        });
    }
}
