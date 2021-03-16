<?php
namespace Echosters\Translatable\Traits;

use Echosters\Translatable\Scopes\LangScope;

trait Translatable
{
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new LangScope);
    }
}
