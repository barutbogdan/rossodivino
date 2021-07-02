<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Modules\Location;

use App\Modules\Location\Exceptions\InvalidLatitude;
use App\Modules\Location\Exceptions\InvalidLongitude;

class Location
{
    /**
     * Value of latitude.
     *
     * @var number
     */
    protected $lat;

    /**
     * Value of longitude.
     *
     * @var number
     */
    protected $lng;

    /**
     * Create a new Location object.
     * @param number $lat
     * @param number $lng
     */
    public function __construct($lat, $lng)
    {
        $this->validate($lat, -90, 90, InvalidLatitude::class);
        $this->validate($lng, -180, 180, InvalidLongitude::class);

        $this->lat = (double) $lat;
        $this->lng = (double) $lng;
    }

    /**
     * Validate a coordinate value.
     *
     * @param number $value
     * @param number $min
     * @param number $max
     * @param string $exceptionClass
     * @throws InvalidLatitude
     * @throws InvalidLongitude
     */
    protected function validate($value, $min, $max, $exceptionClass)
    {
        if (!is_numeric($value) || $value < $min || $value > $max) {
            throw new $exceptionClass;
        }
    }

    /**
     * Get the latitude.
     *
     * @return number
     */
    public function latitude()
    {
        return $this->lat;
    }

    /**
     * Get the string representation of latitude.
     *
     * @return string
     */
    public function stringLatitude()
    {
        return (string) $this->lat;
    }

    /**
     * Get the longitude.
     *
     * @return number
     */
    public function longitude()
    {
        return $this->lng;
    }

    /**
     * Get the string representation of longitude.
     *
     * @return string
     */
    public function stringLongitude()
    {
        return (string) $this->lng;
    }

    /**
     * Check if the location is equal with the given location.
     *
     * @param Location $location
     * @return bool
     */
    public function equals(Location $location)
    {
        return $location->latitude() == $this->lat && $location->longitude() == $this->lng;
    }

    /**
     * Get the string representation of the object.
     *
     * @return string
     */
    public function __toString()
    {
        return "{$this->lat}, {$this->lng}";
    }
}