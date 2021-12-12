<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Example extends Model
{
    //
    use SoftDeletes;
    public $incrementing = false;
    protected $fillable = [
        'title',
        'content',
    ];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = str::orderedUuid();
        });
    }
}
