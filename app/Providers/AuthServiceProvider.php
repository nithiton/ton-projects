<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Clients;
use App\Models\Scope;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Route;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        Passport::enableImplicitGrant();
//        Passport::hashClientSecrets();
        Passport::useClientModel(Clients::class);

        Passport::tokensExpireIn(now()->addDays(7));
        Passport::refreshTokensExpireIn(now()->addDays(15));
        Passport::personalAccessTokensExpireIn(now()->addMonths(1));

        $scopes = Scope::All();
        $tokenCan = [];
        $defaultScopes = [];
        foreach ($scopes as $scope) {
            $tokenCan[$scope->id] = $scope->description;
            if ($scope->is_default) {
                $defaultScopes[] = $scope->id;
            }
        }

        Passport::tokensCan($tokenCan);
        Passport::setDefaultScope($defaultScopes);

        Route::post('/oauth/token', [
            'uses' => '\App\Http\Controllers\Auth\AccessTokenController@getToken',
            'as' => 'passport.token',
            'middleware' => 'throttle',
        ]);

    }
}
