<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseStudyGallery extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $fillable = ['site_id','page_id','case_study_id'];

  /*  protected $upload_path = '/images/uploads/news';

    public function getFileAttribute($photo){

        return $this->upload_path . $photo;

    }*/

    protected $table = 'case_study_galleries';
    protected $dates = ['deleted_at'];

}