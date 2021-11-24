@extends('layout.index')

@section('title')
<?php if ( $category['title'] == '' ) echo $category['name']; else echo $category['title']; ?>
@endsection
@section('description')
<?php echo $category['desc']; ?>
@endsection
@section('keywords')
<?php echo $category['key']; ?>
@endsection
@section('robots')
<?php if ( $category['robot'] == 0 ) echo "index, follow";  elseif ( $category['robot'] == 1 ) echo "noindex, nofollow"; ?>
@endsection
@section('url')
<?php echo asset('').$category['slug']; ?>
@endsection

@section('content')
@include('layout.header')

<section class="bread-crumb"> 
    <div class="container"> 
        <div class="row"> 
            <div class="col-xs-12"> 
                <ul class="breadcrumb" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"> 
                    <li class="home"> <a itemprop="url" href="{{asset('')}}"> <span itemprop="title"><i class="fa fa-home"></i></span> </a> <span><i class="fa">/</i></span> </li> 
                    <li><strong itemprop="title">{{$category->name}}</strong></li>  
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
                    <h1 class="title-head margin-top-0">{{$category->name}}</h1> 
                </div> 
            </div>
            <div class="category-products products">
                <section class="content">
                    {!!$category->content!!}
                </section>
                
            </div> 
        </div> 

        @include('layout.sitebar')
    </div> 
</div>

@endsection