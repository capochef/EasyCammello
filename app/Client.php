<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = "clients";
    protected $guarded = [];

    public function construct(array $attributes = [])
    {
        parent::construct($attributes);
    }

    public function competitors()
    {
        return $this->hasMany('App\Competitor', 'client_id');
    }
}
