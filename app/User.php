<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['deleted_at'];

    // public function getUserDetails(){
    //     $data['details']['first_name'] = $this->first_name;
    //     $data['details']['last_name'] = $this->last_name;
    //     $data['details']['email'] = $this->email;
    //     //$data['details']['role_type'] = $this->role()->pluck('name');
    //     //$data['details']['role_id'] = $this->role_id;

    //     $data['permissions'] = $this->rolePermissions();

    //     return $data;
    // }

    public function role(){
        return $this->hasOne('App\UserRole','id','role_id');
    }

    public function getUserDetails(){
        $data['details']['id'] = $this->id;
        $data['details']['first_name'] = $this->first_name;
        $data['details']['last_name'] = $this->last_name;
        $data['details']['email'] = $this->email;
        $data['details']['role_type'] = $this->role()->pluck('name');
        //$data['details']['role_id'] = $this->role()->pluck('id');
        $data['details']['role_id'] = $this->role_id;
        $data['details']['office_group_id'] = $this->office_group_id;
        $data['details']['profile_pic'] = $this->profile_pic;
        $data['permissions'] = $this->rolePermissions();

        return $data;
    }

    public function permissions(){
        $rt = array();
        if($this->status == 'active')
        {
            $d=$this->role->acl;
            
            foreach ($d as $key => $value) {
                $val = $value['permission_type'] .'_'. $value['permission_name'];
                array_push($rt, $val);
            }
            // echo '<pre>';
            // var_dump($rt);exit;
        }
        return $rt;
    }
}
