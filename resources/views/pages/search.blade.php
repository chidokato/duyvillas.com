@extends('layout.index')

@section('title')
@endsection

@section('content')
@include('layout.header')
<section class="bread-crumb"> 
    <div class="container"> 
        <div class="row"> 
            <div class="col-xs-12"> 
                <ul class="breadcrumb" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"> 
                    <li class="home"> <a itemprop="url" href="{{asset('')}}"> <span itemprop="title"><i class="fa fa-home"></i></span> </a> <span><i class="fa">/</i></span> </li> 
                    <li><strong itemprop="title">Tìm kiếm</strong></li>  
                </ul> 
            </div> 
        </div> 
    </div> 
</section>

<div class="container clearfix">
    <div class="row">
        <div id="content" class="main_container collection margin-bottom-30 col-sm-12 col-xs-12 col-md-9 col-md-push-3">
            <div class="text-sm-left">
                <div class="tt hidden-xs"> 
                    <h1 class="title-head margin-top-0">Dự án bđs: <i>{{$key}}</i></h1> 
                </div> 
            </div>
            <div class="category-products products">
                <section class="products-view products-view-grid collection_reponsive">
                    <div class="row">
                        @if(count($product)>0)
                        @foreach($product as $val)
                        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                            @include('layout.iteamproduct')
                        </div>
                        @endforeach
                        @else
                        <div class="col-md-12">
                            <h2 style="color:red">The list is empty !!</h2>
                        </div>
                        @endif
                    </div> 
                    
                </section>
            </div> 
            <div class="text-sm-left">
                <div class="tt hidden-xs"> 
                    <h1 class="title-head margin-top-0">Tìm kiếm: <i>{{$key}}</i></h1> 
                </div> 
            </div>
            <div class="">
                <section class="">
                    @foreach($news as $val)
                    <div class="iteam-news">
                        <div class="row">
                            <div class="news-img col-xs-12 col-sm-4 col-md-3 col-lg-3">
                                <a href="{{$val->category->slug}}/{{$val->slug}}/{{$val->id}}.html"><img src="data/news/280-175/{{$val->img}}"></a>
                            </div>
                            <div class="news-detail col-xs-12 col-sm-8 col-md-9 col-lg-9">
                                <a href="{{$val->category->slug}}/{{$val->slug}}/{{$val->id}}.html"><h2>{{$val->name}}</h2></a>
                                <hr>
                                <div class="desc hidden-xs ">{{$val->detail}}</div>
                            </div>
                        </div> 
                    </div>
                    @endforeach
                </section>
            </div> 
        </div> 

        @include('layout.sitebar')
    </div> 
</div>
@endsection
