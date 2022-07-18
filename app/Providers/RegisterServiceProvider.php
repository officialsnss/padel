<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Services\ClubDataService;
use App\Services\ClubDataServiceImpl;
use App\Services\BatDataService;
use App\Services\BatDataServiceImpl;
use App\Services\LevelsService;
use App\Services\LevelsServiceImpl;
use App\Services\PlayersService;
use App\Services\PlayersServiceImpl;
use App\Services\MatchesService;
use App\Services\MatchesServiceImpl;
use App\Services\BookingService;
use App\Services\BookingServiceImpl;
use App\Services\PolicyService;
use App\Services\PolicyServiceImpl;
use App\Services\ContactUsService;
use App\Services\ContactUsServiceImpl;



class RegisterServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ClubDataService::class, ClubDataServiceImpl::class);
        $this->app->singleton(BatDataService::class, BatDataServiceImpl::class);
        $this->app->singleton(LevelsService::class, LevelsServiceImpl::class);
        $this->app->singleton(PlayersService::class, PlayersServiceImpl::class);
        $this->app->singleton(MatchesService::class, MatchesServiceImpl::class);
        $this->app->singleton(BookingService::class, BookingServiceImpl::class);
        $this->app->singleton(PolicyService::class, PolicyServiceImpl::class);
        $this->app->singleton(ContactUsService::class, ContactUsServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}