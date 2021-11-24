<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\category;
use Image;
use File;

class c_category extends Controller
{
    public function getlist()
    {
    	$category = category::orderBy('view','asc')->get();
    	return view('admin.category.list',['category'=>$category]);
    }

    public function getadd()
    {
        $data = category::where('sort_by',1)->select('id','name','parent')->get();
    	return view('admin.category.add',['data'=>$data]);
    }

    public function postadd(Request $Request)
    {
        $this->validate($Request,['name' => 'Required|unique:tbl_category,name'],[] );
    	$category = new category;
        $category->user = Auth::User()->name;
        $category->name = $Request->name;
        $category->slug = changeTitle($Request->name);
        $category->content = $Request->content;
        $category->sort_by = $Request->sort_by;
        $category->parent = $Request->parent;
        $category->icon = $Request->icon;
        $category->status = 'true';
        $category->view = '1';
        // seo
        $category->title = $Request->title;
        $category->description = $Request->description;
        $category->keywords = $Request->keywords;
        $category->robot = $Request->robot;
        // seo
        $category->date = date('Y-m-d');
        if ($Request->hasFile('img')) {
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/category/".$filename)){
                $filename = str_random(4)."_".$filename;
            }
            $img = Image::make($file);
            $img->resize(300, 300, function ($constraint) {$constraint->aspectRatio();});
            $img->save(public_path('data/category/thumbnail/'.$filename));
            $file->move('data/category', $filename);
            $category->img = $filename;
        }
        else{
            $category->img = 'demo.jpg';
        }
        $category->save();

        return redirect('admin/category/list')->with('Alerts','Thành công');
    }

    public function getedit($id)
    {
        $data = category::findOrFail($id);
        $datacategory = category::where('sort_by',$data['sort_by'])->select('id','name','parent')->get();
    	return view('admin.category.edit',['data'=>$data, 'datacategory'=>$datacategory]);
    }

    public function postedit(Request $Request,$id)
    {
        $this->validate($Request,['name' => 'Required'],[] );      
        $category = category::find($id);
        $category->name = $Request->name;
        $category->slug = $Request->slug;
        $category->content = $Request->content;
        $category->icon = $Request->icon;
        // seo
        $category->title = $Request->title;
        $category->description = $Request->description;
        $category->keywords = $Request->keywords;
        $category->robot = $Request->robot;
        // seo
        $category->date_up = date('Y-m-d');
        if($id == $Request->parent){
            return redirect('admin/category/edit/'.$id)->with('Errors','Errors parent');
        }
        else{
            $category->parent = $Request->parent;
            if ($Request->hasFile('img')) {
                // xóa ảnh cũ
                if(File::exists('data/category/'.$category->img)) {
                    File::delete('data/category/'.$category->img); }
                if(File::exists('data/category/thumbnail/'.$category->img)) {
                    File::delete('data/category/thumbnail/'.$category->img); }
                // xóa xảnh cũ
                // thêm ảnh mới
                $file = $Request->file('img');
                $filename = $file->getClientOriginalName();
                while(file_exists("data/category/".$filename)){
                    $filename = str_random(4)."_".$filename; }
                $img = Image::make($file);
                $img->resize(300, 300, function ($constraint) {$constraint->aspectRatio();});
                $img->save(public_path('data/category/thumbnail/'.$filename));
                $file->move('data/category', $filename);
                $category->img = $filename;
                // thêm ảnh mới
            }
            $category->save();
            return redirect('admin/category/edit/'.$id)->with('Success','Thành công');
        }
        
    }

    public function getdelete($id)
    {
        $category = category::find($id);
        $count = category::where('parent',$id)->count();
        if($count > 0)
        {
            return redirect('admin/category/list')->with('Errors','Errors parent');
        }
        else
        {
            // xóa ảnh
            if(File::exists('data/category/'.$category->img)) {
                File::delete('data/category/'.$category->img); }
            if(File::exists('data/category/thumbnail/'.$category->img)) {
                File::delete('data/category/thumbnail/'.$category->img); }
            // xóa ảnh
            $category->delete();
            return redirect('admin/category/list')->with('Success','Success');
        }
    }
}
