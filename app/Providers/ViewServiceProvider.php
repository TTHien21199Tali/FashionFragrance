<?php
 
namespace App\Providers;
 
use App\View\Composers\MenuComposer;
use Illuminate\Support\Facades\View;
use App\Http\Services\Menu\MenuService;

use Illuminate\Support\ServiceProvider;

 
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }
 
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       View::composer('header', MenuComposer::class);
    }
}