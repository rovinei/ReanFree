<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
{
    /**
     * The guard which protect this model and table
     *
     * @var string
     */
    protected $guard = 'admin';


    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'mediatype_id';


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'category_type';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'mediatype_id'
    ];

    public function categories(){
        return $this->belongsToMany(
                        'App\Models\Category',
                        'category_type',
                        'mediatype_id',
                        'category_id')->withTimestamps();
    }
}
