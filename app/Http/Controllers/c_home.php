<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\home;

class c_home extends Controller
{
    public function getlist()
    {
    	$home = home::findOrFail(1);
    	return view('admin.home.list',['home'=>$home]);
    }

    public function postedit(Request $Request,$id)
    {
        $home = home::find($id);
        
        $home->heading1 = $Request->heading1;
        $home->heading2 = $Request->heading2;
        $home->heading3 = $Request->heading3;
        $home->heading4 = $Request->heading4;
        $home->heading5 = $Request->heading5;
        $home->heading6 = $Request->heading6;
        $home->heading7 = $Request->heading7;
        if($Request->img1){$home->img1 = $Request->img1;}
        if($Request->img2){$home->img2 = $Request->img2;}
        if($Request->img3){$home->img3 = $Request->img3;}
        if($Request->img4){$home->img4 = $Request->img4;}
        if($Request->img5){$home->img5 = $Request->img5;}
        if($Request->img6){$home->img6 = $Request->img6;}
        if($Request->img7){$home->img7 = $Request->img7;}
        $home->content1 = $Request->content1;
        $home->content2 = $Request->content2;
        $home->content3 = $Request->content3;
        $home->content4 = $Request->content4;
        $home->content5 = $Request->content5;
        $home->content6 = $Request->content6;
        $home->content7 = $Request->content7;

        $home->save();
        return redirect('admin/home/list')->with('Success','Thành công');
        
    }
}
