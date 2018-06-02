<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseStudyPages extends Model
{


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $fillable = ['case_study_id','page_id'];

  /*  protected $upload_path = '/images/uploads/news';

    public function getFileAttribute($photo){

        return $this->upload_path . $photo;

    }*/

    protected $table = 'case_study_page';
    protected $dates = ['deleted_at'];

}