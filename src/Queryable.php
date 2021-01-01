<?php

namespace Echosters\Translatable;

use Illuminate\Support\Facades\Config;

class Queryable
{
    public function whereLocale()
    {
        $language = $this->getLanguage();
        return function ($column, $operator = null, $value = null, $boolean = 'and') use ($language) {
            $column = $column . '_' . $language;
            return $this->where($column, $operator, $value, $boolean);
        };
    }
    /**
     * get App Language
     * should be removed from here
     * @return string
     */
    public function getLanguage()
    {
        //Get App Locale
        $language = app()->getlocale();

        //if none will get default locale
        return $language ?? Config::get('locale');
    }
}
