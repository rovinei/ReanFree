<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
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
    protected $table = 'partners';


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
        'company_name',
        'logo_src',
        'external_url',
        'is_featured',
        'status',
        'created_by',
        'updated_by'
    ];

    public function setLogoSrcAttribute($value){
        $logoPath = str_replace('uploads', 'thumbs', $value);
        $this->attributes['logo_src'] = str_replace(URL('/'), '', $logoPath);
    }

    public function createdBy(){
        return $this->belongsTo('App\Models\Admin', 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo('App\Models\Admin', 'updated_by');
    }
}
