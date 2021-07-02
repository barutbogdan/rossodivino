<?php

namespace App\Admin\Controllers;

use App\Realisation;
use App\Service;
use App\ServiceCategory;
// use App\ServiceCategory;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Encore\Admin\Controllers\ModelForm;
use Waavi\Translation\Models\Language;

/**
 * Class ServicesController
 *
 * @package App\Admin\Controllers
 */
class ServicesController extends Controller
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

            $content->header(trans('admin::lang.services'));
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

            $content->header(trans('admin::lang.services'));
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

            $content->header(trans('admin::lang.services'));
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
        return Admin::grid(Service::class, function (Grid $grid) {

            $grid->model()->with('categories.translation');

            $grid->id('ID')->sortable();

            $grid->image(trans('admin::lang.image'))->value(function($image) {
                if (empty($image)) {
                    return trans('admin::lang.no_image_found');
                }
                return sprintf("<img src='%s' height='50px'>", asset('upload') . DIRECTORY_SEPARATOR . $image);
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

            $grid->footer_order(trans('admin::lang.footer_order'))->sortable();

            $grid->is_footer(trans('admin::lang.is_footer'))->value(function ($status) {
                return $status ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
            })->sortable();

            $grid->is_home(trans('admin::lang.is_home'))->value(function ($status) {
                return $status ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
            })->sortable();

            $grid->is_request(trans('admin::lang.is_request_service'))->value(function ($status) {
                return $status ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
            })->sortable();

            $grid->order(trans('admin::lang.order'))->sortable();

            $grid->status(trans('admin::lang.status'))->value(function ($status) {
                return $status ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
            })->sortable();

            $grid->created_at(trans('admin::lang.created_at'))->sortable();

            $grid->disableExport();
            $grid->disableRowSelector();

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->like('translation.name', trans('admin::lang.name'));
                $filter->is('status', trans('admin::lang.status'))->select([
                    Service::STATUS_ON => trans('admin::lang.active'),
                    Service::STATUS_OFF => trans('admin::lang.inactive')
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
        return Admin::form(Service::class, function (Form $form) {

            $form->hasManyTranslated('translations', function (Form\NestedForm $form) {
                $form->hidden('locale')->rules('required');
                $form->text('name', trans('admin::lang.name'))->rules('required');
                $form->text('slug', trans('admin::lang.slug'))->rules('required');
                $form->textarea('short_description', trans('admin::lang.short_description'));
                $form->textarea('description', trans('admin::lang.description'));
                $form->textarea('list', trans('admin::lang.list'))->help('Chaque élément doit être une nouvelle ligne.');
            });

            $form->multipleSelect('categories', trans('admin::lang.categories'))->options(
                ServiceCategory::active()
                    ->translated()
                    ->withTranslation()
                    ->get()
                    ->pluck('translation.name', 'id')
                    ->toArray()
            );
            
            $form->image('image', trans('admin::lang.image'))
                ->uniqueName()
                ->rules('required')
                ->dir($dir = 'realisations/');

            $form->number('footer_order', trans('admin::lang.footer_order'));

            $form->switch('is_home', trans('admin::lang.is_home'));

            $form->switch('is_footer', trans('admin::lang.is_footer'));

            $form->switch('is_request', trans('admin::lang.is_request_service'));

            $form->number('order', trans('admin::lang.order'));

            $form->switch('status', trans('admin::lang.status'))->states([
                'on' => ['value' => Service::STATUS_ON],
                'off' =>  ['value' => Service::STATUS_OFF]
            ]);
        });
    }
}
