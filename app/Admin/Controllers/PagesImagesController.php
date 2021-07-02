<?php

namespace App\Admin\Controllers;

use App\Page;
use App\PageImage;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\File;
use Encore\Admin\Controllers\ModelForm;

/**
 * Class PagesImagesController
 *
 * @package App\Admin\Controllers
 */
class PagesImagesController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @param Page $page
     * @return Content
     */
    public function index(Page $page)
    {
        return Admin::content(function (Content $content) use ($page) {

            $content->header(trans('admin::lang.pages_images') . ' - ' . $page->translation->name);
            $content->description(trans('admin::lang.list'));

            $content->body($this->grid($page));
        });
    }

    /**
     * Edit interface.
     *
     * @param Page $page
     * @param $id
     * @return Content
     */
    public function edit(Page $page, $id)
    {
        return Admin::content(function (Content $content) use ($page, $id) {

            $content->header(trans('admin::lang.pages_images') . ' - ' . $page->translation->name);
            $content->description(trans('admin::lang.edit'));

            $content->body($this->form($page)->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @param Page $page
     * @return Content
     */
    public function create(Page $page)
    {
        return Admin::content(function (Content $content) use ($page) {

            $content->header(trans('admin::lang.pages_images') . ' - ' . $page->translation->name);
            $content->description(trans('admin::lang.create'));

            $content->body($this->form($page));
        });
    }

    /**
     * Make a grid builder.
     *
     * @param Page $page
     * @return Grid
     */
    protected function grid(Page $page)
    {
        return Admin::grid(PageImage::class, function (Grid $grid) use ($page) {

            $grid->model()->where('page_id', $page->id);

            $grid->id('ID')->sortable();

            $grid->name(trans('admin::lang.name'))->value(function($value) {
                return $value;
            });

            $grid->file(trans('admin::lang.image'))->value(function($file) {

                if (empty($file)) {
                    return trans('admin::lang.no_image_found');
                }

                return sprintf("<img src='%s' height='50px'>", asset('upload') . DIRECTORY_SEPARATOR . $file);
            });

            $grid->order(trans('admin::lang.order'))->sortable();

            $grid->status(trans('admin::lang.status'))->value(function ($value) {
                return $value ? trans('admin::lang.active') : trans('admin::lang.inactive');
            });

            $grid->tools(function (Grid\Tools $tools) use ($page) {

                $tools->prepend(sprintf(
                    '<a class="btn btn-sm btn-primary" href="%s"><i class="fa fa-arrow-left"></i> %s</a>',
                    route('admin.content.pages.index'),
                    trans('admin::lang.back')
                ));

                $tools->disableRefreshButton();
            });

            $grid->created_at()->sortable();
            $grid->disableExport();
            $grid->disableRowSelector();
        });
    }

    /**
     * Make a form builder.
     *
     * @param Page $page
     * @return Form
     */
    protected function form(Page $page)
    {
        return Admin::form(PageImage::class, function (Form $form) use ($page) {

            $form->hidden('cropped_image')->default(null);

            $form->hidden('page_id')->value($page->getKey());
            
            $form->hasManyTranslated('translations', function (Form\NestedForm $form) {
                $form->hidden('locale')->rules('required');

                $form->text('name', trans('admin::lang.name'))->rules('required|max:255');
                $form->text('slug', trans('admin::lang.slug'));
            });

            $form->number('order', trans('admin::lang.order'));

            $form->switch('status', trans('admin::lang.status'))->states([
                'on' => ['value' => PageImage::STATUS_ON],
                'off' =>  ['value' => PageImage::STATUS_OFF]
            ]);

            $form->image('file', trans('admin::lang.image'))
                ->rules('required')
                ->dir($dir = 'pages/')
                ->options(['overwriteInitial' => false]);

            $form->hide(['cropped_image']);

            $form->preparing(function (Form $form) {

                $this->saveTranslationSlug($form);
            });

            $form->saved(function(Form $form) use ($page, $dir) {
                // dd($form);
                $this->moveUploadedImage($form, $dir, 'name', 'file');
                $this->saveCroppedImage($form, $dir, 'file');
            });
        });
    }

    public function show(Page $page, $id)
    {
        return $this->edit($page, $id);
    }

    public function store(Page $page)
    {
        return $this->form($page)->store();
    }

    public function update(Page $page, $id)
    {
        return $this->form($page)->update($id);
    }

    public function destroy(Page $page, $id)
    {
        if ($this->form($page)->destroy($id)) {
            return response()->json([
                'status'  => true,
                'message' => trans('admin::lang.delete_succeeded'),
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => trans('admin::lang.delete_failed'),
            ]);
        }
    }

}
