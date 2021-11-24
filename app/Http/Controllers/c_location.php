<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\city;
use App\district;

class c_location extends Controller
{
    public function getlist()
    {
        $city = city::all();
        return view('admin.location.list',['city'=>$city]);
    }
    // city
    public function getaddcity()
    {
        return view('admin.location.addcity');
    }
    public function postaddcity(Request $Request)
    {
        $this->validate($Request, [ 'name' => 'Required|unique:tbl_city,name|min:3|max:100' ], [ ] );
        $city = new city;
        $city->name = $Request->name;
        $city->slug = changeTitle($Request->name);
        $city->view = $Request->view;
        $city->date = date('Y-m-d');
        // seo
        $city->title = $Request->title;
        $city->description = $Request->description;
        $city->keywords = $Request->keywords;
        $city->robot = $Request->robot;
        // seo
        $city->save();
        return redirect('admin/location/list')->with('Alerts','Thành công');
    }
    public function geteditcity($id)
    {
        $data = city::find($id);
        return view('admin.location.editcity',['data'=>$data]);
    }
    public function posteditcity(Request $Request,$id)
    {
        $this->validate($Request,
            [
                'name' => 'Required|min:3|max:50'
            ], [ ] );
        $city = city::find($id);
        $city->name = $Request->name;
        $city->slug = changeTitle($Request->name);
        $city->view = $Request->view;
        $city->date = date('Y-m-d');
        // seo
        $city->title = $Request->title;
        $city->description = $Request->description;
        $city->keywords = $Request->keywords;
        $city->robot = $Request->robot;
        // seo
        $city->save();
        return redirect('admin/location/editcity/'.$id)->with('Alerts','Thành công');
    }
    public function getdeletecity($id)
    {
        $city = city::find($id);
        $city->delete();
        return redirect('admin/location/list')->with('Alerts','Thành công');
    }
    // city
    
    // district
    public function getadddistrict()
    {
        $city = city::all();
        return view('admin.location.adddistrict',['city'=>$city]);
    }
    public function postadddistrict(Request $Request)
    {
        $this->validate($Request,
            [
                'name' => 'Required|unique:tbl_district,name|min:3|max:50'
            ],
            [
            ] );
        $district = new district;
        $district->name = $Request->name;
        $district->city_id = $Request->city_id;
        $district->slug = changeTitle($Request->name);
        $district->view = $Request->view;
        $district->date = date('Y-m-d');
        // seo
        $district->title = $Request->title;
        $district->description = $Request->description;
        $district->keywords = $Request->keywords;
        $district->robot = $Request->robot;
        // seo
        $district->save();
        return redirect('admin/location/list')->with('Alerts','Thành công');
    }
    public function geteditdistrict($id)
    {
        $data = district::find($id);
        $city = city::all();
        return view('admin.location.editdistrict',['data'=>$data,'city'=>$city]);
    }
    public function posteditdistrict(Request $Request,$id)
    {
        $this->validate($Request,
            [
                'name' => 'Required|min:3|max:50'
            ],
            [
            ] );
        $district = district::find($id);
        $district->name = $Request->name;
        $district->city_id = $Request->city_id;
        $district->slug = changeTitle($Request->name);
        $district->view = $Request->view;
        $district->date = date('Y-m-d');
        // seo
        $district->title = $Request->title;
        $district->description = $Request->description;
        $district->keywords = $Request->keywords;
        $district->robot = $Request->robot;
        // seo
        $district->save();
        return redirect('admin/location/editdistrict/'.$id)->with('Alerts','Thành công');
    }
    public function getdeletedistrict($id)
    {
        $district = district::find($id);
        $district->delete();
        return redirect('admin/location/list')->with('Alerts','Thành công');
    }
    // district

}
