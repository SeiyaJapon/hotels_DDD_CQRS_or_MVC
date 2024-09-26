<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'name', 'image', 'stars', 'city', 'description'];

    public $incrementing = false;
    protected $keyType = 'string';

    //    Automatic UUID generation
    //    protected static function boot() {
    //        parent::boot();
    //
    //        static::creating(function ($model) {
    //            if (empty($model->id)) {
    //                $model->id = (string) Str::uuid();
    //            }
    //        });
    //    }
}
