<?php

namespace App\Providers;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        //=> JWT Auth ( Origin : https://medium.com/@barryvdh/oauth-in-javascript-apps-with-angular-and-lumen-using-satellizer-and-laravel-socialite-bb05661c0d5c#.fekgbu34j )

        $this->app['auth']->viaRequest('api', function ($request) {
          $payload = (array) JWT::decode(explode(' ', $request->header('Authorization'))[1], env('JWT_KEY'), ['HS256']);
          return User::where('email', $payload['sub'])->firstorfail();
        });
    }
}
