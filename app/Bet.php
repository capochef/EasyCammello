<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    protected $table = "bets";
    protected $guarded = [];

    public function construct(array $attributes = [])
    {
        parent::construct($attributes);
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function competitor()
    {
        return $this->belongsTo('App\Competitor', 'competitor_id');
    }
}
