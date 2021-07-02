<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Modules\Uuid;

use Exception;

class MissingUuidParametersException extends Exception
{
    public function __construct($message = 'The Uuid generator needs at least one parameter')
    {
        parent::__construct($message);
    }
}