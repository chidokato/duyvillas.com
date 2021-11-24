<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\themes;
use App\news;
use App\category;
use App\product;
use App\setting;
use App\city;
use App\district;
use App\product_images;
use App\User;
use Mail;


class c_frontend extends Controller
{
    function __construct()
    {
        $head_logo = themes::where('id',1)->first();
        $head_logo_trang = themes::where('id',2)->first();
        $head_setting = setting::where('id',1)->first();
        $head_category = category::orderBy('view','asc')->get();
        $sidebar_news = news::take(4)->orderBy('id','desc')->get();
        $city = city::get();
        $user = User::where('permission',0)->get();

        view()->share( [
            'head_logo'=>$head_logo,
            'head_logo_trang'=>$head_logo_trang,
            'head_setting'=>$head_setting,
            'head_category'=>$head_category,
            'sidebar_news'=>$sidebar_news,
            'citys'=>$city,
            'user'=>$user,
        ]);
    }

    public function home()
    {
        $home_slider = themes::where('note','slide')->orderBy('id','desc')->get();
        $home_banner = themes::where('note','banner')->get();
        $home_doitac = themes::where('note','logo-doitac')->get();
        $cat_product = category::where('sort_by',1)->get();
        $cat_news = category::where('sort_by',2)->get();
        $product_hot = product::where('hot','true')->take(8)->get();
		$home_district = category::where('sort_by',1)->get();
        $activemenu = '';
        
        return view('pages.home',[
            'home_slider'=>$home_slider,
            'home_banner'=>$home_banner,
            'home_doitac'=>$home_doitac,
            'cat_product'=>$cat_product,
            'cat_news'=>$cat_news,
            'product_hot'=>$product_hot,
            'home_district'=>$home_district,
            'activemenu'=>$activemenu,
            ]);
    }
	
	public function iframe()
    {
        return view('pages.iframe');
    }

    public function sitemap()
    {
        $sitemap_category = category::all();
        $sitemap_product = product::where('id',24)->get();
        $sitemap_news = news::all();
        return response()->view('pages.sitemap', [
            'sitemap_category' => $sitemap_category,
            'sitemap_product' => $sitemap_product,
            'sitemap_news' => $sitemap_news
            ])->header('Content-Type', 'text/xml');
    }

    public function contact()
    {
        $category = category::where('slug','lien-he')->first();
        $activemenu = 'contact';
        return view('pages.contact',['activemenu'=>$activemenu, 'category'=>$category]);
    }

    public function category($curl)
    {
        $activemenu = '$curl';
        $category = category::where('slug',$curl)->first();
        $cat_id = $category["id"];
        
        if ($category["sort_by"]==1) {
            if($category["parent"] == 0)
            {
                $product = product::join('tbl_category', 'tbl_category.id', '=', 'tbl_product.cat_id')
                    ->select('tbl_product.*')
                    ->Where(function ($query) use ($cat_id){
                        return $query->where('tbl_product.status','true')->Where('cat_id',$cat_id);
                    })
                    ->orWhere(function ($query) use ($cat_id){
                        return $query->where('tbl_product.status','true')->Where('parent',$cat_id);
                    })
                    ->orWhere('parent',$cat_id)
                    ->orderBy('id','desc')
                    ->paginate(18);
            }
            else
            {
                $product=product::where('cat_id',$cat_id)->where('tbl_product.status','true')->orderBy('id','desc')->paginate(18);
            }
            return view('pages.product',['activemenu'=>$activemenu, 'category'=>$category,'product'=>$product]);
        }

        if ($category["sort_by"]==2) {
            if($category["parent"] == 0)
            {
                $news = news::join('tbl_category', 'tbl_category.id', '=', 'tbl_news.cat_id')
                    ->select('tbl_news.*')
                    ->Where(function ($query) use ($cat_id){
                        return $query->where('tbl_news.status','true')->Where('cat_id',$cat_id);
                    })
                    ->orWhere(function ($query) use ($cat_id){
                        return $query->where('tbl_news.status','true')->Where('parent',$cat_id);
                    })
                    ->orWhere('parent',$cat_id)
                    ->orderBy('id','desc')
                    ->paginate(10);
            }
            else
            {
                $news = news::join('tbl_category', 'tbl_category.id', '=', 'tbl_news.cat_id')
                    ->select('tbl_news.*')
                    ->where('cat_id',$cat_id)->where('tbl_news.status','true')->orderBy('id','desc')->paginate(15);
            }
            return view('pages.news',['activemenu'=>$activemenu, 'category'=>$category,'news'=>$news]);
        }

        if ($category["sort_by"]==3) {
            return view('pages.singlepage',['activemenu'=>$activemenu, 'category'=>$category]);
        }
    }

