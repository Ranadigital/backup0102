@include('layouts.frontendTopbar')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('/css/style.css')}}">
<style>
    #loadMore {
        width: 200px;
        color: #fff;
        display: block;
        text-align: center;
        margin: 20px auto;
        padding: 10px;
        border-radius: 10px;
        border: 1px solid transparent;
        background-color: black;
        transition: .3s;
    }

    #loadMore:hover {
        color: black;
        background-color: #fff;
        border: 1px solid black;
        text-decoration: none;
    }

    .noContent {
        color: #000 !important;
        background-color: transparent !important;
        pointer-events: none;
    }

    .product {
        display: none;
    }
</style>

<body>
    <div class="page-wrap">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                @php
                $catId = Helper::skill_crypt($category->id,'e');
                $categoryUrl = '/'.$catId;

                @endphp
                <ol class="breadcrumb py-2  d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="{{url('')}}"><img src="{{asset('/images/home-icon.svg')}}" class="img-fluid"> Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{url($categoryUrl)}}">{{$category->category_name}}</a></li>
                </ol>
            </nav>
            <div class="srp-banner d-flex align-items-center">
                <h1 class="text-center w-100">{{$category->category_name}}</h1>
            </div>
            <div class="main-content py-3">
                <div class="row">
                    <div class="col-md-4 ">
                        <div class="aside-filter px-3 d-block">
                            <div class="title">Apply Filter</div>
                            <div class="sidebar-filters">
                                <div class="form-check">
                                    <input class="form-check-input resetChk " type="checkbox" value="" onclick="resetFilters()">
                                    <label class="form-check-label" for="allbrands">
                                        Reset checkbox
                                    </label>
                                </div>
                                @if(isset($subCategory) && count($subCategory) > 0)
                                <div class="category-filters pb-3">
                                    <div class="title">Shop by Category <span></span></div>
                                    <ul>
                                        @foreach($subCategory as $subCategoryKey=>$category)
                                        @php
                                        $categoryFilterName = 'subcat'. $category->id;
                                        @endphp
                                        <div class="form-check">
                                            <input class="form-check-input categoryCheckBox filterChk" type="checkbox" value="" id="{{$categoryFilterName}}" onclick="setFilters()" data-category="{{$categoryFilterName}}" data-type="category">
                                            <label class="form-check-label" for="{{$categoryFilterName}}">
                                                {{$category->category_name}}
                                            </label>
                                        </div>



                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <div class="range-filters filter-saprator pb-4">
                                    <div class="title">Miles Points <span></span></div>
                                    <div class="range-slider">
                                        <span class=" rangeValues"></span>
                                        <input value="{{$minPriceVal}}" min="{{$minPriceVal}}" max="{{$maxPriceVal}}" step="500" type="range" class="priceSlider" id="sliderMin" name="sliderMin">
                                        <input value="{{$maxPriceVal}}" min="{{$minPriceVal}}" max="{{$maxPriceVal}}" step="500" type="range" class="priceSlider" id="sliderMax" name="sliderMax">
                                    </div>
                                </div>
                                <!-- @if(isset($color) && count($color) > 0)
                                <div class="color-filters filter-saprator accordion pb-3" id="">
                                    <div class="title">Color <span></span></div>
                                    <ul>
                                        @foreach($color as $colorKey=>$colorVal)

                                        <div class="form-check">
                                            <input class="form-check-input colorCheckBox filterChk" type="checkbox" value="" id="{{$colorVal->product_color}}" onclick="setFilters()" data-color="{{$colorVal->product_color}}" data-type="color">





                                            <label class="form-check-label theme-circle white-theme color" for="{{$colorVal->product_color}}" style="background-color: #{{$colorVal->product_color}}">

                                            </label>
                                        </div>


                                        @endforeach

                                    </ul>
                                </div>
                                @endif -->
                                @if(isset($brand) && count($brand) > 0)
                                <div class="brand-filters filter-saprator pb-3">
                                    <div class="title">Shop by Brands <span></span></div>
                                    @foreach($brand as $brandkey=>$brandVal)
                                    <div class="form-check">
                                        @php
                                        //$brandFilterName = str_replace(' ', '', $brandVal->brand_name);

                                        $brandFilterId = 'brand'.$brandVal->id;
                                        @endphp
                                        <input class="form-check-input brandCheckBox filterChk" type="checkbox" value="" id="{{$brandFilterId}}" onclick="setFilters()" data-brand="{{$brandFilterId}}" data-type="brands">


                                        <label class="form-check-label" for="{{$brandFilterId}}">
                                            {{$brandVal->brand_name}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="poduct-item-wrapper">
                            <div class="row gx-2" id="defaultProduct">
                                @php
                                $priceArray = [];
                                @endphp
                                @foreach($products as $productKey=>$productVal)
                                @php
                                //$brandName = str_replace(' ', '', $productVal->brand_name);

                                //$categoryName = str_replace(' ', '', $productVal->sub_category_name);

                                $brandId = 'brand'.$productVal->product_brand_id;

                                $subCategoryId = 'subcat'.$productVal->product_subcategory_id;

                                @endphp
                                <div class="col-md-4 col-6 product
                                            {{$brandId}} {{$productVal->product_cost}} {{$productVal->product_color}} {{$productVal->product_size}} {{$subCategoryId}}" data-product-price="{{$productVal->product_cost}}" data-product-color="{{$productVal->product_color}}" data-product-sub_category_name="{{$productVal->sub_category_name}}" data-product-brand_name="{{$productVal->brand_name}}" data-product-id="{{$productVal->productId}}Div" id="{{$productVal->productId}}Div">
                                    <div class="item mb-3">
                                        <div class="item-img">

                                            <?php
                                            $imgName = $productVal->productImage;
                                            $imgUrl = 'images/product/' . $imgName;
                                            $imageUrl = asset($imgUrl);
                                            $productId = Helper::skill_crypt($productVal->productId, 'e');
                                            $productUrl = '/product/' . $productId;
                                            array_push($priceArray, $productVal->product_cost);
                                            ?>
                                            <a href="{{url($productUrl)}}" class="text-center"> <img src="{{$imageUrl}}" class="img-fluid"></a>
                                        </div>
                                        <div class="item-content bg-white p-3">
                                            <div class="title mb-3 d-block">
                                                <a href="{{url($productUrl)}}" style="color:black;text-decoration:none;" class="card-text d-block categories mb-0"> {{$productVal->product_name}} </a>
                                               <h5 class="card-title miles_title "> {{number_format($productVal->product_cost)}} Miles</h5>
                                            </div>
                                            <a href="{{ url($productUrl) }}" class="read-more px-4 py-2 d-inline-block">Read More</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @php

                                $minPrice = min($priceArray)-10;
                                $maxPrice = max($priceArray)+1000;
                                @endphp

                            </div>
                            <a href="#" id="loadMore">Load More</a>
                            <div class="row" id="filterProduct">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.frontendFooter')
    <script>
        $(document).ready(function() {
            let maxval = '{{$maxPrice}}';
            let minval = '{{$minPrice}}';
            $("#sliderMin").attr({
                "max": maxval,
                "min": minval
            });
            $("#sliderMax").attr({
                "max": maxval,
                "min": minval
            });
            $("#sliderMin").val(minval);
            $("#sliderMax").val(maxval);
            var applyFilter = false;
        });
        var imageUrl = '{{$categoryImageUrl}}';
        $('.srp-banner,html').css('background-image', 'url(' + imageUrl + ')');

        function showColorProduct(color) {
            $('.product').hide();
            $('.' + color).show();
        }

        function checkProductPrice(minPrice, maxPrice, price) {
            if ((Number(price) > Number(minPrice) && Number(price) < Number(maxPrice)) || (Number(price) == Number(minPrice)) || (Number(price) == Number(maxPrice))) {
                return true;
            } else {
                return false;
            }

        }

        function resetFilters() {
            applyFilter = false;
            $(".filterChk").prop("checked", false);
            $(".resetChk").prop("checked", false);
            $('.product').show();

        }

        function setRangeFilterForProduct(minPrice, maxPrice) {
            $('.product').each(function(i, productObj) {
                let activeProd = productObj.id;
                let productPrice = $('#' + activeProd).attr("data-product-price");
                let chkPrice = checkProductPrice(minPrice, maxPrice, productPrice);
                if (chkPrice) {
                    $('#' + activeProd).show();
                } else {
                    $('#' + activeProd).hide();
                }
            });
        }

        function setFilterForBrand(name, type) {
            let chkFlag = false;
            $('.' + type).each(function(i, obj) {
                if ($("#" + obj.id).prop('checked') == true) {
                    chkFlag = true;
                };
            });
            if (chkFlag == true) {
                if ($("#" + name).prop('checked') == true) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }

        }

        function filterIschecked() {
            let resetFilter = true;
            $('.filterChk').each(function(i, obj) {
                if ($("#" + obj.id).prop('checked') === true) {
                    resetFilter = false;
                }
            });
            return resetFilter;
        }

        function setFilters() {
            $('.product').hide();

            var sliderMin = $('#sliderMin').val();
            var sliderMax = $('#sliderMax').val();

            let chkCount = 0;
            let minPrice = $('#sliderMin').val();
            let maxPrice = $('#sliderMax').val();
            $('.filterChk').each(function(i, obj) {
                if ($("#" + obj.id).prop('checked') == true) {
                    let activeFilterId = obj.id;
                    let filterType = $('#' + activeFilterId).attr("data-type");
                    $('.' + activeFilterId).each(function(key, object) {
                        let productPrice = $("#" + object.id).attr("data-product-price");
                        let chkPrice = checkProductPrice(minPrice, maxPrice, productPrice);
                        if (chkPrice) {
                            let showFlg = true;
                            if (filterType == 'category') {
                                let productBrand = $("#" + object.id).attr("data-product-brand_name");
                                let productColor = $("#" + object.id).attr("data-product-color");
                                let chkBrandFlag = setFilterForBrand(productBrand, 'brandCheckBox');
                                let chkColorFlag = setFilterForBrand(productColor, 'colorCheckBox');
                                if (!chkBrandFlag || !chkColorFlag) {
                                    showFlg = false;
                                }
                            } else if (filterType == 'brands') {
                                let productCat = $("#" + object.id).attr("data-product-sub_category_name");
                                let productColor = $("#" + object.id).attr("data-product-color");
                                let chkCategoryFlag = setFilterForBrand(productCat, 'categoryCheckBox');
                                let chkColorFlag = setFilterForBrand(productColor, 'colorCheckBox');
                                if (!chkCategoryFlag || !chkColorFlag) {
                                    showFlg = false;
                                }
                            } else if (filterType == 'color') {
                                let productCat = $("#" + object.id).attr("data-product-sub_category_name");
                                let chkCategoryFlag = setFilterForBrand(productCat, 'categoryCheckBox');
                                console.log(object.id);
                                let productBrand = $("#" + object.id).attr("data-product-brand_name");
                                let chkBrandFlag = setFilterForBrand(productBrand, 'brandCheckBox');
                                // let chkCategoryFlag = setFilterForBrand(productColor, 'colorCheckBox');
                                if (!chkCategoryFlag || !chkBrandFlag) {
                                    showFlg = false;
                                }
                            }
                            if (showFlg) {
                                $("#" + object.id).show();
                                chkCount = chkCount + 1;
                            }
                        }
                    });
                }
            });
            if (chkCount == 0) {
                let chkFilter = filterIschecked();
                if (chkFilter) {
                    resetFilters();
                }
                return false;
            } else {
                applyFilter = true;
                return true;
            }
        }

        $('.priceSlider').change(function() {
            let filters = setFilters();
            if (!filters) {
                let minPrice = $('#sliderMin').val();
                let maxPrice = $('#sliderMax').val();
                setRangeFilterForProduct(minPrice, maxPrice);
            }
        });



        function getVals() {
            // Get slider values
            let parent = this.parentNode;
            let slides = parent.getElementsByTagName("input");
            let slide1 = parseFloat(slides[0].value);
            let slide2 = parseFloat(slides[1].value);
            // Neither slider will clip the other, so make sure we determine which is larger
            if (slide1 > slide2) {
                let tmp = slide2;
                slide2 = slide1;
                slide1 = tmp;
            }

            let displayElement = parent.getElementsByClassName("rangeValues")[0];
            displayElement.innerHTML = slide1 + " - " + slide2;
        }
        window.onload = function() {
            // Initialize Sliders
            let sliderSections = document.getElementsByClassName("range-slider");
            for (let x = 0; x < sliderSections.length; x++) {
                let sliders = sliderSections[x].getElementsByTagName("input");
                for (let y = 0; y < sliders.length; y++) {
                    if (sliders[y].type === "range") {
                        sliders[y].oninput = getVals;
                        // Manually trigger event first time to display values
                        sliders[y].oninput();
                    }
                }
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $(".product").slice(0, 6).show();
            $("#loadMore").on("click", function(e) {
                e.preventDefault();
                $(".product:hidden").slice(0, 6).slideDown();
                if ($(".product:hidden").length == 0) {
                    $("#loadMore").text("No More Products").addClass("noContent");
                }
            });

        })
    </script>
</body>

</html>