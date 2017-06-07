<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Auth;
use Entrust;

class Admin extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait { restore as private restoreA; }
    use SoftDeletes { restore as private restoreB; }


    public function restore(){
        $this->restoreA();
        $this->restoreB();
    }

    /**
     * The guard which protect this model and table
     *
     * @var string
     */
    protected $guard = 'admin';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admins';


    /**
     * use with softdeleted, when record deleted this attribute is set to
     * date that it have been deleted
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'email',
        'password',
        'phonenumber',
        'address',
        'career',
        'bio',
        'profile_pic',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function departments(){
        return $this->belongsToMany(
                        'App\Models\Department',
                        'admin_department',
                        'admin_id',
                        'department_id')->withTimestamps();
    }

    public function fileEntries(){
        return $this->hasMany('App\Models\FileEntry');
    }

    public function playlistSeries(){
        return $this->hasMany('App\Models\PlaylistSerie');
    }

    public function isSuperadmin(){
        return Entrust::hasRole('superadmin');
    }
}
