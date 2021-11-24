<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Image;
use File;
use App\order;
use App\category;
use App\order_images;

class c_order extends Controller
{
    public function getlist()
    {
        $order = order::orderBy('id','desc')->get();
        $category = category::where('sort_by',1)->orderBy('id','desc')->get();
    	return view('admin.order.list',[
            'order'=>$order,
			'category'=>$category,
		]);
    }

    public function getadd()
    {
        $category = category::where('sort_by',1)->orderBy('id','desc')->get();
    	return view('admin.order.add',[
            'category'=>$category
        ]);
    }

    public function postadd(Request $Request)
    {
        $this->validate($Request,['name' => 'Required'],[] );
    	$order = new order;
        $order->user = Auth::User()->name;
        $order->name = $Request->name;
        $order->slug = changeTitle($Request->name);
        $order->content = $Request->content;
        if($Request->price){$order->price = changeprice($Request->price);}else{$order->price = 0;}
        if($Request->old_price){$order->old_price = changeprice($Request->old_price);}else{$order->old_price = 0;}
        $order->cat_id = $Request->cat;
        $order->code = $Request->code;
        $order->quantity = $Request->quantity;
        // seo
        $order->title = $Request->title;
        $order->description = $Request->description;
        $order->keywords = $Request->keywords;
        $order->robot = $Request->robot;
        // seo
        $order->date = date('m/d/Y');
        // thêm ảnh
        if ($Request->hasFile('img')) {
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/order/".$filename)){
                $filename = str_random(4)."_".$filename;
            }
            $img = Image::make($file);
            $img->resize(280, 175, function ($constraint) {$constraint->aspectRatio();});
            $img->save(public_path('data/order/thumbnail/'.$filename));
            $file->move('data/order', $filename);
            $order->img = $filename;
        }
        else{
            $order->img = 'demo.jpg';
        }
        // thêm ảnh
        $order->save();
        return redirect('admin/order/list')->with('Alerts','Thành công');
    }

    public function getedit($id)
    {
        $order = order::findOrFail($id);
        $category = category::orderBy('id','desc')->get();
        $order_images = order_images::where('p_id',$order->id)->orderBy('id','desc')->get();
    	return view('admin.order.edit',[
            'order'=>$order,
            'category'=>$category,
            'order_images'=>$order_images,
        ]);
    }

    public function postedit(Request $Request,$id)
    {
        $this->validate($Request,['name' => 'Required'],[] );     
        $order = order::find($id);
        $order->name = $Request->name;
        $order->slug = changeTitle($Request->name);
        $order->content = $Request->content;
        if($Request->price){$order->price = changeprice($Request->price);}else{$order->price = 0;}
        if($Request->old_price){$order->old_price = changeprice($Request->old_price);}else{$order->old_price = 0;}
        $order->cat_id = $Request->cat;
        $order->code = $Request->code;
        $order->quantity = $Request->quantity;
        // seo
        $order->title = $Request->title;
        $order->description = $Request->description;
        $order->keywords = $Request->keywords;
        $order->robot = $Request->robot;
        // seo
        $order->date_up = date('m/d/Y');
        if ($Request->hasFile('img')) {
            // xóa ảnh cũ
            if(File::exists('data/order/'.$order->img)) {
                File::delete('data/order/'.$order->img);
            }
            if(File::exists('data/order/thumbnail/'.$order->img)) {
                File::delete('data/order/thumbnail/'.$order->img);
            }
            // xóa ảnh cũ
            // thêm ảnh mới
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/order/".$filename)){
                $filename = str_random(4)."_".$filename; }
            $img = Image::make($file);
            $img->resize(280, 175, function ($constraint) {$constraint->aspectRatio();});
            $img->save(public_path('data/order/thumbnail/'.$filename));
            $file->move('data/order', $filename);
            $order->img = $filename;
            // thêm ảnh mới
        }
        $order->save();
       
        return redirect('admin/order/edit/'.$id)->with('Alerts','Thành công');
    }

    public function getdelete($id)
    {
        $order = order::find($id);
        // xóa ảnh detail
        foreach ($order->order_images as $value) {
            $order_images = order_images::find($value['id']);
            $order_images->delete();
        }
        // xóa ảnh detail
        // xóa ảnh
        if(File::exists('data/order/'.$order->img)) {
            File::delete('data/order/'.$order->img);
        }
        if(File::exists('data/order/thumbnail/'.$order->img)) {
            File::delete('data/order/thumbnail/'.$order->img);
        }
        // xóa ảnh
        $order->delete();
        return redirect('admin/order/list')->with('Alerts','Thành công');
    }
}
