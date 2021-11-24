<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class district extends Model
{
    protected $table = "tbl_district";

    public function city()
    {
    	return $this->belongsTo('App\city','city_id','id');
    }

    public function product()
    {
    	return $this->hasMany('App\product','dis_id','id');
    }

    public $timestamps = false;
}

?>