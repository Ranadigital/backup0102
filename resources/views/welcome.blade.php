@include('layouts.frontendTopbar')


<!-- <link rel="stylesheet" href="{{asset('home-page/swiper/css/swiper-bundle.min.css')}}" /> -->
<!-- Swiper -->
@if(isset($bannres) && !empty($bannres))
<div id="slider_area">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach($bannres as $bannrekey =>$bannre)
            <div class="swiper-slide">
                <?php
                $image_name = $bannre->baneer_image_name;
                $imgUrl = 'images/banner/' . $image_name;
                $imageUrl = asset($imgUrl);
                ?>
                <img src="{{$imageUrl}}" alt="banner" class="img-fluid  swiper-lazy">
                <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>

                <div class="box_content text-center text-white">
                    <h1>{{$bannre->first_heading}}</h1>
                    <h1><strong>{{$bannre->second_heading}}</strong></h1>
                    @if(isset($bannre->button_link) && !empty($bannre->button_link))
                    <a href="{{$bannre->button_link}}">
                        <button type="button" class="btn btn_style my-4 text-white">Know More</button>
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>
@endif
<div class="page-wrap ">
    <div class="container-s">
        @if(isset($catData) && !empty($catData))
        <!-- product-listing -->
        <div class="product_list_area pb-5">
            <div class="container">
                @foreach($catData as $catKey=>$catval)
                <div class="row">
                    <div class="col-md-12 mb-0">
                        @php

                        $catId = Helper::skill_crypt($catval['category']['id'],'e');
                        $categoryUrl = '/'.$catId;
                        //print_R($catId);exit;
                        @endphp
                        <div class="head_style text-center">
                            <a href="{{url($catId)}}">
                                <h2 class="text-uppercase text-center pt-5 pb-4 cate_head">{{$catval['category']['name']}}</h2>
                            </a>
                        </div>
                        <!-- Swiper -->
                        @if(isset($catval['category']['products']) && count($catval['category']['products']) > 0)
                        <div class="swiper mySwiperproduct">
                            <div class="swiper-wrapper">
                                @foreach($catval['category']['products'] as $productKey=>$productVal)
                                <div class="swiper-slide">
                                    <div class="card border-0 ">
                                        <?php
                                        $image_name = $productVal->productImage;
                                        $imgUrl = 'images/product/' . $image_name;
                                        $imageUrl = asset($imgUrl);
                                        $productId =  Helper::skill_crypt($productVal->productId, 'e');
                                        $productUrl = '/product/' . $productId;
                                        ?>
                                        <a href="{{url($productUrl)}}" class="text-center"> <img src="{{$imageUrl}}" class="swiper-lazy  text-center card-img-top img-fluid" alt="img"></a>
                                        <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>

                                        <div class="card-body">
                                            <a href="{{url($productUrl)}}" style="color:black;text-decoration:none;">
                                                <p class="card-text categories mb-0">{{$productVal->product_name}}</p>
                                                <h5 class="card-title miles_title ">{{number_format($productVal->product_cost)}} Miles</h5>
                                            </a>
                                            <div class="btn_section d-flex justify-content-between align-items-center">
                                                <a href="{{url($catId)}}" class="btn buy_btn d-block">Buy More</a>
                                                <a href="{{url($productUrl)}}" class="btn d-block text-secondary">See More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>

                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@include('layouts.frontendFooter')
<!-- Swiper JS -->



<!-- Option 1: Bootstrap Bundle with Popper -->
<!-- <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('js/custom.js')}}"></script> -->

</body>

</html>