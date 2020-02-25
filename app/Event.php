<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = "events";
    protected $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::construct($attributes);
    }

    public function competitor()
    {
        return $this->belongsTo('App\Competitor', 'competitor_id');
    }
}
