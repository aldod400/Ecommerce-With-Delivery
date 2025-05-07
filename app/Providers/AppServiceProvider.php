<?php

namespace App\Providers;

use App\Repository\Contracts\ConfigRepositoryInterface;
use App\Repository\Eloquent\ConfigRepository;
use App\Services\Contracts\ConfigServiceInterface;
use App\Services\Implementations\ConfigService;
use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;
use App\Repository\Contracts\AuthRepositoryInterface;
use App\Repository\Eloquent\AuthRepository;
use App\Services\Contracts\AuthServiceInterface;
use App\Services\Implementations\AuthService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Response::macro(
            'api',
            function ($message, $statusCode = 200, $status = true, $errorNum = null, $data = null) {
                $responseData = [
                    'status' => $status,
                    'errorNum' => $errorNum,
                    'message' => $message,
                ];

                if ($data)
                    $responseData = array_merge($responseData, ['data' => $data]);

                return response()->json($responseData, $statusCode);
            }
        );
        $this->app->bind(ConfigServiceInterface::class, ConfigService::class);
        $this->app->bind(ConfigRepositoryInterface::class, ConfigRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
    }
}
