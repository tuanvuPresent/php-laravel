<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TypeProduct extends Model
{
    //
    protected $fillable = [
        'name',
    ];

    public $incrementing = false;

    public function products()
    {
        return $this->hasMany('App\Product', 'type_products_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $model->{$model->getKeyName()} = str::orderedUuid();

        });
    }
}
