<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlaylistSerie extends Model
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
    protected $table = 'series';


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
        'title',
        'mediatype_id',
        'featured_image',
        'description',
        'num_of_episode',
        'genre',
        'is_featured',
        'category_id',
        'created_by',
        'updated_by'
    ];

    // Override feature image
    public function setFeaturedImageAttribute($value){
        $imagePath = str_replace('uploads', 'thumbs', $value);
        $this->attributes['featured_image'] = str_replace(URL('/'), '', $imagePath);
    }

    // Eloquent related to posts
    public function posts(){
        return $this->belongsToMany(
                        'App\Models\Post',
                        'post_serie',
                        'serie_id',
                        'post_id')->withTimestamps();
    }

    public function count($serie_id){
        return $this->belongsToMany(
                        'App\Models\Post',
                        'post_serie',
                        'serie_id',
                        'post_id')->where('serie_id', $serie_id)->count();
    }

    // Eloquent related to category
    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function createdBy(){
        return $this->belongsTo('App\Models\Admin', 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo('App\Models\Admin', 'updated_by');
    }

    /**
     * @override boot function in order to fire up model events
     * creating, created, update, deleting ...
     *
     */
    public static function boot(){
        parent::boot();

        static::deleting(function($serie){
            try {
                $serie->posts()->sync([]);
                $serie->save();
            } catch (Exception $e) {
                throw new Exception("Error Processing while deleting", 1);
            }
        });
    }

}
