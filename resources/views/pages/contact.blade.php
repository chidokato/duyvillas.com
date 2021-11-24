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
<section id="body">
    <div id="product-page" class="page-body">
        <div class="breadcrumb">
            <div class="uk-container uk-container-center">
                <ul class="uk-breadcrumb">
                    <li><a href="{{asset('')}}" title="Trang chủ"><i class="fa fa-home"></i> Trang chủ</a></li>
                    <li class="uk-active"><a href="lien-he" title="Liên hệ">Liên hệ</a></li>
                </ul>
            </div>
        </div><!-- .breadcrumb -->
        <div class="uk-container uk-container-center">
            <div class="uk-grid ">
                <div class="uk-width-large-2-4">
                    <article class="article detail-content">
                        {!!$category->content!!}
                    </article><!-- .article -->
                    <div class="hd-search header-search">
                        <form action="" method="" class="uk-form form">
                            <input type="text" name="name" class="uk-width-1-1 input-text" placeholder="Họ & Tên ...">
                            <br>
                            <input type="text" name="tel" class="uk-width-1-1 input-text" placeholder="Số điện thoại ...">
                            <br>
                            <input type="text" name="email" class="uk-width-1-1 input-text" placeholder="Địa chỉ email...">
                            <br>
                            <textarea name="note" style="margin: 0px; width: 414px; height: 105px;" class="uk-width-1-1 input-text keyword" placeholder='Ghi chú' ></textarea>
                            <br>
                            <input style='background-color: red; border: none; color: #fff; padding: 7px 15px;' type="submit" name="btnsubmit" class="btnsubmit" value="GỬI ĐI">

                        </form>
                        <div class="searchResult"></div>
                    </div>
                </div><!-- .uk-width-larg-3-4 -->
                <div class="uk-width-large-2-4">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.761739891235!2d105.8036336149322!3d21.002185786012763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x49dd20a8a17b681c!2zQuG6pXQgxJDhu5luZyBT4bqjbiDEkOG6uXAgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1546854203265" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div><!-- .uk-grid -->
        </div><!-- .uk-container -->
    </div>
</section><!-- #body -->
<br>

@endsection
