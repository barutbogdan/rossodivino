<?php

namespace App\Admin\Controllers;

use App\Testimonial;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

/**
 * Class TestimonialsController
 * @package App\Admin\Controllers
 */
class TestimonialsController extends Controller
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

            $content->header(trans('admin::lang.testimonials'));
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

            $content->header(trans('admin::lang.testimonials'));
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

            $content->header(trans('admin::lang.testimonials'));
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
        return Admin::grid(Testimonial::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->translation()->name(trans('admin::lang.name'))->value(function($value) {
                return $value;
            });

            $grid->translation()->profession(trans('admin::lang.location'))->value(function($value) {
                return $value;
            });

            $grid->translation()->description(trans('admin::lang.description'))->value(function($value) {
                return $value;
            });

            $grid->order(trans('admin::lang.order'))->sortable();

            $grid->created_at()->sortable();
            $grid->disableExport();
            $grid->disableRowSelector();

            $grid->filter(function(Grid\Filter $filter) {
                $filter->useModal();
                $filter->like('translation.name', trans('admin::lang.name'));
                $filter->like('translation.profession', trans('admin::lang.profession'));
                $filter->like('translation.description', trans('admin::lang.description'));
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
        return Admin::form(Testimonial::class, function (Form $form) {

            $form->hasManyTranslated('translations', function(Form\NestedForm $form) {
                $form->hidden('locale')->rules('required');
                $form->text('name', trans('admin::lang.name'));
                $form->textarea('profession', trans('admin::lang.location'));
                $form->editor('description', trans('admin::lang.description'));
            });
            
            $form->slimImage('image', trans('admin::lang.image'))
                ->dir($dir = 'testimonials/')
                ->formName()
                ->options([
                    'minSize' => [
                        'width' => '100',
                        'height' => '100'
                    ],
                ])
                ->help(trans('admin::lang.image_size_of', [
                    'size' => '100 x 100'
                ]));

            $form->number('order', trans('admin::lang.order'));

            $form->switch('status', trans('admin::lang.status'))->states([
                'on' => ['value' => Testimonial::STATUS_ON],
                'off' =>  ['value' => Testimonial::STATUS_OFF]
            ]);
        });
    }
}
