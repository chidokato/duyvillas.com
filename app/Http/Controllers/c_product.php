<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Image;
use File;
// use Input;
use App\product;
use App\city;
use App\district;
use App\category;
use App\product_images;

class c_product extends Controller
{
    public function getlist()
    {
        $product = product::orderBy('id','desc')->get();
    	return view('admin.product.list',[
            'product'=>$product,
		]);
    }
    public function getadd()
    {
        $category = category::where('sort_by',1)->orderBy('id','desc')->get();
        $city = city::all();
    	return view('admin.product.add',[
            'category'=>$category,
            'city'=>$city,
        ]);
    }
    public function postadd(Request $Request)
    {
        $this->validate($Request,['name' => 'Required'],[] );
    	$product = new product;
        $product->user = Auth::User()->name;
        $product->name = $Request->name;
        $product->slug = changeTitle($Request->name);
        $product->cat_id = $Request->cat;
        $product->dis_id = $Request->dis;
        $product->status = 'true';
        $product->price = $Request->price;
        $product->address = $Request->address;
        $product->detail = $Request->detail;
        $product->heading1 = $Request->heading1;
        $product->heading2 = $Request->heading2;
        $product->heading3 = $Request->heading3;
        $product->heading4 = $Request->heading4;
        $product->heading5 = $Request->heading5;
        $product->heading6 = $Request->heading6;
        $product->heading7 = $Request->heading7;
        $product->content1 = $Request->content1;
        $product->content2 = $Request->content2;
        $product->content3 = $Request->content3;
        $product->content4 = $Request->content4;
        $product->content5 = $Request->content5;
        $product->content6 = $Request->content6;
        $product->content7 = $Request->content7;
        // seo
        $product->title = $Request->title;
        $product->description = $Request->description;
        $product->keywords = $Request->keywords;
        $product->robot = $Request->robot;
        // seo
        $product->date = date('m/d/Y');

        // thêm ảnh
        if ($Request->hasFile('img')) {
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/product/".$filename)){ $filename = str_random(4)."_".$filename; }
            $img = Image::make($file);
            $img->resize(280, 175, function ($constraint) {$constraint->aspectRatio();});
            $img->save(public_path('data/product/thumbnail/'.$filename));
            $file->move('data/product', $filename);
            $product->img = $filename;
        }
        // thêm ảnh
        $product->save();
        
        if($Request->hasFile('imgdetail')){
            foreach ($Request->file('imgdetail') as $file) {
                $product_images = new product_images();
                if(isset($file)){
                    $product_images->p_id = $product->id;
                    $product_images->p_note = 0;
                    $filename = $file->getClientOriginalName();
                    while(file_exists("data/product/detail/".$filename)){
                        $filename = str_random(4)."_".$filename;
                    }
                    $file->move('data/product/detail', $filename);
                    $product_images->img = $filename;
                    $product_images->save();
                }
            }
        }

        return redirect('admin/product/list')->with('Alerts','Thành công');
    }

    public function getedit($id)
    {
        $data = product::findOrFail($id);
        $category = category::where('sort_by',1)->orderBy('id','desc')->get();
        $product_images = product_images::where('p_id',$data->id)->orderBy('id','desc')->get();
        $city = city::all();
        $district = district::where('city_id',$data->district->city['id'])->get();
    	return view('admin.product.edit',[
            'data'=>$data,
            'category'=>$category,
            'product_images'=>$product_images,
            'city'=>$city,
            'district'=>$district,
        ]);
    }

    public function postedit(Request $Request,$id)
    {
        $this->validate($Request,['name' => 'Required'],[] );  
        $product = product::find($id);
        $product->user = Auth::User()->name;
        $product->name = $Request->name;
        $product->slug = changeTitle($Request->name);
        $product->cat_id = $Request->cat;
        $product->dis_id = $Request->dis;
        $product->status = 'true';
        $product->price = $Request->price;
        $product->address = $Request->address;
        
        $product->detail = $Request->detail;
        $product->heading1 = $Request->heading1;
        $product->heading2 = $Request->heading2;
        $product->heading3 = $Request->heading3;
        $product->heading4 = $Request->heading4;
        $product->heading5 = $Request->heading5;
        $product->heading6 = $Request->heading6;
        $product->heading7 = $Request->heading7;
        $product->content1 = $Request->content1;
        $product->content2 = $Request->content2;
        $product->content3 = $Request->content3;
        $product->content4 = $Request->content4;
        $product->content5 = $Request->content5;
        $product->content6 = $Request->content6;
        $product->content7 = $Request->content7;
        // seo
        $product->title = $Request->title;
        $product->description = $Request->description;
        $product->keywords = $Request->keywords;
        $product->robot = $Request->robot;
        // seo
        $product->date = date('m/d/Y');
        // thêm ảnh
        if ($Request->hasFile('img')) {
            // xóa
            if(File::exists('data/product/'.$product->img)) {
                File::delete('data/product/'.$product->img);
            }
            if(File::exists('data/product/thumbnail/'.$product->img)) {
                File::delete('data/product/thumbnail/'.$product->img);
            }
            // xóa
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/product/".$filename)){
                $filename = str_random(4)."_".$filename;
            }
            $img = Image::make($file);
            $img->resize(280, 175, function ($constraint) {$constraint->aspectRatio();});
            $img->save(public_path('data/product/thumbnail/'.$filename));
            $file->move('data/product', $filename);
            $product->img = $filename;
        }
        // thêm ảnh
        if($Request->hasFile('imgdetail')){
            foreach ($Request->file('imgdetail') as $file) {
                $product_images = new product_images();
                if(isset($file)){
                    $product_images->p_id = $product->id;
                    $product_images->p_note = 0;
                    // $product_images->img = $file->getClientOriginalName();
                    $filename = $file->getClientOriginalName();
                    while(file_exists("data/product/detail/".$filename)){
                        $filename = str_random(4)."_".$filename;
                    }
                    $file->move('data/product/detail', $filename);
                    $product_images->img = $filename;
                    $product_images->save();
                }
            }
        }

        $product->save();
       
        return redirect('admin/product/edit/'.$id)->with('Alerts','Thành công');
    }

    public function getdelete($id)
    {
        $product = product::find($id);
        // xóa ảnh detail
        foreach ($product->product_images as $value) {
            $product_images = product_images::find($value['id']);
            $product_images->delete();
        }
        // xóa ảnh detail
        // xóa ảnh
        if(File::exists('data/product/'.$product->img)) {
            File::delete('data/product/'.$product->img);
        }
        if(File::exists('data/product/thumbnail/'.$product->img)) {
            File::delete('data/product/thumbnail/'.$product->img);
        }
        // xóa ảnh
        $product->delete();
        return redirect('admin/product/list')->with('Alerts','Thành công');
    }

}
