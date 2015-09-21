<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workphone extends Model
{
    protected $table = 'workphone';
    public $timestamps = false;

    public function staff() {
    	return $this->belongsTo('App\Staff');
    }
}
