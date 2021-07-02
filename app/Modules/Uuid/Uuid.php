<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Modules\Uuid;

use Illuminate\Support\Str;

class Uuid
{
    /**
     * Generate an uuid based on a list of parameters.
     *
     * @param array ...$params
     * @return string
     * @throws MissingUuidParametersException
     */
    public static function generate(...$params)
    {
        if (!$params) {
            throw new MissingUuidParametersException;
        }

        $uuid = '';

        foreach ($params as $param) {
            $uuid .= Str::random(6).$param;
        }

        return md5($uuid);
    }
}