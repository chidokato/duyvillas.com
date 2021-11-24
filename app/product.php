<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = "tbl_product";

	public function category()
	{
		return $this->belongsTo('App\category','cat_id','id');
	}

	public function district()
    {
        return $this->belongsTo('App\district','dis_id','id');
    }

	public function product_images()
	{
		return $this->hasMany('App\product_images','p_id','id');
	}

    public $timestamps = false;
}
