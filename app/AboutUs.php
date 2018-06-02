<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutUs extends Model
{
    use SoftDeletes;


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'about_us';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'site_id',
        'cover_img',
        'title',
        'subtitle',
        'events_img',
        'what_we_do',
        'footer_img',
    ];

}