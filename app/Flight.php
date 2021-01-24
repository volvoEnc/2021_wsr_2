<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $table = 'flights';
    public $direction = 'to';
    public $availability = 156;

    public function time()
    {
        $d = 'time_' . $this->direction;
        return $this->$d;
    }

    public function airport_to()
    {
        return $this->belongsTo(Airport::class, 'to_id', 'id');
    }

    public function airport_from()
    {
        return $this->belongsTo(Airport::class, 'from_id', 'id');
    }
}
