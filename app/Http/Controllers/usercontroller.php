<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\user;
use File;


class usercontroller extends Controller
{
    //
    public function getlist()
    {
        $stt = user::count();
    	$user = user::all();
    	return view('admin.user.list',['user'=>$user, 'stt'=>$stt]);
    }

    public function getadd()
    {
    	return view('admin.user.add');
    }

    public function postadd(Request $Request)
    {
    	$this->validate($Request,
    		[
    			'name' => 'Required|min:3|max:50',
    			'email' => 'Required|email|unique:users,email',
    			'password' => 'Required',
    			'passwordagain' => 'Required|same:password',
    		],
    		[
    		] );
    	$user = new user;
        $user->name = $Request->name;
        $user->email = $Request->email;
        $user->password = bcrypt($Request->password);
        $user->permission = $Request->permission;
        $user->title = $Request->title;
        $user->description = $Request->description;
        $user->keywords = $Request->keywords;
    	$user->robot = $Request->robot;
        if ($Request->hasFile('img')) {
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/themes/".$filename)){
                $filename = str_random(4)."_".$filename;
            }
            $file->move('data/themes', $filename);
            $user->avatar = $filename;
        }
        $user->save();

        return redirect('admin/user/list')->with('Alerts','Thành công');

    }

    public function getedit($id)
    {
        $user = user::find($id);
    	return view('admin.user.edit',['user'=>$user]);
    }

    public function postedit(Request $Request,$id)
    {
        $this->validate($Request,
            [
                'name' => 'Required|min:3|max:50'
            ],
            [
                
            ] );
        $user = user::find($id);
        $user->name = $Request->name;
        $user->email = $Request->email;
        if($user->permission > 0)
        { $user->permission = $Request->permission; }
        if($Request->changepassword == "on")
        {
            $this->validate($Request,
            [ 'password' => 'Required', 'passwordagain' => 'Required|same:password'  ], [ ] );
            $user->password = bcrypt($Request->password);
        }
        $user->phone = $Request->phone;
        $user->facebook = $Request->facebook;
        $user->title = $Request->title;
        $user->description = $Request->description;
        $user->keywords = $Request->keywords;
        $user->robot = $Request->robot;
        if ($Request->hasFile('img')) {
            // xóa ảnh cũ
            if(File::exists('data/themes/'.$user->avatar)) {
                File::delete('data/themes/'.$user->avatar); }
            // xóa xảnh cũ
            // thêm ảnh mới
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/themes/".$filename)){
                $filename = str_random(4)."_".$filename; }
            $file->move('data/themes', $filename);
            $user->avatar = $filename;
            // thêm ảnh mới
        }
        $user->save();

        return redirect('admin/user/edit/'.$id)->with('Alerts','Thành công');
    }

    public function getdelete($id)
    {
        $user = user::find($id);
        $user->delete();

        return redirect('admin/user/list')->with('Alerts','Thành công');
    }


    public function getlogin()
    {
    	return view('admin.login');
    }

    public function postlogin(Request $request)
    {
    	$this->validate($request,[
    		'email' => 'required',
    		'password' => 'required|min:3|max:32'
    		],[

            ]);
    	if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
    	{
    		return redirect('admin/dashboard');
    	}
    	else
    	{
    		return redirect('admin_login')->with('Alerts','Lỗi ! Nhập sai email hoặc mật khẩu !');
    	}

    }

    public function getlogout()
    {
        Auth::logout();
        return redirect('admin_login');
    }
    
}
