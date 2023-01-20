<?php

declare(strict_types=1);

namespace App\Application\Providers;

use App\Domain\Repositories\UserAccountRepositoryInterface;
use App\Infrastructure\Conversations\ConversationFactory;
use App\Infrastructure\Repositories\UserAccountRepository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            UserAccountRepositoryInterface::class,
            fn (Container $app) => $app->make(UserAccountRepository::class)
        );
        $this->app->singleton(
            ConversationFactory::class,
            fn (Container $app) => new ConversationFactory($app->make(UserAccountRepositoryInterface::class))
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
