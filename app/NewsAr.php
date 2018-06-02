<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsAr extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'news_ar';
    protected $dates = ['deleted_at'];
    protected $fillable = ['title', 'url', 'image', 'description', 'event_type'];

}