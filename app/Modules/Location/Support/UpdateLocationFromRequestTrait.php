<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Modules\Location\Support;

use ApiAuth;
use Illuminate\Http\Request;
use App\Modules\Location\Location;
use App\Modules\Location\LocationFactory;

trait UpdateLocationFromRequestTrait
{
    /**
     * Request input used to store the latitude.
     *
     * @var string
     */
    protected $requestLatField = 'lat';

    /**
     * Request input used to store the longitude.
     *
     * @var string
     */
    protected $requestLngField = 'lng';

    /**
     * Get the location from request, otherwise return null.
     *
     * @param Request $request
     * @return Location|null
     */
    protected function getLocationFromRequest(Request $request)
    {
        return LocationFactory::create(
            $request->input($this->requestLatField),
            $request->input($this->requestLngField)
        );
    }

    /**
     * Update the current location of the authenticated customer.
     *
     * @param Request $request
     * @return bool
     */
    protected function updateLocationOfAuthenticatedCustomer(Request $request)
    {
        if ($location = $this->getLocationFromRequest($request)) {
            ApiAuth::getCustomer()->location = $location;
            ApiAuth::getCustomer()->save();

            return true;
        }

        return false;
    }
}