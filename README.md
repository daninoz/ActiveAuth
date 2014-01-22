# Active Auth

Add functionality to the Auth component on **Laravel4** to only login users with an active account.


## Setup

In the `require` key of `composer.json` file add

    "daninoz/active-auth": "dev-master"

Run the Composer update comand

    $ composer update

In your `config/app.php` add `'Daninoz\ActiveAuth\ActiveAuthServiceProvider'` to the end of the `$providers` array

```php
'providers' => array(

    'Illuminate\Foundation\Providers\ArtisanServiceProvider',
    'Illuminate\Auth\AuthServiceProvider',
    ...
    'Daninoz\ActiveAuth\ActiveAuthServiceProvider',

),
```

### Configuration

Set the propertly values to the `config/auth.php`.

### Users table

In your user table you just need and active field. By default, Active Auth will look for a field called active but you can change that.

Run:

    $ php artisan config:publish daninoz/active-auth

And a config file is going to be created on `app/config/packages/daninoz/active-auth/config.php`. Just change the active-field key.

### Example

```php
$credentials = [
    'email' => Input::get('email'),
    'password' => Input::get('password')
];

$response = ActiveAuth::activeAttempt($credentials);

switch ($response) {
    case ActiveAuth::INVALID_CREDENTIALS:
    case ActiveAuth::INACTIVE_USER:
        return Redirect::back()->with('error', Lang::get($response));

    case ActiveAuth::SUCCESS:
        return Redirect::intended('/');
}
```

## License

Active Auth is free software distributed under the terms of the MIT license


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/daninoz/activeauth/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

