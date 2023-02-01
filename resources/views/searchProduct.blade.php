@include('layouts.frontendTopbar')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('/css/style.css')}}">

<body>
    <div class="page-wrap">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb py-2  d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="{{url('')}}"><img src="{{asset('/images/home-icon.svg')}}" class="img-fluid"> Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Search</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center w-100">Search for {{$searchInput}}</h1>
                </div>
            </div>
            <div class="main-content my-3 py-0">
                <div class="row">
                    <div class="col-md-12">

                        <div class="poduct-item-wrapper">
                            <div class="row gx-2" id="defaultProduct">
                                @if(count($products) > 0)
                                @foreach($products as $productKey=>$productVal)
                                @php
                                //$brandName = str_replace(' ', '', $productVal->brand_name);

                                //$categoryName = str_replace(' ', '', $productVal->sub_category_name);

                                $brandId = 'brand'.$productVal->product_brand_id;

                                $subCategoryId = 'subcat'.$productVal->product_subcategory_id;

                                @endphp
                                <div class="col-md-3 col-6 product
                                                {{$brandId}} {{$productVal->product_cost}} {{$productVal->product_color}} {{$productVal->product_size}} {{$subCategoryId}}" data-product-price="{{$productVal->product_cost}}" data-product-color="{{$productVal->product_color}}" data-product-sub_category_name="{{$productVal->sub_category_name}}" data-product-brand_name="{{$productVal->brand_name}}" data-product-id="{{$productVal->productId}}Div" id="{{$productVal->productId}}Div">

                                    <div class="item mb-3">
                                        <div class="item-img">

                                            <?php
                                            $imgName = $productVal->productImage;
                                            $imgUrl = 'images/product/' . $imgName;
                                            $imageUrl = asset($imgUrl);
                                            $productId = Helper::skill_crypt($productVal->productId, 'e');
                                            $productUrl = '/product/' . $productId;

                                            ?>
                                            <a href="{{url($productUrl)}}" class="text-center"> <img src="{{$imageUrl}}" class="img-fluid"></a>
                                        </div>
                                        <div class="item-content bg-white p-3">
                                            <a href="{{url($productUrl)}}" style="color:black;text-decoration:none;" class="card-text categories mb-0 d-block">
                                                    {{$productVal->product_name}}
                                                  <h5 class="card-title miles_title">{{number_format($productVal->product_cost)}} Miles</h5>  
                                               
                                            </a>
                                            <a href="{{ url($productUrl) }}" class="read-more mt-3 px-4 py-2 d-inline-block">Read More</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <h1 class="text-center w-100">No Product found</h1>
                                @endif

                            </div>
                            <div class="row" id="filterProduct">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.frontendFooter')

</body>

</html>