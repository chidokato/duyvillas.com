<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Image;
use File;
use App\customer;
use App\category;
use App\customer_images;

class c_customer extends Controller
{
    public function getlist()
    {
        $customer = customer::orderBy('id','desc')->get();
        $category = category::where('sort_by',1)->orderBy('id','desc')->get();
    	return view('admin.customer.list',[
            'customer'=>$customer,
			'category'=>$category,
		]);
    }

    public function getadd()
    {
        $category = category::where('sort_by',1)->orderBy('id','desc')->get();
    	return view('admin.customer.add',[
            'category'=>$category
        ]);
    }

    public function postadd(Request $Request)
    {
        $this->validate($Request,['name' => 'Required'],[] );
    	$customer = new customer;
        $customer->user = Auth::User()->name;
        $customer->name = $Request->name;
        $customer->slug = changeTitle($Request->name);
        $customer->content = $Request->content;
        if($Request->price){$customer->price = changeprice($Request->price);}else{$customer->price = 0;}
        if($Request->old_price){$customer->old_price = changeprice($Request->old_price);}else{$customer->old_price = 0;}
        $customer->cat_id = $Request->cat;
        $customer->code = $Request->code;
        $customer->quantity = $Request->quantity;
        // seo
        $customer->title = $Request->title;
        $customer->description = $Request->description;
        $customer->keywords = $Request->keywords;
        $customer->robot = $Request->robot;
        // seo
        $customer->date = date('m/d/Y');
        // thêm ảnh
        if ($Request->hasFile('img')) {
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/customer/".$filename)){
                $filename = str_random(4)."_".$filename;
            }
            $img = Image::make($file);
            $img->resize(280, 175, function ($constraint) {$constraint->aspectRatio();});
            $img->save(public_path('data/customer/thumbnail/'.$filename));
            $file->move('data/customer', $filename);
            $customer->img = $filename;
        }
        else{
            $customer->img = 'demo.jpg';
        }
        // thêm ảnh
        $customer->save();
        return redirect('admin/customer/list')->with('Alerts','Thành công');
    }

    public function getedit($id)
    {
        $customer = customer::findOrFail($id);
        $category = category::orderBy('id','desc')->get();
        $customer_images = customer_images::where('p_id',$customer->id)->orderBy('id','desc')->get();
    	return view('admin.customer.edit',[
            'customer'=>$customer,
            'category'=>$category,
            'customer_images'=>$customer_images,
        ]);
    }

    public function postedit(Request $Request,$id)
    {
        $this->validate($Request,['name' => 'Required'],[] );     
        $customer = customer::find($id);
        $customer->name = $Request->name;
        $customer->slug = changeTitle($Request->name);
        $customer->content = $Request->content;
        if($Request->price){$customer->price = changeprice($Request->price);}else{$customer->price = 0;}
        if($Request->old_price){$customer->old_price = changeprice($Request->old_price);}else{$customer->old_price = 0;}
        $customer->cat_id = $Request->cat;
        $customer->code = $Request->code;
        $customer->quantity = $Request->quantity;
        // seo
        $customer->title = $Request->title;
        $customer->description = $Request->description;
        $customer->keywords = $Request->keywords;
        $customer->robot = $Request->robot;
        // seo
        $customer->date_up = date('m/d/Y');
        if ($Request->hasFile('img')) {
            // xóa ảnh cũ
            if(File::exists('data/customer/'.$customer->img)) {
                File::delete('data/customer/'.$customer->img);
            }
            if(File::exists('data/customer/thumbnail/'.$customer->img)) {
                File::delete('data/customer/thumbnail/'.$customer->img);
            }
            // xóa ảnh cũ
            // thêm ảnh mới
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/customer/".$filename)){
                $filename = str_random(4)."_".$filename; }
            $img = Image::make($file);
            $img->resize(280, 175, function ($constraint) {$constraint->aspectRatio();});
            $img->save(public_path('data/customer/thumbnail/'.$filename));
            $file->move('data/customer', $filename);
            $customer->img = $filename;
            // thêm ảnh mới
        }
        $customer->save();
       
        return redirect('admin/customer/edit/'.$id)->with('Alerts','Thành công');
    }

    public function getdelete($id)
    {
        $customer = customer::find($id);
        // xóa ảnh detail
        foreach ($customer->customer_images as $value) {
            $customer_images = customer_images::find($value['id']);
            $customer_images->delete();
        }
        // xóa ảnh detail
        // xóa ảnh
        if(File::exists('data/customer/'.$customer->img)) {
            File::delete('data/customer/'.$customer->img);
        }
        if(File::exists('data/customer/thumbnail/'.$customer->img)) {
            File::delete('data/customer/thumbnail/'.$customer->img);
        }
        // xóa ảnh
        $customer->delete();
        return redirect('admin/customer/list')->with('Alerts','Thành công');
    }
}
