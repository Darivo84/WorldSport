<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'contact';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'site_id',
        'address',
        'tel',
        'email',
        'description',
        'facebook_url',
        'linked_in_url',
        'google_plus_url',
        'google_map_link'
    ];

}