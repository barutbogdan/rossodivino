<?php

namespace App\Admin\Controllers;

use App\Page;

use App\PageTag;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Facades\Storage;
use Waavi\Translation\Models\Language;

class PageController extends Controller
{
    use ModelForm;

    protected $path = 'website/pages';

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header(trans('admin::lang.pages'));
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

            $content->header(trans('admin::lang.pages'));
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

            $content->header(trans('admin::lang.pages'));
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
        return Admin::grid(Page::class, function (Grid $grid) {

            $grid->model()->with('parent.translation');

            $grid->id('ID')->sortable();

            $grid->translation()->name(trans('admin::lang.name'))->sortable();

            $grid->tags()->value(function ($tags) {
                $result = '';
                foreach ($tags as $tag) {
                    $result .= '<span class="label label-success" style="margin-right: 5px;">' . $tag['name'] . '</span>';
                }
                return $result;
            });

            $grid->column('parent.translation', trans('admin::lang.parent'))->display(function ($translation) {
                return array_get($translation, 'name', '-');
            });

            $grid->order(trans('admin::lang.order'))->sortable();

            $grid->created_at(trans('admin::lang.created_at'))->sortable();

            $grid->is_searchable(trans('admin::lang.searchable'))->value(function ($status) {
                return '<i class="fa fa-' . array_get([1 => 'check', 0 => 'times'], $status) . '" style="color:' . array_get([1 => 'green', 0 => 'red'], $status) . '"></i>';
            })->sortable();

            $grid->status(trans('admin::lang.status'))->value(function ($status) {
                return '<i class="fa fa-' . array_get([Page::ENUM_ACTIVE => 'check', Page::ENUM_INACTIVE => 'times'], $status) . '" style="color:' . array_get([Page::ENUM_ACTIVE => 'green', Page::ENUM_INACTIVE => 'red'], $status) . '"></i>';
            })->sortable();

            $grid->disableExport();

            $grid->actions(function(Grid\Displayers\Actions $actions) {
                $actions->prepend(sprintf(
                    '<a href="%s">%s</a>',
                    route('admin.content.pages.images.index', [
                        'page' => $actions->row->id
                    ]),
                    trans('admin::lang.gallery')
                ));
            });

            $grid->filter(function (Grid\Filter $filter) {
                $filter->useModal();
                $filter->like('translation.name', trans('admin::lang.name'));
                $filter->is('status', trans('admin::lang.status'))->select([
                    'active'   => 'Active',
                    'inactive' => 'Inactive'
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
        return Admin::form(Page::class, function (Form $form) {

            $form->hasManyTranslated('translations', function (Form\NestedForm $form) {

                $form->hidden('locale')->rules('required');

                $form->text('name', trans('admin::lang.name'))->rules('required');
                $form->text('slug', trans('admin::lang.slug'));
                $form->text('seo_title', trans('admin::lang.seo_title'));
                $form->text('seo_keywords', trans('admin::lang.seo_keywords'));
                $form->text('seo_description', trans('admin::lang.seo_description'));

                $form->text('heading', trans('admin::lang.heading'));
                $form->text('link', trans('admin::lang.link'));

                $form->textarea('short_description', trans('admin::lang.short_description'));
                $form->editor('description', trans('admin::lang.description'));
            });

            $form->slimImage('image', trans('admin::lang.image'))
                ->dir($dir = 'pages/')
                ->formName()
                ->options()
                ->help(trans('admin::lang.image_size_of', [
                    'size' => '550 x 350'
                ]));

            $form->switch('is_searchable', trans('admin::lang.searchable'));

            $form->switch('status', trans('admin::lang.status'))->states([
                'on'  => ['value' => 'active'],
                'off' => ['value' => 'inactive'],
            ]);

            $form->number('order')->rules('integer|min:0');

            $form->select('parent_id', trans('admin::lang.parent'))->options(
                ['' => trans('admin::lang.none')] +
                Page::active()
                    ->translated()
                    ->withTranslation()
                    ->get()
                    ->pluck('translation.name', 'id')
                    ->toArray()
            );

            $form->multipleSelect('tags')->options(
                PageTag::all()->pluck('name', 'id')
            );

            $form->preparing(function (Form $form) {
                $this->saveTranslationSlug($form);
            });

            $form->saved(function(Form $form) {
                $form;
            });
        });
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
//         if (null !== $response = $this->guardAgainstHandlerPages($id)) {
//             return $response;
//         }

        if ($this->form()->destroy($id)) {
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

    /**
     * @param string $id
     * @return \Illuminate\Http\JsonResponse|null
     */
    protected function guardAgainstHandlerPages(string $id) {

        $handlers = Page::whereIn('id', explode(',', $id))
            ->whereNotNull('handler_controller')
            ->count();

        if (empty($handlers)) {
            return null;
        }

        return response()->json([
            'status'  => false,
            'message' => trans('admin::lang.handler_page_cannot_be_deleted'),
        ]);
    }
}
