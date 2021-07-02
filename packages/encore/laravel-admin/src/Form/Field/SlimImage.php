<?php

namespace Encore\Admin\Form\Field;

use Illuminate\View\View;
use Illuminate\Support\Arr;
use Encore\Admin\Form\Field;
use Encore\Admin\Packages\Slim\Slim;
use Illuminate\Contracts\View\Factory;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class SlimImage
 * https://pqina.nl/slim/#docs
 * @package Encore\Admin\Form\Field
 */
class SlimImage extends Field
{
    use ImageField;
    use UploadField;

    /**
     * @var string
     */
    protected $rules = '';

    /**
     * @var bool
     */
    protected $useFormName = null;

    /**
     * {@inheritdoc}
     */
    protected $view = 'admin::form.slim_image';

    /**
     * @var array
     */
    protected static $css = [
        '/packages/admin/slim/css/slim.css?v=4.3.7',
    ];

    /**
     * @var array
     */
    protected static $js = [
        '/packages/admin/slim/js/slim.jquery.js?v=4.3.7',
    ];

    /**
     * Create a new File instance.
     *
     * @param string $column
     * @param array  $arguments
     */
    public function __construct($column, $arguments = [])
    {
        $this->initStorage();

        parent::__construct($column, $arguments);
    }

    /**
     * Use form name for store upload file.
     *
     * @param string $key
     * @return $this
     */
    public function formName(string $key = 'name')
    {
        $this->useFormName = $key;

        return $this;
    }
    /**
     * Default directory for file to upload.
     *
     * @return mixed
     */
    public function defaultDirectory()
    {
        return config('admin.upload.directory.file');
    }

    /**
     * Upload file and delete original file.
     *
     * @param $data
     * @return mixed
     */
    protected function uploadAndDeleteOriginal($data)
    {
        $target = rtrim($this->getDirectory(), '/') . '/' . $this->name;

        $this->destroy();

        $input = Arr::get($data, 'input.data');
        $content = Arr::get($data, 'output.data', $input);

        $this->storage->put($target, $content);

        $image = \Intervention\Image\Facades\Image::make(public_path('upload/' . $target));

        $image->fit(
            Arr::get($this->options, 'minSize.width', Arr::get($data, 'output.width')),
            Arr::get($this->options, 'minSize.height', Arr::get($data, 'output.height')),
            function ($constraint) {
                $constraint->upsize();
            }
        );

        $jpgContent = (string) $image->encode('jpg', 100);

        $newTarget = rtrim($this->getDirectory(), '/') . '/' . $image->filename . '.jpeg';

        $this->storage->put($newTarget, $jpgContent);

        return $newTarget;
    }

    /**
     * @param array|UploadedFile $image
     *
     * @return string
     */
    public function prepare($image)
    {
        if (request()->has(static::FILE_DELETE_FLAG)) {
            return $this->destroy();
        }

        if ($data = Slim::parseInput($image)) {

            $this->name = $this->getStoreName($data);

            return $this->uploadAndDeleteOriginal($data);
        }

        return $this->original;
    }

    /**
     * Get store name of upload file.
     *
     * @param array $data
     *
     * @return string
     */
    protected function getStoreName($data)
    {
        $name = Arr::get($data, 'output.name', Arr::get($data, 'input.name'));
        $extension = pathinfo($name, PATHINFO_EXTENSION);

        if ($this->useFormName) {
            return str_slug($this->getFormImageName($this->useFormName)) . '.' . $extension;
        }

        if ($this->useUniqueName) {
            return md5(uniqid()) . '.' . $extension;
        }

        if (is_callable($this->name)) {

            $callback = $this->name->bindTo($this);

            return call_user_func($callback, $data);
        }

        if (is_string($this->name)) {
            return $this->name;
        }

        return $name;
    }

    /**
     * @return $this
     */
    protected function preview()
    {
        if (!$this->value) {
            return null;
        }

        return rtrim(config('admin.upload.path'), '/') . '/' . trim($this->value, '/');
    }

    /**
     * @return $this
     */
    protected function setupPreview()
    {
        $this->variables['preview'] = $this->preview();

        return $this;
    }

    /**
     * Set default options form image field.
     *
     * @return void
     */
    protected function setupDefaultOptions()
    {
        $defaultOptions = [
            'download' => true,
            'saveInitialImage' => true,
            'defaultInputName' => $this->column,
            'label' => trans('admin::lang.choose_image'),
        ];

        $this->options($defaultOptions);
    }

    /**
     * Render file upload field.
     *
     * @return Factory|View
     */
    public function render()
    {
        $this->setupPreview();
        $this->setupDefaultOptions();

        $options = json_encode($this->options);

        $deleteUrl = $this->form->resource() . '/' . $this->form->model()->getKey();
        $creatingMode = $this->form->builder()->isMode('create') ? 1 : 0;
        $deleteConfirm = trans('admin::lang.delete_confirm');

        $deleteParams = json_encode([
            'key'                    => 0,
            $this->column            => '',
            static::FILE_DELETE_FLAG => '',
            '_token'                 => csrf_token(),
            '_method'                => 'PUT',
        ]);

        $this->script = <<<EOT

        var slimOptions = {$options};
        var creatingMode = $creatingMode;
        
        slimOptions.willRemove = function (data, remove) {
            
            if (creatingMode) {
                remove();
                return;
            }
            
            if (window.confirm("$deleteConfirm")) {
            
                $.ajax({
                    url: "$deleteUrl",
                    type: "POST",
                    data: $deleteParams,
                    success: function (response) {
                        remove();
                        toastr.success(response.message);
                    }
                });
            }
        };
        
        $(".slim{$this->getElementClassSelector()}").slim(slimOptions);
        
EOT;
        return parent::render();
    }

    /**
     * @param string $key
     * @return string
     */
    protected function getFormImageName(string $key = 'name')
    {
        $locale = config('app.locale');
        $fallback_locale = config('app.fallback_locale');

        $translations = $this->form->translations;

        if (empty($translations) || !is_array($translations)) {

            if ($name = $this->form->$key) {

                return implode(' ', [$name, $this->form->model()->id]);
            }

            return (string) $this->form->model()->id;
        }

        $name = array_reduce($translations, function ($initial, $translation) use ($key, $locale) {
            return $translation['locale'] == $locale ? $translation[$key] : $initial;
        });

        $fallback_name = array_reduce($translations, function ($initial, $translation) use ($key, $fallback_locale) {
            return $translation['locale'] == $fallback_locale ? $translation[$key] : $initial;
        });

        return implode(' ', array_filter([$name ?: $fallback_name, $this->form->model()->id]));
    }
}
