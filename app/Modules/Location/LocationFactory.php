<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Modules\Location;

use Exception;

class LocationFactory
{
    /**
     * Create a new Location object.
     *
     * @param number $lat
     * @param number $lng
     * @return Location|null
     */
    public static function create($lat, $lng)
    {
        try {
            $location = new Location($lat, $lng);
        } catch (Exception $e) {
            return null;
        }

        return $location;
    }
}