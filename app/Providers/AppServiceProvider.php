<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Models\Contact;
use App\Models\settings;
use App\Models\admin;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         Route::resourceVerbs([
          'create' => 'olustur',
          'edit' => 'guncelle'
        ]);     
         
        $contacts = Contact::orderBy('id', 'ASC')->get();
            View::share('contacts', $contacts);
            View::share('settings', settings::find(1));
            View::share('profiles',admin::find(1));
    }

    
    
}
