<?php

namespace Encore\Admin\Form\Field;

use Encore\Admin\Admin;
use Encore\Admin\Form;
use Illuminate\Support\Str;
use Encore\Admin\Form\Field;
use Encore\Admin\Form\NestedForm;
use Illuminate\Support\Facades\Validator;
use App\Packages\Localization\Facades\Localization;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasMany as Relation;

/**
 * Class HasManyTranslated
 * @package Encore\Admin\Form\Field
 */
class HasManyTranslated extends Field
{
    /**
     * Relation name.
     *
     * @var string
     */
    protected $relationName = '';

    /**
     * Form builder.
     *
     * @var \Closure
     */
    protected $builder = null;

    /**
     * Form data.
     *
     * @var array
     */
    protected $value = [];

    /**
     * View Mode.
     *
     * Supports `default` and `tab` currently.
     *
     * @var string
     */
    protected $viewMode = 'default';

    /**
     * Available views for HasMany field.
     *
     * @var array
     */
    protected $views = [
        'default' => 'admin::form.hasmany_tab_translated',
    ];

    /**
     * @var
     */
    private $translated_tabs;

    /**
     * Create a new HasMany field instance.
     *
     * @param $relationName
     * @param array $arguments
     */
    public function __construct($relationName, $arguments = [])
    {
        $this->relationName = $relationName;

        $this->column = $relationName;

        if (count($arguments) == 1) {
            $this->label = $this->formatLabel();
            $this->builder = $arguments[0];
        }

        if (count($arguments) == 2) {
            list($this->label, $this->builder) = $arguments;
        }

        $this->setTranslatedTabs($this->getLanguageTabs());
    }

    /**
     * Get validator for this field.
     *
     * @param array $input
     *
     * @return bool|Validator
     */
    public function getValidator(array $input)
    {
        if (!array_key_exists($this->column, $input)) {
            return false;
        }

        $input = array_only($input, $this->column);

        $form = $this->buildNestedForm($this->column, $this->builder);

        $rules = $attributes = [];

        /* @var Field $field */
        foreach ($form->fields() as $field) {
            if (!$fieldRules = $field->getRules()) {
                continue;
            }

            $column = $field->column();

            if (is_array($column)) {
                foreach ($column as $key => $name) {
                    $rules[$name . $key] = $fieldRules;
                }

                $this->resetInputKey($input, $column);
            } else {
                $rules[$column] = $fieldRules;
            }

            $attributes = array_merge(
                $attributes,
                $this->formatValidationAttribute($input, $field->label(), $column)
            );
        }

        array_forget($rules, NestedForm::REMOVE_FLAG_NAME);

        if (empty($rules)) {
            return false;
        }

        $newRules = [];

        foreach ($rules as $column => $rule) {
            foreach (array_keys($input[$this->column]) as $key) {
                $newRules["{$this->column}.$key.$column"] = $rule;
            }
        }

        return Validator::make($input, $newRules, [], $attributes);
    }

    /**
     * Format validation attributes.
     *
     * @param array $input
     * @param string $label
     * @param string $column
     *
     * @return array
     */
    protected function formatValidationAttribute($input, $label, $column)
    {
        $new = $attributes = [];

        if (is_array($column)) {
            foreach ($column as $index => $col) {
                $new[$col . $index] = $col;
            }
        }

        foreach (array_keys(array_dot($input)) as $key) {
            if (is_string($column)) {
                if (Str::endsWith($key, ".$column")) {
                    $attributes[$key] = $label;
                }
            } else {
                foreach ($new as $k => $val) {
                    if (Str::endsWith($key, ".$k")) {
                        $attributes[$key] = $label . "[$val]";
                    }
                }
            }
        }

        return $attributes;
    }

    /**
     * Reset input key for validation.
     *
     * @param array $input
     * @param array $column $column is the column name array set
     *
     * @return void.
     */
    protected function resetInputKey(array &$input, array $column)
    {
        /**
         * flip the column name array set.
         *
         * for example, for the DateRange, the column like as below
         *
         * ["start" => "created_at", "end" => "updated_at"]
         *
         * to:
         *
         * [ "created_at" => "start", "updated_at" => "end" ]
         */
        $column = array_flip($column);

        /**
         * $this->column is the inputs array's node name, default is the relation name.
         *
         * So... $input[$this->column] is the data of this column's inputs data
         *
         * in the HasMany relation, has many data/field set, $set is field set in the below
         */
        foreach ($input[$this->column] as $index => $set) {

            /*
             * foreach the field set to find the corresponding $column
             */
            foreach ($set as $name => $value) {
                /*
                 * if doesn't have column name, continue to the next loop
                 */
                if (!array_key_exists($name, $column)) {
                    continue;
                }

                /**
                 * example:  $newKey = created_atstart.
                 *
                 * Σ( ° △ °|||)︴
                 *
                 * I don't know why a form need range input? Only can imagine is for range search....
                 */
                $newKey = $name . $column[$name];

                /*
                 * set new key
                 */
                array_set($input, "{$this->column}.$index.$newKey", $value);
                /*
                 * forget the old key and value
                 */
                array_forget($input, "{$this->column}.$index.$name");
            }
        }
    }

    /**
     * Prepare input data for insert or update.
     *
     * @param array $input
     *
     * @return array
     */
    public function prepare($input)
    {
        $form = $this->buildNestedForm($this->column, $this->builder);

        return $form->setOriginal($this->original, $this->getKeyName())->prepare($input);
    }

