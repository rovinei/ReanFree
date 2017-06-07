<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{

    use SoftDeletes;


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
    protected $table = 'departments';


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
        'name',
        'description',
    ];

    public function admins(){
        return $this->belongsToMany(
                        'App\Models\Admin',
                        'admin_department',
                        'department_id',
                        'admin_id')->withTimestamps();
    }
}
