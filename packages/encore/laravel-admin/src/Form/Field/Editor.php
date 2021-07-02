<?php

namespace Encore\Admin\Form\Field;

use Encore\Admin\Form\Field;

class Editor extends Field
{
    protected static $js = [
        '//cdn.ckeditor.com/4.5.10/full/ckeditor.js',
    ];

    public function render()
    {
        $column = str_replace('.', '_', $this->getErrorKey());

        $this->script = "CKEDITOR.config.allowedContent = true;if($('#{$column}').length) {CKEDITOR.replace('{$column}');}";

        return parent::render();
    }
}