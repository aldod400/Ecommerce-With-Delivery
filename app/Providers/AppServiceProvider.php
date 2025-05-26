<?php

namespace App\Providers;

use App\Repository\Contracts\ConfigRepositoryInterface;
use App\Repository\Eloquent\ConfigRepository;
use App\Services\Contracts\ConfigServiceInterface;
use App\Services\Implementations\ConfigService;
use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;
use App\Repository\Contracts\AuthRepositoryInterface;
use App\Repository\Contracts\BannerRepositoryInterface;
use App\Repository\Contracts\CategoryRepositoryInterface;
use App\Repository\Contracts\ProductRepositoryInterface;
use App\Repository\Eloquent\AuthRepository;
use App\Repository\Eloquent\BannerRepository;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\ProductRepository;
use App\Services\Contracts\AuthServiceInterface;
use App\Services\Contracts\BannerServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use App\Services\Implementations\AuthService;
use App\Services\Implementations\BannerService;
use App\Services\Implementations\CategoryService;
use App\Services\Implementations\ProductService;
use App\Strategies\Contracts\Login\LoginStrategyInterface;
use App\Strategies\Implementations\Login\EmailLoginStrategy;
use App\Strategies\Implementations\Login\PhoneLoginStrategy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ConfigServiceInterface::class, ConfigService::class);
        $this->app->bind(ConfigRepositoryInterface::class, ConfigRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(BannerRepositoryInterface::class, BannerRepository::class);
        $this->app->bind(BannerServiceInterface::class, BannerService::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);

        $this->app->bind(AuthServiceInterface::class, function ($app) {
            return new AuthService(
                $app->make(AuthRepositoryInterface::class),
                $app->make(LoginStrategyInterface::class . '_email'),
                $app->make(LoginStrategyInterface::class . '_phone')
            );
        });

        $this->app->bind(LoginStrategyInterface::class . '_email', EmailLoginStrategy::class);
        $this->app->bind(LoginStrategyInterface::class . '_phone', PhoneLoginStrategy::class);
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
    }
}
