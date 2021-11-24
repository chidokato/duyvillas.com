<!DOCTYPE HTML>
<html lang="vi-VN">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<base href="{{asset('')}}">
<!-- seo -->
<title>@yield('title')</title>
<meta name="description" content="@yield('description')"/>
<meta name="keywords" content="@yield('keywords')" />
<meta name="news_keywords" content="@yield('keywords')" />
<meta name="robots" content="@yield('robots')"/>
<link rel="shortcut icon" href="data/themes/{{$head_setting->img}}" />
<link rel="canonical" href="@yield('url')"/>
<link rel="alternate" href="{{asset('')}}" hreflang="vi-vn" />
<meta name="google-site-verification" content="1BagB3c4On1eq4v2SwQhJWAJgSaIfFbM15VQdQpvZCw" />
<!-- and seo -->
<!-- og -->
<meta property="og:locale" content="vi_VN">
<meta property="og:title" itemprop="title" content="@yield('title')">
<meta property="og:type" content="article">
<meta property="article:author" content="https://www.facebook.com/profile.php?id=100036334062760">
<meta property='article:publisher' content='https://www.facebook.com/profile.php?id=100036334062760'>
<meta property="og:description" itemprop="description" content="@yield('description')">
<meta property="og:url" itemprop="url" content="@yield('url')">
<meta property="og:site_name" content="{{$head_setting->name}}">
<meta property="og:image" itemprop="image" content="@yield('img')">
<meta property="og:image:alt" content="@yield('title')">
<meta property="fb:app_id" content="1056060257782954">
<!-- and og -->

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


<!-- css -->
<link href="frontend/templates/acore/core.css" rel="stylesheet" />
<link href="frontend/templates/frontend/resources/fonts/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet" />
<link href="frontend/templates/frontend/resources/uikit/css/uikit.modify.css" rel="stylesheet" />
<link href="frontend/templates/frontend/resources/library/css/reset.css" rel="stylesheet" />
<link href="frontend/templates/frontend/resources/library/css/library.css" rel="stylesheet" />
<link href="frontend/templates/frontend/resources/uikit/css/components/slideshow.min.css" rel="stylesheet" />
<link href="frontend/templates/frontend/resources/plugins/lightslider-master/dist/css/lightslider.min.css" rel="stylesheet" />
<link href="frontend/templates/frontend/resources/style.css" rel="stylesheet" />
<script src="frontend/templates/frontend/resources/library/js/jquery.js"></script>
<script src="frontend/templates/frontend/resources/uikit/js/uikit.min.js"></script>
<!-- and css -->

@include('layout.ananytisc')
@include('layout.facebook')

@yield('css')

{!! $head_setting->codeheader !!}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
	$(document).ready(function() {
  $("a[href*='#']:not([href='#])").click(function() {
    let target = $(this).attr("href");
    $('html,body').stop().animate({
      scrollTop: $(target).offset().top
    }, 500);
    event.preventDefault();
  });
});
</script>


</head>
<body class="common-home">

@yield('content')
  
@include('layout.footer')

@include('layout.popup')

{!! $head_setting->codebody !!}

@yield('script')

<style>
.pagination{}
.pagination span{
	background: #f48120;
    padding: 6px 12px;
}
.pagination li a{
	color: #fff;
    background: #1f59a3;
	padding: 6px 12px;
}
.pagination li{
	float: left;
    list-style: none;
    color: #fff;
    margin-right: 2px;
}
</style>

</body>
</html>