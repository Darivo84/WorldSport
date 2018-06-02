<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeaturesSlider extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'features_slider';
    protected $dates = ['deleted_at'];
    protected $fillable = ['page_id','site_id', 'description'];

}