<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
    ];

    public function books()
    {
        return $this->belongsTo('App\Models\Book');
    }

}
