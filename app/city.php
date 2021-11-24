<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    protected $table = "tbl_city";

    public function district()
    {
    	return $this->hasMany('App\district','city_id','id');
    }

    public function product()
    {
    	return $this->hasManyThrough('App\product','App\district','city_id','dis_id','id');
    }

    public $timestamps = false;
}

?>