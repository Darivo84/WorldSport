<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $fillable = ['path'];

  /*  protected $upload_path = '/images/uploads/news';

    public function getFileAttribute($photo){

        return $this->upload_path . $photo;

    }*/

    protected $table = 'photos';
    protected $dates = ['deleted_at'];

}