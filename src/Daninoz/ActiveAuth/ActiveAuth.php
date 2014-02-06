<?php namespace Daninoz\ActiveAuth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class ActiveAuth extends Auth
{
    /**
     * Constant representing invalid credentials
     *
     * @var int
     */
    const INVALID_CREDENTIALS = 'active-auth::active-auth.credentials';

    /**
     * Constant representing if the user is inactive
     *
     * @var int
     */
    const INACTIVE_USER = 'active-auth::active-auth.inactive';

    /**
     * Constant representing a successful login
     *
     * @var int
     */
    const SUCCESS = 'active-auth::active_auth.success';


    /**
     * Attempt to authenticate an active user using the given credentials.
     *
     * @param array $credentials
     * @param bool $onlyActive
     * @param bool $remember
     * @return string
     */
    public static function activeAttempt(array $credentials = array(), $remember = false, $onlyActive = true) {

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



