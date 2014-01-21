<?php

namespace Daninoz\ActiveAuth;

use Illuminate\Support\Facades\Auth;

class ActiveAuth extends Auth
{
    /**
     * Constant representing the user not found response.
     *
     * @var int
     */
    const INVALID_USER = 'active_auth.user';

    /**
     * Constant representing an invalid password.
     *
     * @var int
     */
    const INVALID_CREDENTIALS = 'active_auth.password';

    /**
     * Constant representing an inactive user
     *
     * @var int
     */
    const INACTIVE_USER = 'active_auth.token';

    /**
     * Constant representing a success login
     *
     * @var int
     */
    const SUCCESS = 'active_auth.success';

    protected static $active = 'activo';

    public static function activeAttempt(array $credentials = array(), $onlyActive = true, $remember = false) {

        $active_field = Config::get('active-auth::active_field');

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



