<?php

namespace App\Providers;

use App\Contracts\Interfaces\DetailUserInterface;
use App\Contracts\Interfaces\DiaryInterface;
use App\Contracts\Interfaces\FavoriteInterface;
use App\Contracts\Interfaces\GalleryInterface;
use App\Contracts\Interfaces\TrashInterface;
use App\Contracts\Repositories\DetailUserRepository;
use App\Contracts\Repositories\DiaryRepository;
use App\Contracts\Repositories\FavoriteRepository;
use App\Contracts\Repositories\GalleryRepository;
use App\Contracts\Repositories\TrashRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private array $register = [
        DetailUserInterface::class => DetailUserRepository::class,
        DiaryInterface::class => DiaryRepository::class,
        GalleryInterface::class => GalleryRepository::class,
        FavoriteInterface::class => FavoriteRepository::class,
        TrashInterface::class => TrashRepository::class,

    ];
    /**
     * Register any application services.
     */
    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->register as $index => $value){
            $this->app->bind($index, $value);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
