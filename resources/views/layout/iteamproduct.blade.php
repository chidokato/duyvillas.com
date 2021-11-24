<div class="owl_item_product product-col"> 
    <div class="product-box"> 
        <div class="product-thumbnail"> 
            <a class="image_link display_flex" href="{{$val->category->slug}}/{{$val->slug}}.html"> 
                <img class="img-pro" src="data/product/thumbnail/{{$val->img}}" data-lazyload="data/product/thumbnail/{{$val->img}}" alt="{{$val->name}}" />
            </a> 
        </div> 
        <div class="product-info effect a-left"> 
            <div class="info_hhh"> <h3 class="product-name  text1line"> <a class="bold" href="{{$val->category->slug}}/{{$val->slug}}.html">{{$val->name}}</a> </h3> 
                <div class="price-box clearfix">
                    @if($val->price)
                    <span class="price product-price">Giá bán: {{$val->price}}</span> 
                    @else
                    <span class="price product-price">Giá bán: Liên hệ</span> 
                    @endif
                </div> 
            </div> 
            <div class="description text1line" title="{{$val->address}}, {{$val->district->name}}, {{$val->district->city->name}}">
                {{$val->address}}, {{$val->district->name}}, {{$val->district->city->name}}
            </div> 
        </div> 
    </div> 
</div> 
