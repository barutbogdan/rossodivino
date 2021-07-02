<?php

namespace App\Admin\Controllers;

use App\Position;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use App\PositionCategory;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Encore\Admin\Controllers\ModelForm;

/**
 * Class PositionsController
 * @package App\Admin\Controllers
 */
class PositionsController extends Controller
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

            $content->header(trans('admin::lang.positions'));
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

            $content->header(trans('admin::lang.positions'));
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

            $content->header(trans('admin::lang.positions'));
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
        return Admin::grid(Position::class, function (Grid $grid) {

            $grid->model()->with('categories.translation');

            $grid->id('ID')->sortable();

            $grid->translation()->name(trans('admin::lang.name'))->value(function ($value) {
                return $value;
            });

            $grid->categories()->display(function ($categories) {
                return collect($categories)->map(function ($category) {
                    return sprintf(
                        '<span class="label label-success" style="margin-right: 5px;">%s</span>',
                        array_get($category, 'translation.name', '-')
                    );
                })->implode(' ');
            });

            $grid->order(trans('admin::lang.order'))->sortable();

            $grid->status(trans('admin::lang.status'))->value(function ($status) {
                return $status == Position::ENUM_ACTIVE ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
            })->sortable();

            $grid->created_at(trans('admin::lang.created_at'))->sortable();

            $grid->disableExport();
            $grid->disableRowSelector();

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->like('translation.name', trans('admin::lang.name'));
                $filter->is('status', trans('admin::lang.status'))->select([
                    Position::ENUM_ACTIVE   => trans('admin::lang.active'),
                    Position::ENUM_INACTIVE => trans('admin::lang.inactive')
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
        return Admin::form(Position::class, function (Form $form) {

            $form->hasManyTranslated('translations', function (Form\NestedForm $form) {
                $form->hidden('locale')->rules('required');
                $form->text('name', trans('admin::lang.name'));
                $form->textarea('short_description', trans('admin::lang.description'));
                $form->textarea('description', trans('admin::lang.requirements'))->help('Chaque élément doit être une nouvelle ligne.');;
            });

            $form->number('order', trans('admin::lang.order'));

            $form->multipleSelect('categories', trans('admin::lang.categories'))->options(
                PositionCategory::active()
                    ->translated()
                    ->withTranslation()
                    ->get()
                    ->pluck('translation.name', 'id')
                    ->toArray()
            );

            $form->switch('status', trans('admin::lang.status'))->states([
                'on'  => ['value' => Position::ENUM_ACTIVE],
                'off' => ['value' => Position::ENUM_INACTIVE]
            ]);
        });
    }
}
