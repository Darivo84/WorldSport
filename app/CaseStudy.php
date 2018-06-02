<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseStudy extends Model
{
    use SoftDeletes;


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'case_studies';
    protected $dates = ['deleted_at'];
    protected $fillable = ['site_id','page_id', 'cover_img_url', 'brand_img_url', 'info_img_url', 'description'];

    public function pages(){
        return $this->belongsToMany('App\Page');
    }

}