<?php

namespace Blaze\Purize\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array sanitize(array $data, array $rules)
*/
class Sanitizer extends Facade
{
    /**
     * Get the registered name of the component.
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sanitizer';
    }
}
