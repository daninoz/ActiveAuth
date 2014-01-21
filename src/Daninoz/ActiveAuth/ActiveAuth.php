<?php

namespace Daninoz\ActiveAuth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class ActiveAuth extends Auth
{
    /**
     * Constant representing an invalid password.
     *
     * @var int
     */
    const INVALID_CREDENTIALS = 'active-auth::active-auth.credentials';

    /**
     * Constant representing an inactive user
     *
     * @var int
     */
    const INACTIVE_USER = 'active-auth::active-auth.inactive';

    /**
     * Constant representing a success login
     *
     * @var int
     */
    const SUCCESS = 'active-auth::active_auth.success';

    protected static $active = 'activo';

    public static function activeAttempt(array $credentials = array(), $onlyActive = true, $remember = false) {

        $active_field = Config::get('active-auth::active-field');

        if (parent::once($credentials))
        {
            if(!parent::user()->$active_field && $onlyActive) {
                parent::logout();

                return static::INACTIVE_USER;
            } else {
                parent::login(parent::user(), $remember);

                return static::SUCCESS;
            }
        }

        return static::INVALID_CREDENTIALS;
    }
}



