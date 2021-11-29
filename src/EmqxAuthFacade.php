<?php

namespace SamirEltabal\EmqxAuth;

use Illuminate\Support\Facades\Facade;

/**
 * @see \VendorName\Skeleton\Skeleton
 */
class EmqxAuthFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'emqxauth';
    }

    public static function ping() {
        return response()
        ->json(
            ['message' => 'syncit emqx auth is responding', 'version' => config('EMQX.version')],
        201);
    }
}