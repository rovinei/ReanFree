<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Conner\Tagging\Taggable;
use URL;

class Post extends Model
{
    use SoftDeletes, Taggable;


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
    protected $table = 'posts';


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
        'slug',
        'content',
        'category_id',
        'mediatype_id',
        'featured_image',
        'sound_url',
        'video_url',
        'status',
        'created_by',
        'updated_by'
    ];

    public function attachSeries($series=null){
        if(!(is_null($series))){
            if(is_array($series)){
                $this->detachSeries();
                $this->series()->attach($series);
            }

            if(is_string($series)){
                $this->detachSeries();
                $seriesIdArray = explode(',', $series);
                $this->series()->attach($seriesIdArray);
            }

        }
    }

    public function detachSeries($series=null){
        if(is_null($series)){
            $series = $this->series()->pluck('id')->toArray();
            $this->series()->detach($series);
        }

        if(is_string($series)){
            $seriesIdArray = explode(',', $series);
            $this->series()->detach($seriesIdArray);
        }

        if(is_array($series)){
            $this->series()->detach($series);
        }
    }

    public function series(){
        return $this->belongsToMany(
                        'App\Models\PlaylistSerie',
                        'post_serie',
                        'post_id',
                        'serie_id')->withTimestamps();
    }

    public function createdBy(){
        return $this->belongsTo('App\Models\Admin', 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo('App\Models\Admin', 'updated_by');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id');
    }


    public function setSoundUrlAttribute($value){
        $this->attributes['sound_url'] = str_replace(URL('/'),'',$value);
    }

    public function setFeaturedImageAttribute($value){
        $this->attributes['featured_image'] = str_replace(url('/'), '', $value);
        $this->attributes['featured_image'] = str_replace('uploads', 'thumbs', $value);
    }

    /**
     * @override boot function in order to fire up model events
     * creating, created, update, deleting ...
     *
     */
    public static function boot(){
        parent::boot();

        static::deleting(function($post){
            try {
                $post->untag();
                $post->detachSeries();
            } catch (Exception $e) {
                throw new Exception("Error Processing while deleting", 1);
            }
        });
    }
}
