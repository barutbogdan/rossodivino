<?php

namespace App\Admin\Controllers;

use App\Team;
use App\TeamCategory;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

/**
 * Class TeamController
 * @package App\Admin\Controllers
 */
class TeamController extends Controller
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

            $content->header(trans('admin::lang.team'));
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

            $content->header(trans('admin::lang.team'));
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

            $content->header(trans('admin::lang.team'));
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
        return Admin::grid(Team::class, function (Grid $grid) {

            $grid->model()->with('categories.translation');

            $grid->id('ID')->sortable();

            $grid->image(trans('admin::lang.image'))->value(function ($image) {
                if (empty($image)) {
                    return trans('admin::lang.no_image_found');
                }
                return sprintf("<img src='%s' height='50px'>", asset('upload') . DIRECTORY_SEPARATOR . $image);
            });

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

            $grid->is_home(trans('admin::lang.is_home'))->value(function ($status) {
                return $status ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
            })->sortable();

            $grid->is_about_us(trans('admin::lang.is_about_us'))->value(function ($status) {
                return $status ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
            })->sortable();

            $grid->status(trans('admin::lang.status'))->value(function ($status) {
                return $status == Team::ENUM_ACTIVE ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
            })->sortable();

            $grid->created_at(trans('admin::lang.created_at'))->sortable();

            $grid->disableExport();
            $grid->disableRowSelector();

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->like('translation.name', trans('admin::lang.name'));
                $filter->is('status', trans('admin::lang.status'))->select([
                    Team::ENUM_ACTIVE   => trans('admin::lang.active'),
                    Team::ENUM_INACTIVE => trans('admin::lang.inactive')
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
        return Admin::form(Team::class, function (Form $form) {

            $form->hasManyTranslated('translations', function (Form\NestedForm $form) {
                $form->hidden('locale')->rules('required');
                $form->text('name', trans('admin::lang.name'));
                $form->text('position', trans('admin::lang.position'));
                $form->textarea('short_description', trans('admin::lang.short_description'));
            });

            $form->number('order', trans('admin::lang.order'));

            $form->multipleSelect('categories', trans('admin::lang.categories'))->options(
                TeamCategory::active()
                    ->translated()
                    ->withTranslation()
                    ->get()
                    ->pluck('translation.name', 'id')
                    ->toArray()
            );
            $form->slimImage('image', trans('admin::lang.image'))
            ->dir($dir = 'team/')
            ->options([
                'minSize' => [
                    'width' => '270',
                    'height' => '480'
                ],
            ])
            ->help(trans('admin::lang.image_size_of', [
                'size' => '270 x 480'
            ]));

            $form->switch('is_home', trans('admin::lang.is_home'))->states([
                'on'  => ['value' => 1],
                'off' => ['value' => 0],
            ]);

            $form->switch('is_about_us', trans('admin::lang.is_about_us'))->states([
                'on'  => ['value' => 1],
                'off' => ['value' => 0],
            ]);

            $form->switch('status', trans('admin::lang.status'))->states([
                'on'  => ['value' => Team::ENUM_ACTIVE],
                'off' => ['value' => Team::ENUM_INACTIVE]
            ]);
        });
    }
}
