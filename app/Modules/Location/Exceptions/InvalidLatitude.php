<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Modules\Location\Exceptions;

use InvalidArgumentException;

class InvalidLatitude extends InvalidArgumentException
{
    /**
     * Create a new InvalidLatitude exception.
     * 
     * @param string $message
     */
    public function __construct($message = 'Location latitude is not valid')
    {
        parent::__construct($message);
    }
}