<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];
    //
    protected $fillable = [
        'name',
        'price',
        'quantity',
        'image',
        'type_products_id'
    ];

//    protected $with = ['type_products'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:m:s',
        'updated_at' => 'datetime:Y-m-d h:m:s',
    ];

    public $incrementing = false;

    public function type_products()
    {
        return $this->belongsTo('App\TypeProduct', 'type_products_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $model->{$model->getKeyName()} = str::orderedUuid();

        });
    }

    public function getCreatedAtAttribute($created_at)
    {
        return Carbon::parse($created_at)->timezone('Asia/Ho_Chi_Minh')->toDateTimeString();
    }

    public function getUpdatedAtAttribute($updated_at)
    {
        return Carbon::parse($updated_at)->timezone('Asia/Ho_Chi_Minh')->toDateTimeString();
    }
}
