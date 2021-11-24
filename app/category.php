<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = "tbl_category";
	
	public function product()
	{
		return $this->hasMany('App\product','cat_id','id');
	}
	public function news()
	{
		return $this->hasMany('App\news','cat_id','id');
	}
	
    public $timestamps = false;
}
