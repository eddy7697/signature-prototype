<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'author',
        'custom_path',
        'post_title', 
        'post_content',
        'post_category',
        'feature_image',
        'seo_title',
        'seo_keyword',
        'seo_image',
        'seo_description',
        'is_publish',
        'schedule_up',
        'schedule_down',
        'sort_key',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
