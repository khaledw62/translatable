<?php

namespace Echosters\Translatable\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class LangScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        //Check if Model Has translatedColumns as a public property
        if ($this->modelHasTranslatableAttribute($model)) {
            //iterate over the translatedColumns array
            if (is_null($builder->getQuery()->columns)) {
                $builder->select($builder->qualifyColumn('*'));
            }

            foreach ($model->translatedColumns as $key => $column) {
                //adding Select Statement to the column name
                $builder->addSelect(DB::raw($this->generateSelectStatement($column)));
            }
        }
    }

    public function getLanguage(): string
    {
        //Get App Locale
        $language = app()->getlocale();

        //if none will get default locale
        return $language ?? Config::get('locale');
    }

    public function generateSelectStatement($column): string
    {
        $asColumn = "$column"."_"."{$this->getLanguage()}";
        return "`$asColumn` as `$column`";
    }

    public function modelHasTranslatableAttribute(Model $model): bool
    {
        return property_exists($model,'translatedColumns') && is_array($model->translatedColumns);
    }
}
