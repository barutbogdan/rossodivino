<?php

namespace App\Admin\Controllers;

use App\Article;
use App\ArticleCategory;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

/**
 * Class ArticlesController
 * @package App\Admin\Controllers
 */
class ArticlesController extends Controller
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

            $content->header(trans('admin::lang.articles'));
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

            $content->header(trans('admin::lang.articles'));
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

            $content->header(trans('admin::lang.articles'));
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
        return Admin::grid(Article::class, function (Grid $grid) {

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

            $grid->order(trans('admin::lang.order'))->sortable();

            $grid->is_home(trans('admin::lang.is_home'))->value(function ($value) {
                return $value == Article::ENUM_ACTIVE ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
            })->sortable();

            $grid->is_boxes(trans('admin::lang.is_boxes'))->value(function ($value) {
                return $value ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
            })->sortable();

            $grid->status(trans('admin::lang.status'))->value(function ($status) {
                return $status == Article::ENUM_ACTIVE ? '<i class="fa fa-check" style="color: green"></i>' : '<i class="fa fa-times" style="color: red"></i>';
            })->sortable();

            $grid->created_at(trans('admin::lang.created_at'))->sortable();

            $grid->disableExport();
            $grid->disableRowSelector();

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->like('translation.name', trans('admin::lang.name'));
                $filter->is('status', trans('admin::lang.status'))->select([
                    Article::ENUM_ACTIVE   => trans('admin::lang.active'),
                    Article::ENUM_INACTIVE => trans('admin::lang.inactive')
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
        return Admin::form(Article::class, function (Form $form) {

            $form->hasManyTranslated('translations', function (Form\NestedForm $form) {

                $form->hidden('locale')->rules('required');

                $form->text('name', trans('admin::lang.name'));
                $form->text('slug', trans('admin::lang.slug'));
                $form->text('seo_title', trans('admin::lang.seo_title'));
                $form->text('seo_keywords', trans('admin::lang.seo_keywords'));
                $form->text('seo_description', trans('admin::lang.seo_description'));

                $form->textarea('short_description', trans('admin::lang.short_description'));
                $form->editor('description', trans('admin::lang.description'));
            });

            $form->multipleSelect('categories', trans('admin::lang.categories'))->options(
                ArticleCategory::active()
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
                    'width' => '370',
                    'height' => '250'
                ],
            ])
            ->help(trans('admin::lang.image_size_of', [
                'size' => '370 x 250'
            ]));
            
            $form->datetime('published_at', trans('admin::lang.published_at'))->rules('required');

            $form->number('order', trans('admin::lang.order'));

            $form->switch('is_home', trans('admin::lang.is_home'))->states([
                'on'  => ['value' => Article::ENUM_ACTIVE],
                'off' => ['value' => Article::ENUM_INACTIVE]
            ]);

            $form->switch('is_boxes', trans('admin::lang.is_boxes'));

            $form->switch('status', trans('admin::lang.status'))->states([
                'on'  => ['value' => Article::ENUM_ACTIVE],
                'off' => ['value' => Article::ENUM_INACTIVE]
            ]);

            $form->preparing(function (Form $form) {
                $this->saveTranslationSlug($form);
            });
        });
    }
}
