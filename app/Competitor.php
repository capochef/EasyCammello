<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    protected $table = "competitors";
    protected $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::construct($attributes);
    }

    public function client()
    {
        return $this->belongsTo('App\Client', 'client_id');
    }

    public function events()
    {
        return $this->hasMany('App\Event', 'competitor_id');
    }
}
