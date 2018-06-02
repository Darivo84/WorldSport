<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'team';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'site_id',
        'first_name',
        'last_name',
        'email',
        'linkedin_url',
        'title',
        'image',
    ];

}