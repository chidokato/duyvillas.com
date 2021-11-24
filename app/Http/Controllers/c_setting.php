<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\setting;

class c_setting extends Controller
{
    public function getlist()
    {
    	$setting = setting::where('id',1)->first();
    	return view('admin.setting.list',['data'=>$setting]);
    }

    public function postedit(Request $Request,$id)
    {
        $setting = setting::find($id);
        $setting->name = $Request->name;
        $setting->address = $Request->address;
        $setting->email = $Request->email;
        $setting->hotline = $Request->hotline;
        $setting->hotline1 = $Request->hotline1;
        $setting->facebook = $Request->facebook;
        $setting->googleplus = $Request->googleplus;
        $setting->youtube = $Request->youtube;
        $setting->twitter = $Request->twitter;
        $setting->maps = $Request->maps;
        $setting->analytics = $Request->analytics;
        $setting->fbapp = $Request->fbapp;
        $setting->sidebar = $Request->sidebar;
        $setting->codeheader = $Request->codeheader;
        $setting->codebody = $Request->codebody;
        $setting->title = $Request->title;
        $setting->description = $Request->description;
        $setting->keywords = $Request->keywords;
        $setting->robot = $Request->robot;
        
        if ($Request->hasFile('img')) {
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/themes/".$filename)){
                $filename = str_random(4)."_".$filename;
            }
            $file->move('data/themes', $filename);
            $setting->img = $filename;
        }

        $setting->save();
        return redirect('admin/setting/list')->with('Success','Success');
    }
}
