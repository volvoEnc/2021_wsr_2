<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    protected $table = 'airports';
    public $direction = 'to';

    public function time()
    {
        $d = 'time_' . $this->direction;
        dd($d);
        return $this->getAttribute($d);
    }
}
