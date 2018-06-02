<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'pages';
    protected $dates = ['deleted_at'];
    protected $fillable = ['title','sub_title', 'url', 'cover_img', 'what_we_do'];

    public function caseStudy(){
        return $this->belongsToMany('App\CaseStudy');
    }

}