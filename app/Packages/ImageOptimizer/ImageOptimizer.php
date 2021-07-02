<?php

namespace App\Packages\ImageOptimizer;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Class ImageOptimizer
 * @package App\Packages\ImageOptimizer
 */
class ImageOptimizer
{
    /**
     * @param $file
     * @param int $width
     * @param int $height
     * @param int $quality
     * @param string $path
     * @return string
     */
    public function optimize($file, $width = 100, $height = 100, $quality = 100, $path = 'upload')
    {
        if (empty($file)) {
            return $file;
        }
        
        $file = str_replace(
            '//',
            '/',
            $file
        );
        
        $storage = Storage::disk('admin');

        $path = rtrim($path, '/') . '/';

        list($folder, $filename) = explode('/', $file);

        $newPath = $folder . '/' . $width . '/' . $height . '/';

        $newFile = $newPath . $filename;

        if ($storage->exists($newFile)) {
            return asset($path . $newFile);
        }

        /** @var \Intervention\Image\Image $image */
        $image = Image::make(public_path($path . $file));

        $image->fit($width, $height, function ($constraint) {
            $constraint->upsize();
        });

        $storage->makeDirectory($newPath);

        $storage->put($newFile, $image->encode($image->extension, $quality));

        if (! $storage->exists($newFile)) {
            return asset($file);
        }

        return asset($path . $newFile);
    }
}