    /**
     * Build a Nested form.
     *
     * @param string $column
     * @param \Closure $builder
     * @param null $key
     *
     * @param null $label
     * @return NestedForm
     */
    protected function buildNestedForm($column, \Closure $builder, $key = null, $label = null)
    {
        $form = new Form\NestedForm($column, $key, $label);

        $form->setForm($this->form);

        call_user_func($builder, $form);

        $form->hidden($this->getKeyName());

        $form->hidden(NestedForm::REMOVE_FLAG_NAME)->default(0)->addElementClass(NestedForm::REMOVE_FLAG_CLASS);

        return $form;
    }

    /**
     * Get the HasMany relation key name.
     *
     * @return string
     */
    protected function getKeyName()
    {
        if (is_null($this->form)) {
            return;
        }

        return $this->form->model()->{$this->relationName}()->getRelated()->getKeyName();
    }

    /**
     * @param $tabs
     */
    protected function setTranslatedTabs($tabs)
    {
        $this->translated_tabs = $tabs;
    }

    /**
     * @return array
     */
    protected function getTranslatedTabs()
    {
        return $this->translated_tabs;
    }

    /**
     * Set field label.
     *
     * @param $label
     *
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Build Nested form for related data.
     *
     * @throws \Exception
     *
     * @return array
     */
    protected function buildRelatedForms()
    {
        if (is_null($this->form)) {
            return [];
        }

        $model = $this->form->model();

        $relation = call_user_func([$model, $this->relationName]);

        if (!$relation instanceof Relation && !$relation instanceof MorphMany) {
            throw new \Exception('hasMany field must be a HasMany or MorphMany relation.');
        }

        $forms = [];

        /*
         * If redirect from `exception` or `validation error` page.
         *
         * Then get form data from session flash.
         *
         * Else get data from database.
         */

        if (!old($this->column) && !$this->value && $values = $this->getTranslatedTabs()) {
            foreach ($values as $key => $data) {
                $forms[$key] = $this->buildNestedForm(
                    $this->column,
                    $this->builder,
                    $key,
                    $data['label']
                )->fill($data['fill']);
            }
        } elseif ($values = old($this->column)) {

            $default_tabs = $this->getTranslatedTabs();

            foreach ($values as $key => $data) {

                if ($data[NestedForm::REMOVE_FLAG_NAME] == 1) {
                    continue;
                }

                $label = null;

                if (!empty($default_tabs[$key]['label'])) {
                    $label = $default_tabs[$key]['label'];
                }

                if (is_null($label)) {

                    foreach ($default_tabs as $tab_key => $tab_data) {

                        if ($tab_data['fill']['locale'] !== $data['locale']) {
                            continue;
                        }

                        $label = $tab_data['label'];
                    }
                }

                $forms[$key] = $this->buildNestedForm($this->column, $this->builder, $key, $label)->fill($data);
            }

        } else {

            $default_tabs = $this->getTranslatedTabs();

            foreach ($this->value as $k => $data) {

                $key = array_get($data, $relation->getRelated()->getKeyName());

                $label = null;

                foreach ($default_tabs as $tab_key => $tab_data) {

                    if ($tab_data['fill']['locale'] !== $data['locale']) {
                        continue;
                    }

                    $label = $tab_data['label'];

                    unset($default_tabs[$tab_key]);
                }

                $forms[$key] = $this->buildNestedForm($this->column, $this->builder, $key, $label)->fill($data);
            }

            foreach ($default_tabs as $key => $data) {
                $forms[$key] = $this->buildNestedForm($this->column, $this->builder, $key,
                    $data['label'])->fill($data['fill']);
            }
        }

        return $forms;
    }

    /**
     * Setup script for this field in different view mode.
     *
     * @param string $script
     *
     * @return void
     */
    protected function setupScript($script)
    {
        $method = 'setupScriptFor' . ucfirst(camel_case($this->viewMode)) . 'View';

        call_user_func([$this, $method], $script);
    }

    /**
     * Setup tab template script.
     *
     * @return void
     */
    protected function setupScriptForDefaultView()
    {
        $script = <<<EOT

if ($('.has-error').length) {
    $('.has-error').parent('.tab-pane').each(function () {
        var tabId = '#'+$(this).attr('id');
        $('li a[href="'+tabId+'"] i').removeClass('hide');
    });
    
    var first = $('.has-error:first').parent().attr('id');
    $('li a[href="#'+first+'"]').tab('show');
}

$(document).on('focus', '.js-ckeditor-field', function() {
    CKEDITOR.replace($(this).attr('id'));
});

EOT;

        Admin::script($script);
    }

    /**
     * Render the `HasMany` field.
     *
     * @throws \Exception
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        // specify a view to render.
        $this->view = $this->views[$this->viewMode];

        list($template, $script) = $this->buildNestedForm($this->column, $this->builder)
            ->getTemplateHtmlAndScript();

        $this->setupScript($script);

        $forms = $this->buildRelatedForms();

        return parent::render()->with([
            'forms'        => $this->reorderFormsByTranslatedTabs($forms),
            'template'     => $template,
            'relationName' => $this->relationName,
        ]);
    }

    /**
     * @return array
     */
    protected function getLanguageTabs(): array
    {
        $langs = Localization::getAcceptedLocales();

        $language_tabs = [];
        $index = 1;

        foreach ($langs as $prefix => $lang) {

            $language_tabs['new_' . $index] = [
                'fill'  => [
                    'locale' => $prefix,
                ],
                'label' => $lang['name']
            ];

            $index++;
        }

        return $language_tabs;
    }

    /**
     * @param $forms
     * @return array
     */
    protected function reorderFormsByTranslatedTabs($forms): array
    {
        $ordered = [];

        $tabs = $this->getLanguageTabs();

        foreach ($tabs as $tab) {

            foreach ($forms as $key => $form) {

                if ($tab['label'] !== $form->getLabel()) {
                   continue;
                }

                $ordered[$key] = $form;
            }
        }

        return $ordered;
    }
}