<?php

namespace App\Admin\Controllers;

use App\Slide;
use App\Locale;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Waavi\Translation\Models\Language;

/**
 * Class RealisationsController
 *
 * @package App\Admin\Controllers
 */
class SlidesController extends Controller
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

            $content->header(trans('admin::lang.slides'));
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

            $content->header(trans('admin::lang.slides'));
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

            $content->header(trans('admin::lang.slides'));
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
        return Admin::grid(Slide::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->translation()->name(trans('admin::lang.name'))->value(function ($value) {
                return $value;
            });

            $grid->translation()->description(trans('admin::lang.description'))->value(function ($value) {
                return $value;
            });

            $grid->order(trans('admin::lang.order'))->sortable();

            $grid->image(trans('admin::lang.image'))->value(function ($image) {
                if (empty($image)) {
                    return trans('admin::lang.no_image_found');
                }
                return sprintf("<img src='%s' height='100px'>", asset('upload') . DIRECTORY_SEPARATOR . $image);
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
        return Admin::form(Slide::class, function (Form $form) {

            $form->hasManyTranslated('translations', function (Form\NestedForm $form) {
                $form->hidden('locale')->rules('required');
                $form->text('name', trans('admin::lang.name'))->rules('required');
                $form->textarea('description', trans('admin::lang.description'));
            });

            $form->slimImage('image', trans('admin::lang.image'))
                ->dir($dir = 'slides/')
                ->formName()
                ->options([
                    'minSize' => [
                        'width' => '1920',
                        'height' => '750'
                    ],
                ])
                ->help(trans('admin::lang.image_size_of', [
                    'size' => '1920 x 750'
                ]));

            $form->number('order', trans('admin::lang.order'));

            $form->switch('status', trans('admin::lang.status'))->states([
                'on'  => ['value' => Slide::STATUS_ON],
                'off' => ['value' => Slide::STATUS_OFF]
            ]);
        });
    }
}
