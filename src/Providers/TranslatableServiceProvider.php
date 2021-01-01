<?php


namespace Echosters\Translatable\Providers;

use Echosters\Translatable\Queryable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class TranslatableServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        //Adding Queryable Logic into the Eloquent Query Builder
        Builder::mixin(new Queryable());
    }

}
