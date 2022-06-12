<?php
namespace Echosters\Translatable\Traits;

use Echosters\Translatable\Scopes\LangScope;

trait Translatable
{
    protected static function booted()
    {
        static::addGlobalScope(new LangScope);
    }
}