    public function singleproduct($curl,$purl)
    {
        $activemenu = '$purl';
        $singleproduct = product::where('slug',$purl)->first();
        $id = $singleproduct['id'];
        $product_images = product_images::where('p_id',$id)->get();
        $singleproduct->hits = $singleproduct->hits + 1;
        $singleproduct->save();
        $lienquan = product::where('status','true')
            ->where('dis_id',$singleproduct->dis_id)
            ->whereNotin('id',[$id])
            ->take(6)
            ->get();
		$news_product = news::take(5)->where('p_id',$singleproduct['id'])->orderBy('id','desc')->get();
        return view('pages.chitiet',[
            'activemenu'=>$activemenu,
            'singleproduct'=>$singleproduct,
            'product_images'=>$product_images,
            'lienquan'=>$lienquan,
            'news_product'=>$news_product,
        ]);
    }

    public function singlenews($curl,$nurl,$id)
    {
        $activemenu = '$nurl';
        $singlenews = news::find($id);
        $singlenews->hits = $singlenews->hits + 1;
        $singlenews->save();
        $tinlienquan = news::where('status','true')->where('cat_id',$singlenews->cat_id)->whereNotin('id',[$id])->take(10)->get();
		$product = product::where('id',$singlenews['p_id'])->get();
        return view('pages.singlenews',['activemenu'=>$activemenu, 'singlenews'=>$singlenews, 'tinlienquan'=>$tinlienquan, 'product'=>$product ]);
    }

    public function district($city, $dis)
    {
        $activemenu = '$curl';
        $district = district::where('slug',$dis)->first();
        $product=product::where('dis_id',$district['id'])->where('status','true')->orderBy('id','desc')->paginate(18);
        return view('pages.product',['activemenu'=>$activemenu, 'category'=>$district,'product'=>$product]);
    }
    public function city($city)
    {
        $activemenu = '$curl';
        $city = city::where('slug',$city)->first();
        $product = product::join('tbl_district', 'tbl_district.id', '=', 'tbl_product.dis_id')
                    ->select('tbl_product.*')
                    ->where('city_id',$city['id'])
                    ->where('tbl_product.status','true')
                    ->orderBy('id','desc')
                    ->paginate(18);
        return view('pages.product',['activemenu'=>$activemenu, 'category'=>$city,'product'=>$product]);
    }

    public function search(Request $Request)
    {
        $key = $Request->key;
        $news = news::where('status','true')->where('name','like',"%$key%")->orderBy('id','desc')->take(10)->get();
        $product = product::where('status','true')->where('name','like',"%$key%")->orderBy('id','desc')->take(15)->get();
        return view('pages.search',['news'=>$news,'product'=>$product,'key'=>$key]);
    }

    public function dangky(Request $Request)
    {
        $name = $Request->name;
        $phone = $Request->phone;
        $email = $Request->email;
        $link = $Request->link;
        $date = date('m/d/Y h:i:s', time());
        
        Mail::send('email_feedback', array('name'=>$name,'phone'=>$phone,'email'=>$email,'link'=>$link,'date'=>$date), function($message){
            $message->from('duyvillas.com@gmail.com', 'http://duyvillas.com/');
            $message->to('duyvillas.com@gmail.com', 'http://duyvillas.com/')->subject('Thông tin khách hàng');
        });
        //return view('pages.camon')->with('Alerts','Gửi thành công');
        return redirect('/')->with('Alerts','Thành công');
    }


}


