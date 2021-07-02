<?php

namespace App\Admin\Controllers;

use Encore\Admin\Grid;
use Encore\Admin\Form;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use App\Modules\Mailer\EmailTemplate;
use Encore\Admin\Controllers\ModelForm;
use Waavi\Translation\Models\Language;


/**
 * Class EmailTemplateController
 *
 * @package App\Admin\Controllers
 */
class EmailTemplateController extends Controller
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

            $content->header(trans('admin::lang.email_templates'));
            $content->description(trans('admin::lang.view'));

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

            $content->header(trans('admin::lang.email_templates'));
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

            $content->header(trans('admin::lang.email_templates'));
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
        return Admin::grid(EmailTemplate::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->locale(trans('admin::lang.locale'))->sortable();
            $grid->template(trans('admin::lang.template'))->sortable();
            $grid->subject(trans('admin::lang.subject'))->sortable();
            $grid->from_name(trans('admin::lang.sender_name'))->sortable();
            $grid->from_address(trans('admin::lang.sender_address'))->sortable();

            $grid->updated_at(trans('admin::lang.updated_at'))->sortable();

            $grid->extend(trans('admin::lang.extend_layout'))->value(function ($extended) {
                return $extended === EmailTemplate::EXTEND_ON ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
            })->sortable();

            $grid->status(trans('admin::lang.status'))->value(function ($status) {
                return $status === EmailTemplate::STATUS_ON ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
            })->sortable();

            $grid->filter(function ($filter) {

                $filter->like('template', trans('admin::lang.template'));
                $filter->like('subject', trans('admin::lang.subject'));

                $filter->is('extend', trans('admin::lang.extend_layout'))->select([
                    EmailTemplate::EXTEND_ON => trans('admin::lang.yes'),
                    EmailTemplate::EXTEND_OFF => trans('admin::lang.no')
                ]);

                $filter->is('status', trans('admin::lang.status'))->select([
                    EmailTemplate::STATUS_ON => trans('admin::lang.active'),
                    EmailTemplate::STATUS_OFF => trans('admin::lang.inactive')
                ]);
            });

            $grid->disableRowSelector();
            $grid->disableBatchDeletion();
            $grid->disableExport();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(EmailTemplate::class, function (Form $form) {

            $form->select('locale')->options(Language::all()->pluck('locale', 'locale'))->rules('required');

            $form->text('template', trans('admin::lang.template'))->rules('required');
            $form->text('subject', trans('admin::lang.subject'))->rules('required');
            $form->text('from_name', trans('admin::lang.sender_name'));
            $form->text('from_address', trans('admin::lang.sender_address'));

            $form->switch('extend', trans('admin::lang.extend_layout'))->states([
                'on' => ['value' => EmailTemplate::EXTEND_ON],
                'off' => ['value' => EmailTemplate::EXTEND_OFF]
            ]);

            $form->switch('status', trans('admin::lang.status'))->states([
                'on' => ['value' => EmailTemplate::STATUS_ON],
                'off' => ['value' => EmailTemplate::STATUS_OFF]
            ]);

            $form->textarea('content', trans('admin::lang.content'));

            $form->display('created_at', trans('admin::lang.created_at'));
            $form->display('updated_at', trans('admin::lang.updated_at'));
        });
    }
}
