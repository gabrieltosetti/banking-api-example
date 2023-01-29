<?php

declare(strict_types=1);

namespace App\Application\Providers;

use App\Domain\DataAccessObjects\BankAccountDAOInterface;
use App\Domain\DataAccessObjects\CurrencyDAOInterface;
use App\Domain\DataAccessObjects\TransactionDAOInterface;
use App\Domain\DataAccessObjects\UserAccountDAOInterface;
use App\Domain\Repositories\BankAccountRepositoryInterface;
use App\Domain\Repositories\UserAccountRepositoryInterface;
use App\Infrastructure\DataAccessObjects\BankAccountDAO;
use App\Infrastructure\DataAccessObjects\CurrencyDAO;
use App\Infrastructure\DataAccessObjects\TransactionDAO;
use App\Infrastructure\DataAccessObjects\UserAccountDAO;
use App\Infrastructure\Repositories\BankAccountRepository;
use App\Infrastructure\Repositories\UserAccountRepository;
use App\Library\Carbon;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Facades\Date;
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
        $this->app->bind(
            BankAccountDAOInterface::class,
            fn (Container $app) => $app->make(BankAccountDAO::class)
        );
        $this->app->bind(
            CurrencyDAOInterface::class,
            fn (Container $app) => $app->make(CurrencyDAO::class)
        );
        $this->app->bind(
            TransactionDAOInterface::class,
            fn (Container $app) => $app->make(TransactionDAO::class)
        );
        $this->app->bind(
            UserAccountDAOInterface::class,
            fn (Container $app) => $app->make(UserAccountDAO::class)
        );

        $this->app->bind(
            BankAccountRepositoryInterface::class,
            fn (Container $app) => $app->make(BankAccountRepository::class)
        );
        $this->app->bind(
            UserAccountRepositoryInterface::class,
            fn (Container $app) => $app->make(UserAccountRepository::class)
        );

        Date::useClass(Carbon::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Date::useClass(Carbon::class);
    }
}
