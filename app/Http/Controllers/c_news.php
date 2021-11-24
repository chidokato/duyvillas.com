<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Image;
use File;
use App\news;
use App\category;
use App\product;
use App\news_images;

class c_news extends Controller
{
    public function getlist()
    {
        $news = news::orderBy('id','desc')->paginate(10);
    	return view('admin.news.list',[
			'news'=>$news
		]);
    }

    public function getadd()
    {
        $category = category::where('sort_by',2)->orderBy('id','desc')->get();
        $product = product::all();
    	return view('admin.news.add',[
            'category'=>$category,
            'product'=>$product
        ]);
    }

    public function postadd(Request $Request)
    {
        $this->validate($Request,['name' => 'Required'],[] );
    	$news = new news;
        $news->user = Auth::User()->name;
        $news->name = $Request->name;
        $news->slug = changeTitle($Request->name);
        $news->detail = $Request->detail;
        $news->content = $Request->content;
        $news->cat_id = $Request->cat;
        $news->p_id = $Request->p_id;
        $news->status = 'true';
        // seo
        $news->title = $Request->title;
        $news->description = $Request->description;
        $news->keywords = $Request->keywords;
        $news->robot = $Request->robot;
        // seo
        $news->date = date('m/d/Y');
        // thêm ảnh
        if ($Request->hasFile('img')) {
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/news/280-175/".$filename)){ $filename = str_random(4)."_".$filename; }
            $img280 = Image::make($file)->resize(280, 175, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/news/280-175/'.$filename));
            $img80 = Image::make($file)->resize(80, 60, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/news/80-60/'.$filename));
            $news->img = $filename;
        }
        else{
            $news->img = 'demo.jpg';
        }
        // thêm ảnh
        $news->save();
        return redirect('admin/news/list')->with('Alerts','Thành công');
    }

    public function getedit($id)
    {
        $data = news::findOrFail($id);
        $category = category::where('sort_by',2)->orderBy('id','desc')->get();
		$product = product::all();
    	return view('admin.news.edit',[
            'data'=>$data,
            'category'=>$category,
            'product'=>$product,
        ]);
    }

    public function postedit(Request $Request,$id)
    {
        $this->validate($Request,['name' => 'Required'],[] );     
        $news = news::find($id);
        $news->name = $Request->name;
        $news->slug = changeTitle($Request->name);
        $news->detail = $Request->detail;
        $news->content = $Request->content;
        $news->cat_id = $Request->cat;
		$news->p_id = $Request->p_id;
        // seo
        $news->title = $Request->title;
        $news->description = $Request->description;
        $news->keywords = $Request->keywords;
        $news->robot = $Request->robot;
        // seo
        $news->date_up = date('m/d/Y');
        if ($Request->hasFile('img')) {
            // xóa ảnh cũ
            if(File::exists('data/news/280-175/'.$news->img)) {
                File::delete('data/news/280-175/'.$news->img);
            }
            if(File::exists('data/news/80-60/'.$news->img)) {
                File::delete('data/news/80-60/'.$news->img);
            }
            // xóa ảnh cũ
            // thêm ảnh mới
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/news/280-175/".$filename)){ $filename = str_random(4)."_".$filename; }
            $img280 = Image::make($file)->resize(280, 175, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/news/280-175/'.$filename));
            $img80 = Image::make($file)->resize(80, 60, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/news/80-60/'.$filename));
            $news->img = $filename;
            // thêm ảnh mới
        }
        $news->save();
        return redirect('admin/news/edit/'.$id)->with('Alerts','Thành công');
    }

    public function getdelete($id)
    {
        $news = news::find($id);
        // xóa ảnh
        if(File::exists('data/news/280-175/'.$news->img)) {
            File::delete('data/news/280-175/'.$news->img);
        }
        if(File::exists('data/news/80-60/'.$news->img)) {
            File::delete('data/news/80-60/'.$news->img);
        }
        // xóa ảnh
        $news->delete();
        return redirect('admin/news/list')->with('Alerts','Thành công');
    }
}
