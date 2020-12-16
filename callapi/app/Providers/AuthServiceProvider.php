<?php

namespace App\Providers;

// use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\JWTGuard;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::extend('jwt', function ($app, $name, array $config) {
            //
            return new JwtGuard(Auth::createUserProvider($config['provider']));
        });

        // Gate::define('isApp1', function () {
        //     return session()->get('token')['user']['role'] === 'app1';
        // });
        // Gate::define('isApp1', function ($user) {
        //     // return $user->session()->get('token')['user']['role'] == 'app1';
        //     dd($user->session()->get('token')['user']['role'] == 'app1');
        //     // dd($user);
        // });

        // Auth::viaRequest('custom-token', function ($request) {
        //     return session()->get('token'['user']['role'] == 'app1', $request->token)->first();
        // });
    }
}
