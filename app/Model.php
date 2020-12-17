<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    protected $guarded = [];
    
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            //$model->id = Str::uuid(); // Moze ovako, ali nije najbolje

            $model->{$model->getKeyName()} = (string) Str::uuid(); // return primaryKey // if overated, still work
        });
    }
}