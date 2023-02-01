@include('layouts.frontendTopbar')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('/css/style.css')}}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<!-- <link rel="stylesheet" href="{{ asset('css/homestyle.css') }}"> -->
<link rel="stylesheet" href="{{asset('css/swiper-bundle.min.css')}}" />
<link rel="stylesheet" href="{{asset('home-page/swiper/css/swiper-bundle.min.css')}}" />

<body>
    <div class="page-wrap bg-white">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                @php
                $catId = Helper::skill_crypt($productDetails->product_category_id,'e');
                $categoryUrl = '/'.$catId;

                @endphp
                <ol class="breadcrumb py-2  d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="{{url('')}}"><img src="{{asset('/images/home-icon.svg')}}" class="img-fluid"> Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{url($categoryUrl)}}">{{$productDetails->category_name}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$productDetails->sub_category_name}}</li>
                    <li class="breadcrumb-item active" aria-current="page">{{$productDetails->brand_name}}</li>
                    <li class="breadcrumb-item active" aria-current="page">{{$productDetails->product_name}}</li>
                </ol>
            </nav>
            <div class="main-content product-details-wrapper py-3">
                <div class="row">
                    <div class="col-md-8">
                        <div class="swiper-container-wrapper">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="swiper-container gallery-thumbs">
                                        <!-- Additional required wrapper -->
                                        <div class="swiper-wrapper">
                                            <!-- Slides -->
                                            @if(isset($productImages) && count($productImages) >= 1)
                                            @foreach($productImages as $productImageKey=>$productImagesVal)
                                            @php
                                            $imgName = $productImagesVal->image_name;
                                            $imgUrl = 'images/product/'.$imgName;
                                            $imageUrl = asset($imgUrl);
                                            @endphp
                                            <div class="swiper-slide">
                                                <img src="{{$imageUrl}}" class="img-fluid">
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="swiper-container gallery-top">
                                        <div class="swiper-wrapper">
                                            @if(isset($productImages) && count($productImages) >= 1)
                                            @foreach($productImages as $productImageKey=>$productImagesVal)
                                            @php
                                            $imgName = $productImagesVal->image_name;
                                            $imgUrl = 'images/product/'.$imgName;
                                            $imageUrl = asset($imgUrl);
                                            @endphp
                                            <div class="swiper-slide">
                                                <img src="{{$imageUrl}}" class="img-fluid">
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product-details">
                            <h1 class="title mb-4">
                                {{$productDetails->product_name}}
                            </h1>
                            <div class="milestitle mb-3">
                                {{number_format($productDetails->product_cost)}} Miles
                            </div>
                            <div class="itemcode mb-3">
                                <?php
                                $prodCode = strval($productDetails->productId);
                                ?>
                                Item Code: {{$prodCode}}
                            </div>
                            @if(isset($productDetails->product_color) && !empty($productDetails->product_color))
                            <div class="itemcolor">
                                <span class="title">Color</span> : <span class="selcolor" id="productColor"></span>
                                <div class="color-filters">
                                    <ul class="p-0 my-2">
                                        @if(isset($availablecolors) && count($availablecolors) > 0 )
                                        @php $colorArray = []; @endphp
                                        @foreach($availablecolors as $availablecolorKey=>$availablecolorVal)
                                        @if(!in_array($availablecolorVal->product_color, $colorArray))

                                        <li>
                                            @php
                                            $colorProductId = Helper::skill_crypt($availablecolorVal->id,'e');
                                            $colorUrl = '/product/'.$colorProductId;
                                            array_push($colorArray, $availablecolorVal->product_color);
                                            @endphp
                                            <a href="{{url($colorUrl)}}" class="theme-circle white-theme" style="background-color: #{{$availablecolorVal->product_color}}"></a>
                                        </li>
                                        @endif

                                        @endforeach
                                        @endif


                                    </ul>
                                </div>
                            </div>
                            @endif
                            @if(isset($productDetails->product_size) && !empty($productDetails->product_size))
                            @if(isset($availableSizes) && count($availableSizes) > 0 )
                            <div class="sizeguide ">
                                <span class="title">Size <b>{{$productDetails->product_size}}</b></span> : <span class="selcolor" style="text-decoration: none">Size Guide</span>
                                <div class="selectsize mt-2">
                                    {{-- @if(isset($availableSizes) && count($availableSizes) > 0 )--}}
                                    @php $sizeArray = []; @endphp
                                    @foreach($availableSizes as $availableSizeKey=>$availableSizeVal)
                                    @if(isset($availableSizeVal->product_size) && !empty($availableSizeVal->product_size))
                                    @if(!in_array($availableSizeVal->product_size, $sizeArray))
                                    @php
                                    $sizeProductId = Helper::skill_crypt($availableSizeVal->id,'e');
                                    $sizeUrl = '/product/'.$sizeProductId;
                                    array_push($sizeArray, $availableSizeVal->product_size);
                                    @endphp
                                    <input type="radio" name="productSize" value="{{$availableSizeVal->product_size}}" />
                                    <a href="{{url($sizeUrl)}}"><label for="{{$availableSizeVal->product_size}}">{{$availableSizeVal->product_size}}</label> </a>
                                    @endif
                                    @endif
                                    @endforeach
                                    {{--@endif --}}
                                </div>
                            </div>
                            @endif
                            @endif
                            @if(isset($productCount) && $productCount > 0 )
                                <div class="quantity mt-4">
                                    <h4 class="fw-600">Quantity</h4>
                                    <!--   <select class="form-select w-auto me-3 d-inline-block" aria-label="Default select example" id="quantity">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select> -->

                                    <div class="number">
                                        <span class="minus" onclick="minusCart('{{$productDetails->productId}}')">&minus;</span>
                                        <input type="number" value="1" maxlength="10" minlength="1" min="1" readonly id="quantity">
                                        <span class="plus" onclick="plusCart('{{$productDetails->productId}}')">&plus;</span>
                                        <span id="plusminuserror"></span>
                                    </div>
                                    
    				                    @if(isset($productCount) && $productCount > 0 )
                                            <a href="javascript: void(0)" class="add-to-cart px-4 py-2" onclick="addtoCart('{{$productDetails->productId}}')">Add to Cart</a>
                                        @endif
                                    
                                    <small id="cartHelp" class="text-success"></small>
                                    <small id="cartErrorHelp" class="text-danger"></small>
                                </div>
                            @else
                                <div class="quantity mt-4">
                                    <h4 class="fw-600">Currently Not Available</h4>
                                </div>
                            @endif
                            @if(isset($productCount) && $productCount < 5 && $productCount != 0 )
                           	<div class="purchased-count d-flex align-items-center my-4">
                                	<span class="me-3">
                                    		<img src="{{asset('images/lineup.svg')}}" class="img-fluid">
                                	</span>
                                	Only {{$productCount}} is available.

	                            </div>	
                                @endif
                            <div class="purchased-count filter-saprator border-0">
                                <!-- <h4 class="title mb-3">Product Description</h4>
                                <p class="text-description mb-2">
                                    @if(strlen($productDetails->product_description) > 80)
                                    @php
                                    $product_descriptionFirst = substr($productDetails->product_description,0,200);
                                    $strLength = strlen($productDetails->product_description);
                                    $product_descriptionSecond = substr($productDetails->product_description,201,$strLength);
                                    $readMoreStatus = true;
                                    @endphp
                                    @else
                                    @php
                                    $product_description = $productDetails->product_description;
                                    $readMoreStatus = false;
                                    @endphp
                                    @endif
                                    @if(!$readMoreStatus)
                                    {!! $product_description !!}
                                    @else
                                    {!! $product_descriptionFirst !!}<span id="dots">...</span><span id="more" style="display:none"> {!! $product_descriptionSecond !!}</span>
                                    @endif
                                </p> -->
                                @if($readMoreStatus)
                                <a href="javascript: void(0)" onclick="readMoreFunction()" class="read-more mb-3 d-block " id="myBtn">Read More</a>
                                @endif
                            </div>
                            @if(isset($deliveryOptions) && count($deliveryOptions) > 0 )
                            <div class="purchased-count">
                                <h4 class="title mb-3">Delivery Option</h4>
                                @foreach($deliveryOptions as $deliveryOptionKey=>$deliveryOptionVal)
                                <span class="filter-saprator title pt-2 d-block mb-2">
                                    {{$deliveryOptionVal->heading}}
                                </span>
                                <p>
                                    {!! $deliveryOptionVal->delivery_options_description !!}
                                </p>
                                @endforeach
                            </div>
                            @endif
                            <!-- <div class="social-media pt-4">
                                    <ul class="m-0 p-0 d-flex">
                                        <li><a href="#"><img src="./images/facebook.svg" class="img-fluid"></a></li>
                                        <li><a href="#"><img src="./images/twitter.svg" class="img-fluid"></a></li>
                                        <li><a href="#"><img src="./images/paintrest.svg" class="img-fluid"></a></li>
                                    </ul>
                                </div> -->
                        </div>
                    </div>
                    @if(isset($optionalProduct) && count($optionalProduct) > 0)
                    <div class="col-md-12">
                        <div class="poduct-item-wrapper mt-4">
                            <h1 class="title text-upper text-center mb-4">
                                You May Also like this
                            </h1>
                            <div class="row">
                                <div class="swiper mySwiperproduct">
                                    <div class="swiper-wrapper">
                                        @foreach($optionalProduct as $optionalProductKey=>$optionalProductval)
                                        <div class="swiper-slide">
                                            <div class="item mb-3">
                                                <div class="item-img">
                                                    @php
                                                    $imgName = $optionalProductval->productImage;
                                                    $imgUrl = 'images/product/'.$imgName;
                                                    $imageUrl = asset($imgUrl);
                                                    $productId = Helper::skill_crypt($optionalProductval->productId,'e');
                                                    $productUrl = '/product/'.$productId;
                                                    @endphp
                                                    <a href="{{url($productUrl)}}" class="text-center"><img src="{{$imageUrl}}" class="img-fluid"></a>
                                                </div>
                                                <div class="item-content p-3">
                                                    <a href="{{url($productUrl)}}" style="color:black;text-decoration:none;" class="card-text d-block categories mb-0 d-block">
                                                       
                                                            {{$optionalProductval->product_name}} 
                                                       
                                                    </a>
                                                    <div class="text-price card-title miles_title">{{number_format($optionalProductval->product_cost)}} Miles</div>
                                                    <div class="item-content py-3">
                                                        <a href="{{ url($productUrl) }}" class=" text-decoration-none read-more px-4 py-2 d-inline-block">Read More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('layouts.frontendFooter')
    <script src="{{asset('js/jquery-3.6.1.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script type="text/javascript" src="http://chir.ag/projects/ntc/ntc.js"></script>
    <script src="{{asset('js/swiper-bundle.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            let colorHexVal = '#' + '{{$productDetails->product_color}}';
            console.log(colorHexVal);
            var color = ntc.name(colorHexVal);
            console.log(color);
            $('#productColor').html(color[1]);


        });

        function addtoCart(productId) {
            var preCartStr = '';
            let productCount = $('#quantity').val();
            let productAvailableCount = '{{$productCount}}';
            console.log(productCount);
            if(productCount > parseInt(productAvailableCount)){
                $('#cartErrorHelp').html(function() {
                    setTimeout(function() {
                        $('#cartErrorHelp').html(`Item Quantity cannot be greater than ${productAvailableCount}.`);
                    }, 0);
                    setTimeout(function() {
                        $('#cartErrorHelp').html('');
                    }, 5000);
                });
            }else{
                if ($.cookie("rewardSbCart")) {
                    preCartStr = $.cookie("rewardSbCart");

                }
                console.log("prePordStr:" + preCartStr);
                
                let newCartStr = '';
                if (preCartStr != '') {
                    let updateCartStr = '';
                    let prodExist = false;
                    let productArray = preCartStr.split('/'); //product.split('/');
                    for (let i = 0; i < productArray.length; i++) {
                        let arrayProductStr = productArray[i].split('-');
                        if (parseInt(arrayProductStr[0]) === parseInt(productId)) {
                            let preCount = arrayProductStr[1];
                            console.log("newcartStrInLoop:" + updateCartStr);
                            let newCount = parseInt(preCount) + parseInt(productCount);
                            if (updateCartStr == '') {
                                updateCartStr = productId + '-' + newCount;
                            } else {
                                updateCartStr = updateCartStr + '/' + productId + '-' + newCount;
                            }
                            prodExist = true;
                        } else {

                            let preProductCount = arrayProductStr[1];
                            let preProductId = arrayProductStr[0];
                            if (updateCartStr == '') {
                                updateCartStr = preProductId + '-' + preProductCount;
                            } else {
                                updateCartStr = updateCartStr + '/' + preProductId + '-' + preProductCount;
                            }
                        }

                    }
                    if (!prodExist) {
                        updateCartStr = updateCartStr + '/' + productId + '-' + productCount;
                    }
                    newcartStr = updateCartStr;
                } else {
                    newcartStr = productId + '-' + productCount;
                }
                console.log("newcartStr:" + newcartStr);
                // let productCount = $('#quantity').val();console.log(productCount);
                // if(product != ''){
                //     product = product+'/'+productId+'-'+productCount;
                // }else{
                //     product = productId+'-'+productCount;
                // }
                console.log(newcartStr);
                $.cookie('rewardSbCart', newcartStr, {
                    expires: 7,
                    path: '/'
                });
                // console.log($.cookie("rewardSbCart"));
                getHeaderCartCount();
                $('#cartHelp').html(function() {
                    setTimeout(function() {
                        $('#cartHelp').html('Added to the cart.');
                    }, 0);
                    setTimeout(function() {
                        $('#cartHelp').html('');
                    }, 5000);
                });
            }
            
        }

        function minusCart(productId){
            let productCount = document.getElementById('quantity').value;
            var count = parseInt(productCount) - 1;
            count = count < 1 ? 1 : count;  
            document.getElementById('quantity').value = count;
            return false;
        }
        function plusCart(productId){
            let productCount = document.getElementById('quantity').value;
            let productAvailableCount = '{{$productCount}}';
            
            let count = parseInt(productCount) + 1;
            if( count > productAvailableCount){
                $('#plusminuserror').html(function() {
                    setTimeout(function() {
                        $('#plusminuserror').html('Only '+productAvailableCount+' quantity left.');
                    }, 0);
                    setTimeout(function() {
                        $('#plusminuserror').html('');
                    }, 5000);
                });
                return false;
            } else if(count <= 10){
                document.getElementById('quantity').value = count;
            }
            else{
                $('#plusminuserror').html(function() {
                    setTimeout(function() {
                        $('#plusminuserror').html('');
                    }, 0);
                    setTimeout(function() {
                        $('#plusminuserror').html('');
                    }, 5000);
                });
                return false;
            }

         
        }

        function readMoreFunction() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var btnText = document.getElementById("myBtn");

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "Read more";
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = "Read less";
                moreText.style.display = "inline";
            }
        }
        $(function() {
            var galleryThumbs = new Swiper(".gallery-thumbs", {
                centeredSlides: true,
                centeredSlidesBounds: true,
                direction: "horizontal",
                spaceBetween: 10,
                slidesPerView: 3,
                freeMode: false,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
                watchOverflow: true,
                breakpoints: {
                    480: {
                        direction: "vertical",
                        slidesPerView: 3
                    }
                }
            });
            var galleryTop = new Swiper(".gallery-top", {
                direction: "horizontal",
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                },
                a11y: {
                    prevSlideMessage: "Previous slide",
                    nextSlideMessage: "Next slide",
                },
                keyboard: {
                    enabled: true,
                },
                thumbs: {
                    swiper: galleryThumbs
                }
            });
            galleryTop.on("slideChangeTransitionStart", function() {
                galleryThumbs.slideTo(galleryTop.activeIndex);
            });
            galleryThumbs.on("transitionStart", function() {
                galleryTop.slideTo(galleryThumbs.activeIndex);
            });
        });
    </script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiperproduct", {
            slidesPerView: 2,
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
            },
        });
    </script>
</body>

</html>
