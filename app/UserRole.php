<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'user_roles';
    protected $dates = ['deleted_at'];

    public function acl(){
        return $this->hasMany('App\RoleACL','role_id','id');
    }

}