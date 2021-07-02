<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use App\ArticleCategory;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

/**
 * Class ArticlesCategoryController
 * @package App\Admin\Controllers
 */
class ArticlesCategoryController extends Controller
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

            $content->header(trans('admin::lang.article_categories'));
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

            $content->header(trans('admin::lang.article_categories'));
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

            $content->header(trans('admin::lang.article_categories'));
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
        return Admin::grid(ArticleCategory::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->translation()->name(trans('admin::lang.name'))->value(function ($value) {
                return $value;
            });

            $grid->order(trans('admin::lang.order'))->sortable();

            $grid->status(trans('admin::lang.status'))->value(function ($value) {
                return $value == ArticleCategory::ENUM_ACTIVE ? trans('admin::lang.active') : trans('admin::lang.inactive');
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
        return Admin::form(ArticleCategory::class, function (Form $form) {

            $form->hasManyTranslated('translations', function(Form\NestedForm $form) {
                $form->hidden('locale')->rules('required');
                $form->text('name', trans('admin::lang.name'));
                $form->text('slug', trans('admin::lang.slug'));
                $form->text('seo_title', trans('admin::lang.seo_title'));
                $form->text('seo_keywords', trans('admin::lang.seo_keywords'));
                $form->text('seo_description', trans('admin::lang.seo_description'));
            });

            $form->number('order', trans('admin::lang.order'));

            $form->switch('status', trans('admin::lang.status'))->states([
                'on'  => ['value' => ArticleCategory::ENUM_ACTIVE],
                'off' => ['value' => ArticleCategory::ENUM_INACTIVE]
            ]);

            $form->preparing(function (Form $form) {
                $this->saveTranslationSlug($form);
            });
        });
    }
}
