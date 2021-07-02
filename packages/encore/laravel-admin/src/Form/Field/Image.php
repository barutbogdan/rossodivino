<?php

namespace Encore\Admin\Form\Field;

use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Image extends File
{
    use ImageField;

    /**
     * {@inheritdoc}
     */
    protected $view = 'admin::form.file';

    /**
     *  Validation rules.
     *
     * @var string
     */
    protected $rules = 'image';

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
        $this->name = $this->getStoreName($image);
        Log::debug($this->name);

        $this->overwriteCallInterventionMethods();

        $this->callInterventionMethods($image->getRealPath());

        return $this->uploadAndDeleteOriginal($image);
    }

    /**
     * @return void
     */
    private function overwriteCallInterventionMethods()
    {

        $cropped_image_options = request()->get('cropped_image');

        if (empty($cropped_image_options)) {
            return;
        }

        $crop_options = json_decode($cropped_image_options, true);

        if (empty($crop_options) || !is_array($crop_options)) {
            return;
        }

        try {

            foreach ($this->interventionCalls as $k => $call) {
                if (in_array($call['method'], ['crop', 'rotate'])) {
                    unset($this->interventionCalls[$k]);
                }
            }

//            $this->rotate(
//                floatval($crop_options['rotate'])
//            );

            $this->crop(
                intval($crop_options['width']),
                intval($crop_options['height']),
                intval($crop_options['x']),
                intval($crop_options['y'])
            );

        } catch (\Throwable $e) {

            Log::error('overwriteCallInterventionMethods', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString()
            ]);
        }
    }
}
