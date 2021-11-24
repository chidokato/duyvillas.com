<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Image;
use File;
use App\themes;

class c_themes extends Controller
{
    public function getlist()
    {
        $logo = themes::where('note','logo')->orderBy('id','asc')->get();
        $slide = themes::where('note','slide')->orderBy('id','desc')->get();
        $banner = themes::where('note','banner')->orderBy('id','desc')->get();
        $logo_doitac = themes::where('note','logo-doitac')->orderBy('id','desc')->get();
    	return view('admin.themes.list',[
            'logo'=>$logo,
            'slide'=>$slide,
            'banner'=>$banner,
			'logo_doitac'=>$logo_doitac,
		]);
    }

    public function getadd()
    {
    	return view('admin.themes.add');
    }

    public function postadd(Request $Request)
    {
        $this->validate($Request,['name' => 'Required', 'note' => 'Required'],[] );
    	$themes = new themes;
        $themes->name = $Request->name;
        $themes->link = $Request->link;
        $themes->content = $Request->content;
        $themes->note = $Request->note;
        // thêm ảnh
        if ($Request->hasFile('img')) {
            $file = $Request->file('img');
            $filename = str_random(4)."_".$file->getClientOriginalName();
            while(file_exists("data/themes/".$filename)){
                $filename = str_random(4)."_".$file->getClientOriginalName();
            }
            $file->move('data/themes', $filename);
            $themes->img = $filename;
        }
        else{ $themes->img = 'demo.jpg'; }
        // thêm ảnh
        $themes->save();
        return redirect('admin/themes/list')->with('Alerts','Thành công');
    }

    public function getedit($id)
    {
        $themes = themes::findOrFail($id);
    	return view('admin.themes.edit',[
            'themes'=>$themes,
        ]);
    }

    public function postedit(Request $Request,$id)
    {
        $this->validate($Request,['name' => 'Required'],[] );     
        $themes = themes::find($id);
        $themes->name = $Request->name;
        $themes->link = $Request->link;
        $themes->content = $Request->content;
        //$themes->note = $Request->note;
        if ($Request->hasFile('img')) {
            // xóa ảnh
            if(File::exists('data/themes/'.$themes->img)) {
                File::delete('data/themes/'.$themes->img);
            }
            // xóa ảnh
            // thêm ảnh
            $file = $Request->file('img');
            $filename = str_random(4)."_".$file->getClientOriginalName();
            while(file_exists("data/themes/".$filename)){
                $filename = str_random(4)."_".$file->getClientOriginalName();
            }
            $file->move('data/themes', $filename);
            $themes->img = $filename;
            // thêm ảnh
        }
        $themes->save();
       
        return redirect('admin/themes/edit/'.$id)->with('Alerts','Thành công');
    }

    public function getdelete($id)
    {
        $themes = themes::find($id);
        // xóa ảnh
        if(File::exists('data/themes/'.$themes->img)) {
            File::delete('data/themes/'.$themes->img);
        }
        // xóa ảnh
        $themes->delete();
        return redirect('admin/themes/list')->with('Alerts','Thành công');
    }
}
