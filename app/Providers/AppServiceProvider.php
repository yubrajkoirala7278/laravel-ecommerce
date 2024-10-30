<?php

namespace App\Providers;

use App\Events\ContactFormSubmitted;
use App\Events\OrderPlaced;
use App\Listeners\NotifyUser;
use App\Listeners\SendContactFormEmail;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ImageRepository;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\SubCategoryRepositoryInterface;
use App\Repositories\ProductRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use App\Repositories\SubCategoryRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
        $this->app->bind(SubCategoryRepositoryInterface::class,SubCategoryRepository::class);
        $this->app->bind(BrandRepositoryInterface::class,BrandRepository::class);
        $this->app->bind(ProductRepositoryInterface::class,ProductRepository::class);
        $this->app->bind(ImageRepositoryInterface::class,ImageRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        Event::listen(
            OrderPlaced::class,
            NotifyUser::class,
            ContactFormSubmitted::class,
            SendContactFormEmail::class,
        );
    }
}
