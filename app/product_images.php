<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_images extends Model
{
    protected $table = "tbl_img_product";

	public function product()
	{
		return $this->belongsTo('App\product','p_id','id');
	}

    public $timestamps = false;
}
