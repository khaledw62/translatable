<?php
namespace Echosters\Translatable\Traits;

use Echosters\Translatable\Scopes\LangScope;

trait Translatable
{
    public static function bootedTranslatable()
    {
        static::addGlobalScope(new LangScope);
    }
}
