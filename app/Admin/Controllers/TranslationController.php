<?php

namespace App\Admin\Controllers;

use Encore\Admin\Grid;
use Encore\Admin\Form;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Encore\Admin\Controllers\ModelForm;
use Waavi\Translation\Models\Language;
use Waavi\Translation\Models\Translation;

/**
 * Class TranslationsController
 *
 * @package App\Admin\Controllers
 */
class TranslationController extends Controller
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
            $content->header(trans('admin::lang.translations'));
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
            $content->header(trans('admin::lang.translations'));
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
            $content->header(trans('admin::lang.translations'));
            $content->description(trans('admin::lang.create'));
            $content->body($this->form());
        });
    }
    
    /**
     * Flush translations from cache.
     *
     * @return mixed
     */
    public function clearCache()
    {
        Artisan::call('translator:flush');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        
        return redirect()->back();
    }
    
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Translation::class, function (Grid $grid) {
            
            $grid->model()->orderBy('updated_at', 'desc');
            
            $grid->id()->sortable();
            $grid->locale()->sortable();
            $grid->namespace(trans('admin::lang.namespace'))->sortable();
            $grid->group(trans('admin::lang.group'))->sortable();
            $grid->item(trans('admin::lang.item'))->sortable();
            $grid->text(trans('admin::lang.text'))->value(function($value) {
                return str_limit($value, 70);
            });
                
                $grid->created_at(trans('admin::lang.created_at'))->sortable();
                $grid->updated_at(trans('admin::lang.updated_at'))->sortable();
                
                $grid->view('vendor.admin.grid.new.table');
                
                $grid->filter(function (Filter $filter) {
                    $filter->useModal();
                    $filter->like('locale');
                    $filter->like('namespace', trans('admin::lang.namespace'));
                    $filter->like('group', trans('admin::lang.group'));
                    $filter->like('item', trans('admin::lang.item'));
                    $filter->like('text', trans('admin::lang.text'));
                });
                    
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
        return Admin::form(Translation::class, function (Form $form) {
            $form->select('locale')->options(Language::all()->pluck('locale', 'locale'))->rules('required');
            $form->text('namespace', trans('admin::lang.namespace'))->rules('required')->default('*');
            $form->text('group', trans('admin::lang.group'))->rules('required');
            $form->text('item', trans('admin::lang.item'))->rules('required');
            $form->text('text', trans('admin::lang.text'))->rules('required');
        });
    }
}
