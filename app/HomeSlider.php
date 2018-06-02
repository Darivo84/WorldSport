<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeSlider extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $fillable = ['image_path', 'page_id', 'site_id'];


    protected $table = 'home_slider';
    protected $dates = ['deleted_at'];

}