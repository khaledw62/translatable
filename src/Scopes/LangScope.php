<?php

namespace Echosters\Translatable\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Config;

class LangScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        //Get Table Name With .*
        $table = $model->getTable().'.*';

        //Check if Model Has translatedColumns as a public property
        if ($this->modelHasTranslatableAttribute($model)) {
            //iterate over the translatedColumns array
            foreach ($model->translatedColumns as $key => $column) {
                //adding Select Statement to the column name
                $builder->addSelect($this->generateSelectStatement($column));
            }
            //Adding all the columns with the select
            $builder->addSelect($table);
        }
    }

    /**
     * get App Language
     * @return string
    */
    public function getLanguage()
    {
        //Get App Locale
        $language = app()->getlocale();

        //if none will get default locale
        return $language ?? Config::get('locale');
    }

    /**
     * Generating Sql Select statement by column name
     * @param string $column
     * @return string Sql
    */
    public function generateSelectStatement($column)
    {
        return $column.'_'.$this->getLanguage().' as '.$column;
    }

    /**
     * check if model has translatedColumns property and it's array
     * @param Model $model
     * @return boolean
    */
    public function modelHasTranslatableAttribute(Model $model)
    {
        if (property_exists($model,'translatedColumns') && is_array($model->translatedColumns)) {
            return true;
        }
        return false;
    }
}
