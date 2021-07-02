<?php
/**
 *
 * @author dragosandreidinu
 *
 */
namespace App\Modules\Support;

class NameParser
{
    /**
     * Break the full name in last name and first name.
     *
     * @param string $fullName
     * @param bool $startWithLastName
     * @return array
     */
    public static function breakFullName($fullName, $startWithLastName = true)
    {
        $fullName = (string) $fullName;

        $parts = explode(' ', $fullName);

        if (count($parts) == 1) {
            return [
                'last_name' => '',
                'first_name' => $fullName
            ];
        }

        $name = [
            'last_name' => $startWithLastName ? array_shift($parts) : array_pop($parts),
            'first_name' => ''
        ];

        if ($parts) {
            $name['first_name'] = implode(' ', $parts);
        }

        return $name;
    }
}