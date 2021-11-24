<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Request;
use File;
use App\category;
use App\news;
use App\product;
use App\district;
use App\product_images;

class c_ajax extends Controller
{   
	public function sortby($id)
    {
		$data = category::where('sort_by',$id)->get();
		return view('admin.category.listparent',['data'=>$data]);
    }
    public function updateview($id)
    {
    	if(Request::ajax()){
    		$view = Request::get('view');
    		$category = category::find($id);
	    	$category->view = $view;
	    	$category->save();
    	}
		// $category = category::orderBy('view','asc')->get();
		// return view('admin.category.listajax',['category'=>$category]);
    }
    public function updatestatus($id)
    {
    	if(Request::ajax()){
    		$status = Request::get('status');
    		$category = category::find($id);
	    	$category->status = $status;
	    	$category->save();
    	}
		// $category = category::orderBy('view','asc')->get();
		// return view('admin.category.listajax',['category'=>$category]);
    }
    public function addimg($id)
    {
        if(Request::ajax()){
            $pid = Request::get('pid');
            $img = Request::get('img');
            $product_images = new product_images;
            $product_images->p_id = $pid;
            $product_images->img = $img;
            $product_images->save();
        }
        $product_images = product_images::where('p_id',$pid)->orderBy('id','desc')->get();
        return view('admin.product.listimg',['product_images'=>$product_images, 'pid'=>$pid]);
    }
    public function delimg($id)
    {
        if(Request::ajax()){
            $pid = Request::get('pid');
            $id_img = Request::get('id_img');
            $product_images = product_images::find($id_img);
            $product_images->delete();
        }
        $product_images = product_images::where('p_id',$pid)->orderBy('id','desc')->get();
        return view('admin.product.listimg',['product_images'=>$product_images, 'pid'=>$pid]);
    }
    // product
    public function productstatus($id)
    {
        if(Request::ajax()){
            $status = Request::get('status');
            $product = product::find($id);
            $product->status = $status;
            $product->save();
        }
    }
    public function producthot($id)
    {
        if(Request::ajax()){
            $hot = Request::get('hot');
            $product = product::find($id);
            $product->hot = $hot;
            $product->save();
        }
    }
    public function getlocation($id)
    {
        $district = district::where('city_id',$id)->get();
        foreach($district as $val)
        {
            echo "<option value='". $val->id ."'>". $val->name ."</option>";
        }
    }
    public function delproductimages($id)
    {
        if(Request::ajax()){
            $product_images = product_images::find($id);
            if(File::exists('data/product/detail/'.$product_images->img)) {
                File::delete('data/product/detail/'.$product_images->img);
            }
            $product_images->delete();
        }
    }
    // endproduct

    // news
    public function newstatus($id)
    {
        if(Request::ajax()){
            $status = Request::get('status');
            $news = news::find($id);
            $news->status = $status;
            $news->save();
        }
        // $product = product::orderBy('id','desc')->paginate(20);
        // return view('admin.product.listajax',['product'=>$product]);
    }
    public function newhot($id)
    {
        if(Request::ajax()){
            $hot = Request::get('hot');
            $news = news::find($id);
            $news->hot = $hot;
            $news->save();
        }
        // $product = product::orderBy('id','desc')->paginate(20);
        // return view('admin.product.listajax',['product'=>$product]);
    }
    // end news
  
}
?>
