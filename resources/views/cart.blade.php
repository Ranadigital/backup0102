@include('layouts.frontendTopbar')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('/css/style.css')}}">
<style>
    .number {
        margin: 10px 0px;
        gap: 2px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<body>
    <div class="page-wrap ">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb py-2  d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="/"><img src="{{asset('/images/home-icon.svg')}}" class="img-fluid"> Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>

                </ol>
            </nav>
            <div class=" py-3">
                <div class="row">
                    <div class="col-md-8">
                        <div class="my-shopingcart">
                            <h1 class="mb-3">My Shopping Cart - <span id="cartItems">No Items</span></h1>
                            <div id="productView">
                                <div class="cart-box p-3 mb-3">
                                    <!-- <div class="media">
                                            <img class="mr-3 img-fluid" src="{{asset('/images/item-01.png')}}" alt="image" >
                                        </div>
                                        <div class="media-body">
                                            <div class="heading d-flex align-items-center">
                                                <h5 class="mt-0">Quick Dry Short Sleeve Polo Shirt</h5>
                                                <span>
                                                    <img src="{{asset('images/delete.svg')}}">
                                                </span>
                                            </div>
                                            <div class="text-miles mb-3">3450 Miles</div>
                                            <div class="select-item-detials d-flex">
                                                <ul class="m-0 p-0">
                                                    <li>Item Code:  <span>ABE054243S345</span></li>
                                                    <li>Color: <span>Blue</span></li>
                                                    <li>Size: <span>S</span></li>
                                                </ul>
                                                <div class="edit-item">
                                                    <select class="form-select w-auto d-inline-block" aria-label="Default select example">
                                                      <option selected>1</option>
                                                      <option value="1">2</option>
                                                      <option value="2">3</option>
                                                      <option value="3">4</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- <a href="#" class="move-favorites"> Move to favorites</a> -->
                                    <!--</div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="product-details">
                            <div class="purchased-count">
                                <h4 class="title mb-3">Have A Promo Code?</h4>
                                <div class="promo d-flex align-items-center">
                                    <input type="text">
                                    <a href="#" class="apply">Apply</a>
                                </div>
                            </div>
                            <div class="purchased-count filter-saprator">
                                <h4 class="title mb-2">Order Summary</h4>
                                <div class="summary-box p-3">
                                    <!-- <div class="purchased-count col-md-12" id="orderSummary">
                                        
                                    </div> -->
                                        <table style="width: 100%;">
                                            <thead>
                                                <th><h6>Product</h6></th>
                                               
                                                <th class="pull-right"><h6>Required Miles</h6></th>
                                            </thead>
                                            <tbody id="orderSummary">
                                              
                                            </tbody>
                                        </table>
                                    <div class="summary d-flex mt-2 pt-2 border-top">
                                        
                                        <span>Total</span>
                                        <span id="cartVal"></span>
                                    </div>
                                    <div class="proceedbtn  w-100 mt-4">
                                        <a href="javascript:void(0)" class="py-2 px-4 d-block  text-center" onclick="createOrderRequest()">Proceed to checkout</a>
                                    </div>
                                </div>
                            </div>
                            <div class="d-none" id="orderForm">
                                <form name="order_form" id="order_form" method="post" enctype="multipart/form-data" action="{{url('orders')}}">
                                    {{ csrf_field() }}
                                    <input type="hidden" class="form-control" name="orderData" id="orderData" value="">
                                    <button type="submit" class="d-none btn btn-primary float-right nameButton" id="order_form-store"> Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @php
        if(isset($_GET['order'])){
            $failedOrder = true;
        }else{
            $failedOrder = false;
        }
        
        if(isset($_GET['productStr'])){
            $productStr = $_GET['productStr'];
        }else{
            $productStr = '';
        }
        
    @endphp
    @include('layouts.frontendFooter')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="https://chir.ag/projects/ntc/ntc.js"></script>
    <script>
        function createOrderRequest() {
            if ($.cookie("rewardSbCart")) {
                let cartData = $.cookie("rewardSbCart");
                $('#orderData').val(cartData);
                let orderData = $('#orderData').val();
                if (orderData != '') {
                    //$.cookie('rewardSbCart', '', { expires: 7, path: '/' });
                    $("#order_form-store").click();
                }
            }
        }

        function updateCartStr(productId, productCount) {
            var product = '';
            if ($.cookie("rewardSbCart")) {
                product = $.cookie("rewardSbCart");

            }
            var newcartStr = '';
            if (product != '') {
                let updateCartStr = '';
                let prodExist = false;
                let productArray = product.split('/');
                for (let i = 0; i < productArray.length; i++) {
                    let arrayProductStr = productArray[i].split('-');
                    if (parseInt(arrayProductStr[0]) === parseInt(productId)) {
                        let preCount = arrayProductStr[1];
                        console.log("newcartStrInLoop:" + updateCartStr);
                        if (updateCartStr == '') {
                            updateCartStr = productId + '-' + productCount;
                        } else {
                            updateCartStr = updateCartStr + '/' + productId + '-' + productCount;
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

            $.cookie('rewardSbCart', newcartStr, {
                expires: 7,
                path: '/'
            });
            getCartView();
        }

        function getCartHtml(productArray) {
            var totalCount = 0;
            var cartVal = 0;
            var cartHtmal = '';
            var cartSummaryHtml = '';
            let cartCount = productArray.length;
            $('#cartItems').html(cartCount);
            let unavailableProductStr = '{{$productStr}}';
          
            for (var i = 0; i < cartCount; i++) {
                let product = productArray[i];
                let productId = product.productId;
                
                let productAvailableCount = 0;
                let productCost = 0;
                let productCount = 0;
                let productTotalCost =0;
                
                // console.log(unavailableProductStr.includes(productId));
                // console.log(!unavailableProductArray.includes(productId));
                if(!unavailableProductStr.includes(productId)){
                    productAvailableCount = product.productAvailableCount;
                    productCost = product.productCost;
                    productCount = product.productCount;
                    productTotalCost = product.productTotalCost;
                }
                
                let productName = product.productName;
                totalCount = totalCount + productCount;
                cartVal = cartVal + productTotalCost;
                let colorHexVal = '#' + product.product_color;
                let color = ntc.name(colorHexVal);
                let productColor = color[1];
                let productCode = product.productCode;
                let productSize = product.productSize;
                let productImage = product.productImage;
                let loopCount = 9;
                // cartSummaryHtml = cartSummaryHtml+'<tr><th>'+productName+'</br> ('+ productCost+' *' +productCount+')</th><th></th><th class="pull-right">  '+productTotalCost.toLocaleString()+' </th></tr>';
                cartSummaryHtml = cartSummaryHtml+'<tr class="pb-2"><td>'+productName+'</br> ('+ productCost+' * '+productCount+')</td><td class="pull-right" style="font-size: 17px;font-weight: 700;color: #4f4f4f">'+productTotalCost.toLocaleString()+'</td></tr>';
                cartHtmal = cartHtmal + '<div class="cart-box p-3 mb-3"><div class="media"><img class="mr-3 img-fluid" src="' + productImage + '" alt="image" ></div><div class="media-body"><div class="heading d-flex align-items-center"><h5 class="mt-0">' + productName + '</h5><span onclick="deletFromCart(' + productCode + ')"><img src="./public/images/delete.svg"></span></div><div class="text-miles mb-3">' + productCost + ' Miles</div><div class="select-item-detials d-flex"><ul class="m-0 p-0"><li>Item Code:  <span>' + productCode + '</span></li>';

                // if(productColor){
                //     cartHtmal = cartHtmal+'<li>Color: <span>'+productColor+'</span></li>';
                // }
                if (productSize) {
                    cartHtmal = cartHtmal + '<li>Size: <span>' + productSize + '</span></li>';
                }
                cartHtmal = cartHtmal + '<li>Quantity: <span>' + productCount + '</span></li></ul><div class="edit-item">';
                cartHtmal = cartHtmal + '<div class="number"><span id="minusSpan'+productId+'"><button class="minus" onclick="minusCart(' + productId + ', '+productAvailableCount+')" id="minusBtn-'+productId+'">&minus;</button></span><input type="number" readonly min="1" id="' + productId + '" data-productId="' + productId + '" value="' + productCount + '" maxlength="10" /><span id="plusSpan'+productId+'"><button class="plus" id="plusBtn-'+productId+'" onclick="plusCart(' + productId + ', '+productAvailableCount+')">&plus;</button></span></div><span id="'+productId+'error">';
                if(productCount === 0){
                    cartHtmal = cartHtmal + 'Product Unavailable, </br>Please remove from Cart.</span>';
                }else{
                    cartHtmal = cartHtmal + '</span>';
                }

                
                // cartHtmal = cartHtmal+'<select class="form-select w-auto d-inline-block selectVal" aria-label="Default select example" id="'+productId+'" data-productId="'+productId+'" onchange="updateCartCount('+productId+')">';
                //cartHtmal = cartHtmal+'<select class="form-select w-auto d-inline-block selectVal" aria-label="Default select example" id="'+productId+'" data-productId="'+productId+'">';
                // for(var k = 1; k < loopCount; k++){
                //     if(k == productCount){
                //         cartHtmal = cartHtmal+'<option selected="selected" value="'+k+'">'+k+'</option>';
                //     }else{
                //         cartHtmal = cartHtmal+'<option  value="'+k+'">'+k+'</option>';
                //     }
                // }
                // cartHtmal = cartHtmal+'</select>';
                cartHtmal = cartHtmal + '</div></div></div></div>';

            }
            $('#productView').html(cartHtmal);
            $('#orderSummary').html(cartSummaryHtml);
            $('#cartVal').html(cartVal.toLocaleString());

        }

        function updateCartCount(productId, availableCount) {
            let newproductCount = $('#' + productId).val();
            // if(newproductCount > availableCount){
            //     minusCart(productId, availableCount);
            // }else 
            if(newproductCount <= availableCount){
                 updateCartStr(productId, newproductCount);
            }
            
        }

        // $('.selectVal').change(function(){
        //     alert('he');
        // });
        $(document).ready(function() {
           let failedOrder = '{{$failedOrder}}';
           if(failedOrder){
            alert('Your order is not process, because product is not available.');
           }
            getCartView();
        });

        function getCartView() {
            if ($.cookie("rewardSbCart")) {

                $.ajax({
                    dataType: "json",
                    type: "post",
                    url: "{{url('get-cart-view')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'product': $.cookie("rewardSbCart")
                    }
                }).done(function(data) {
                    var htmlOption = '';
                    if (data.code == 200) {
                        let productArray = data.data;
                        getCartHtml(productArray);
                    }
                });

            } else {
                $('#productView').html('Cart is Empty!');
                $('#cartVal').html(0);
            }
        }

        function deletFromCart(productId) {
            $.ajax({
                dataType: "json",
                type: "post",
                url: "{{url('get-cart-view')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'product': $.cookie("rewardSbCart"),
                    'productId': productId
                }
            }).done(function(data) {
                var htmlOption = '';
                if (data.code == 200) {
                    let productArray = data.data;
                    getCartHtml(productArray);
                    let newCartStr = data.newCartStr;
                    $.cookie('rewardSbCart', newCartStr, {
                        expires: 7,
                        path: '/'
                    });
                    getHeaderCartCount();
                }
            });
        }

        function minusCart(productId, availableCount) {
            let plusButtonId = 'plusBtn-'+productId;
            let minusButtonId = 'minusBtn-'+productId;
            document.getElementById(plusButtonId).disabled = true;
            document.getElementById(minusButtonId).disabled = true;
            let productCount = document.getElementById(productId).value;
            var count = parseInt(productCount) - 1;
            count = count < 1 ? 1 : count;
            // if (productCount > availableCount) {
            //     //deletFromCart(productId);
            //     document.getElementById(productId).value = count;
            // }
             if(count != 0 ){
                document.getElementById(productId).value = count;
                updateCartCount(productId, availableCount);
            } 

            return false;
        }

        function plusCart(productId, availableCount) {
            let plusButtonId = 'plusBtn-'+productId;
            let minusButtonId = 'minusBtn-'+productId;
            document.getElementById(plusButtonId).disabled = true;
            document.getElementById(minusButtonId).disabled = true;
            let productCount = document.getElementById(productId).value;
            let count = parseInt(productCount) + 1;
            let processFlag = false;
            let processCountFlag = false;
            if( count > parseInt(availableCount)){
                processFlag =false;
                processCountFlag =true;
            }else if(count <= 10){
                processFlag =true;
                processCountFlag =false;
            }
            // if (count < 10 && count <= parseInt(availableCount)) {
            //     processFlag =true;
                
            // }else {
            //     processFlag =false;
                
            // }
            console.log(processFlag);
            document.getElementById(productId).value = count;
            if(processFlag){
                updateCartCount(productId, availableCount);
            }else{
                minusCart(productId, availableCount);
                if(processCountFlag){
                    let errorId = productId+'error';
                    let errorMessage = `Only ${availableCount}. left in stock`;
                    console.log(errorId);
                    let element = document.getElementById(errorId);
                    // element.innerHTML = errorMessage;

                        setTimeout(function() {
                            element.innerHTML = errorMessage;
                        }, 0);
                        setTimeout(function() {
                            element.innerHTML = '';
                        }, 5000);
                    
                        // minusCart(productId, availableCount);
                    return false;   
                }
               
            }


        }
    </script>
</body>

</html>
