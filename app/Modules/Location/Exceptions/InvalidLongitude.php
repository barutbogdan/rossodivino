<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Modules\Location\Exceptions;

use InvalidArgumentException;

class InvalidLongitude extends InvalidArgumentException
{
    /**
     * Create a new InvalidLongitude exception.
     *
     * @param string $message
     */
    public function __construct($message = 'Location longitude is not valid')
    {
        parent::__construct($message);
    }
}