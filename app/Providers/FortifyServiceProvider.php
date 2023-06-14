<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->instance(LoginResponse::class, new class implements LoginResponse
        // {
        //     public function toResponse($request)
        //     {
        //         if ($request->wantsJson()) {
        //             $user = User::where('email', $request->email)->first();
        //             Hash::check($request->password, $user->password);
        //             return response()->json([
        //                 "message" => "loggend in",
        //                 "token" => $user->createToken($request->email)->plainTextToken
        //             ]);
        //         }
        //         return redirect()->intended(Fortify::redirects('login'));
        //     }
        // });

        // $this->app->instance(RegisterResponse::class, new class implements RegisterResponse
        // {
        //     public function toResponse($request)
        //     {
        //         $user = User::where('email', $request->email)->first();
        //         return $request->wantsJson()
        //             ? response()->json([
        //                 "message" => "registered",
        //                 "token" => $user->createToken($request->email)->plainTextToken,
        //             ], 200)
        //             : redirect()->intended(Fortify::redirects('register'));
        //     }
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
