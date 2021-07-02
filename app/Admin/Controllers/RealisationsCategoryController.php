<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use App\RealisationCategory;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\ServiceCategory;

/**
 * Class RealisationsCategoryController
 * @package App\Admin\Controllers
 */
class RealisationsCategoryController extends Controller
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

            $content->header(trans('admin::lang.realisation_categories'));
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

            $content->header(trans('admin::lang.realisation_categories'));
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

            $content->header(trans('admin::lang.realisation_categories'));
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
        return Admin::grid(RealisationCategory::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->translation()->name(trans('admin::lang.name'))->value(function ($value) {
                return $value;
            });

            $grid->order(trans('admin::lang.order'))->sortable();

            $grid->status(trans('admin::lang.status'))->value(function ($value) {
                return $value == RealisationCategory::ENUM_ACTIVE ? trans('admin::lang.active') : trans('admin::lang.inactive');
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
        return Admin::form(RealisationCategory::class, function (Form $form) {

            $form->hasManyTranslated('translations', function (Form\NestedForm $form) {
                $form->hidden('locale')->rules('required');
                $form->text('name', trans('admin::lang.name'));
                $form->text('short_description', trans('admin::lang.short_description'));
            });

            $form->select('service_category_id', trans('admin::lang.service-category'))
                ->options(function () {
                    $returnCat = [];

                    $categories = ServiceCategory::active()
                        ->translated()
                        ->withTranslation()
                        ->orderBy('order')
                        ->get(); 

                    foreach($categories as $category) {
                        $returnCat[$category->id] = $category->getTranslation()->name;
                    }
                    
                    return $returnCat;
                });

            $form->number('order', trans('admin::lang.order'));

            $form->switch('status', trans('admin::lang.status'))->states([
                'on'  => ['value' => RealisationCategory::ENUM_ACTIVE],
                'off' => ['value' => RealisationCategory::ENUM_INACTIVE]
            ]);
        });
    }
}
