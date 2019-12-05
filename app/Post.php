<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'author',
        'customPath',
        'postTitle', 
        'postContent',
        'postCategory',
        'featureImage',
        'seoTitle',
        'seoKeyword',
        'socialImage',
        'seoDescription',
        'isPublish',
        'scheduleUp',
        'scheduleDown',
        'sortKey',
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
