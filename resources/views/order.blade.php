<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/compiled-4.20.0.min.css">
<link href="{{asset('/css/style.css')}}" rel="stylesheet">
<style>
    textarea.form-control {
        height: 100px;
    }
</style>
</head>

<body>
    @include('layouts.frontendTopbar')
    <div class="page-wrap bg-white">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb py-2  d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="/"><img src="{{asset('/images/home-icon.svg')}}" class="img-fluid"> Home</a></li>
                    <li class="breadcrumb-item active check_out" aria-current="page">Checkout</li>
                </ol>
            </nav>

            <div class=" py-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="my-checkout">
                            <h1 class="mb-3">Checkout </h1>

                            <div class="new">
                                <div class="notes p-3 mb-3">
                                    <p class="mb-3"><a href="">Important information for alcohol purchase:</a> Please read the <a href="">terms and conditions</a> regarding purchase of alcohol before you proceed. You are Not
                                        permitted to purchase liquor if you ar flying to any domestic destination within Oman.</p>

                                    <p><a href="https://sindbad.omanair.com/terms-and-conditions">Domestic passengers:</a> Please note that you are not permitted to collect any product from the Muscat Duty free store if you are arriving form a domestic destination into Muscat International Airport namely from Salalah, Khasab and Duqm.</p>
                                </div>
                                <div class="order-summary-wrapper p-3">
                                    <div class="order-details">
                                        <div class="title">
                                            <span><img src="{{asset('/images/cart.svg')}}" class="img-fluid"></span>
                                            Your Order Details
                                        </div>
                                        <div class="order-info">
                                            <div class="title mt-3 mb-3">Your Order</div>
                                            <div class="item">
                                                <span>Product</span>
                                                <span>Miles</span>
                                            </div>
                                            <div id="productSeleted">
                                                @if(isset($resArray) && !empty($resArray))
                                                @foreach($resArray as $productKey=>$productVal)
                                                <div class="item">
                                                    <span>
                                                        {{$productVal['productName']}} ( {{number_format($productVal['productCost'])}} miles * {{$productVal['productCount']}} )
                                                    </span>
                                                    <span>
                                                        {{number_format($productVal['productCostTotal'])}} miles
                                                    </span>
                                                </div>
                                                @endforeach
                                                @endif
                                                <div class="item">
                                                    <span><b>Total</b></span>
                                                    <span><b>
                                                            @if(isset($orderCost) && !empty($orderCost))
                                                            {{number_format($orderCost)}} miles
                                                            @else
                                                            0 miles
                                                            @endif
                                                        </b>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-details">
                                        <div class="title">
                                            <span><img src="{{asset('/images/cart.svg')}}" class="img-fluid"></span>
                                            Order Delivery Information
                                        </div>
                                        @php
                                        $lower = 0 ;
                                        $upper = 86400 ;
                                        $step = 3600 ;
                                        $format = 'g:i A';
                                        $times = array();
                                        while ($lower < $upper) { $times[]=date($format, $lower); $lower +=$step; } @endphp <div class="order-info">
                                            <div class="title mt-3">Delivery Details</div>
                                            <p class="sub-title">Enter extra information related to your order here</p>
                                            <form name="order_form" id="order_form" method="post" enctype="multipart/form-data" action="{{url('store-orders')}}">
                                                {{ csrf_field() }}
                                                <input type="hidden" id="cartStr" name="cartStr" @if(isset($cartStr) && !empty($cartStr))value="{{$cartStr}}" @else value="0" @endif>
                                                <div class="infoform">
                                                    <div class="dash-form-group mb-3">
                                                        <label>Date of Arrival / Departure in Muscat<span>*</span></label>
                                                        <input type="text" class="form-control required_field" id="datepicker"  name="datepicker" autocomplete="off">
                                                        <label id="datepicker-error"></label>
                                                    </div>
                                                    <div class="dash-form-group mb-3">
                                                        <label>Estimated time of Arrival / Departure in Muscat<span>*</span></label>
                                                        <select class="form-select required_field" aria-label="Default select example" id="expectedArrivals" name="expectedArrivals">
                                                            <option value="" selected>Please Select</option>
                                                            @foreach ($times as $key=>$timeVal )

                                                            <option value="{{(string) $timeVal}}">{{(string) $timeVal}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="dash-form-group mb-3">
                                                        <label>Flight No.<span>*</span></label>
                                                        <input type="text" class="form-control required_field"  id="flightNumber" name="flightNumber" autocomplete="off" maxlength="6">
                                                        <label id="flightNumber-error"></label>
                                                    </div>
                                                    <div class="dash-form-group mb-3">
                                                        <label>Are you a transit customer?<span>*</span></label>
                                                        <select class="form-select required_field" aria-label="Default select example" id="isTransitCust" name="isTransitCust">
                                                            <option selected value="">Please Select</option>
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>

                                                        </select>
                                                    </div>
                                                    <div class="dash-form-group mb-3">
                                                        <label>Point of Collection<span>*</span></label>
                                                        <select class="form-select required_field" aria-label="Default select example" id="collectionPoint" name="collectionPoint">
                                                            <option selected value="">Please Select</option>
                                                            <option value="Arrivals Duty Free Shop">Arrivals Duty Free Shop</option>
                                                            <option value="Departures Duty Free Shop">Departures Duty Free Shop</option>
                                                        </select>
                                                        <small>Terminal 1 Arrivals Duty Shop (Final destination is Muscat)</small>
                                                        <small>Terminal 1 Departures Duty Free Shop ( Transfer, transit and departing passengers)</small>
                                                    </div>
                                                    <div class="dash-form-group mb-3">
                                                        <label>Who will pick up the items<span>*</span></label>
                                                        <select class="form-select required_field" aria-label="Default select example" id="pickupPerson" name="pickupPerson">
                                                            <option selected value="">Please Select</option>
                                                            <option value="I will pick up the items">I will pick up the items</option>
                                                            <option value="My nominee will pick up the items">My nominee will pick up the items</option>

                                                        </select>
                                                    </div>
                                                    <div class="dash-form-group mb-3" id="nomineeDiv">
                                                        <label>Nominee name</label>
                                                        <input type="text" class="form-control required_field" id="nomineeName" name="nomineeName" autocomplete="off">
                                                    </div>
                                                    <div class="dash-form-group">
                                                        <label>Order Comments</label>
                                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="orderComments" rows="3" autocomplete="off"></textarea>
                                                    </div>
                                                </div>
                                                <div class="termsform filter-saprator pt-3">

                                                    <div class="form-check check_term">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" name="flexCheckChecked">
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                            I agree with the <a href="https://sindbad.omanair.com/terms-and-conditions">Terms and Conditions</a>
                                                            <span>
                                                                <small id="checkBoxHelp" class="text-danger"></small>
                                                        </label>
                                                    </div>
                                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                        <a href="/" class="btn btn-outline-secondary me-md-2">Continue Shopping</a>
                                                        <button class="btn btn-primary" type="button" id="order_form-submit" name="order_form-submit">Proceed to Order</button>
                                                        <button type="submit" class="d-none btn btn-primary float-right nameButton" id="order_form-store"> Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('layouts.frontendFooter')
    <!-- <script src="{{asset('js/jquery-3.6.1.min.js')}}"></script> -->
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script> -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!-- <script type="text/javascript" src="http://chir.ag/projects/ntc/ntc.js"></script> -->
    <!-- <script>
        $(function () {
            $("#datepicker").datepicker({
                maxDate: "+11m"
            });
        });
    </script> -->
    <script>
        $(document).ready(function() {
            // $("#datepicker").datepicker();
            $("#datepicker").datepicker({
                minDate: 0,
                maxDate: "+11m",
                onClose: function() {
                    setTimeInput($(this).val());
                }
            });
            $('#nomineeDiv').hide();
        });

        function formatedDate(date) {
            const dd = String(date.getDate()).padStart(2, '0');
            const mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
            const yyyy = date.getFullYear();
            const formatDate = mm + '/' + dd + '/' + yyyy;
            return formatDate;
        }

        function setTimesOption(time) {
            if (time != 26) {
                var x = 60; //minutes interval
                var times = []; // time array
                var tt = time * 60; // start time
                var ap = ['AM', 'PM']; // AM-PM

                //loop to increment the time and push results in array
                for (var i = 0; tt < 24 * 60; i++) {
                    var hh = Math.floor(tt / 60); // getting hours of day in 0-24 format
                    var mm = (tt % 60); // getting minutes of the hour in 0-55 format
                    times[i] = ("0" + (hh % 12)).slice(-2) + ':' + ("0" + mm).slice(-2) + ap[Math.floor(hh / 12)]; // pushing data in array in [00:00 - 12:00 AM/PM format]
                    tt = tt + x;
                }
                var $el = $("#expectedArrivals");
                $el.empty(); // remove old options
                $.each(times, function(key, value) {
                    $el.append($("<option></option>")
                        .attr("value", value).text(value));
                });
            }

        }

        function setTimeInput(date) {
            const today = new Date();
            const nextdate = new Date(+new Date() + 86400000);
            const todaysFromatedDate = formatedDate(today);
            const nextformatedDate = formatedDate(nextdate);
            const dHours = String(today.getHours()).padStart(2, '0');
            const dMinutes = String(today.getMinutes()).padStart(2, '0');;
            const currentTime = dHours + ':' + dMinutes;
            const nextmm = String(today.getMonth() + 1); //January is 0!
            console.log(todaysFromatedDate);
            console.log(nextformatedDate);
            console.log(date);
            console.log(currentTime);
            if (date === todaysFromatedDate) {
                let remaingHour = 24 - parseInt(dHours + 1);
                if (parseInt(remaingHour) < 13) {
                    setTimesOption(25);
                    $('#datepicker').addClass('is-invalid');
                    $(`#datepicker-error`).html(`<b>Note:</b> Please be informed there should be a difference of at least 12 hours between placing an order and order collection time.`);
                    $(`#datepicker`).removeClass('text-success');
                } else {
                    setTimesOption(dHours);
                    $('#datepicker').removeClass('is-invalid');
                    $(`#datepicker-error`).html(``);
                    $(`#datepicker`).addClass('text-success');
                }
            } else if (date === nextformatedDate) {
                $('#datepicker').removeClass('is-invalid');
                $(`#datepicker-error`).html(``);
                $(`#datepicker`).addClass('text-success');
                let remaingHour = 24 - parseInt(dHours);
                console.log('remaingHour' + remaingHour);
                let tomorrowRemaingHours = 12 - remaingHour;
                console.log('tomorrowRemaingHours' + tomorrowRemaingHours);
                if (tomorrowRemaingHours > 0) {
                    setTimesOption(tomorrowRemaingHours);
                } else {
                    setTimesOption(0);
                }

            } else {
                $('#datepicker').removeClass('is-invalid');
                $(`#datepicker-error`).html(``);
                $(`#datepicker`).addClass('text-success');
                setTimesOption(0);
            }

        }
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script type="text/javascript">
        // Form Submit
        $("#pickupPerson").change(function() {
            let pickuppersonVal = $('#pickupPerson').val();
            if (pickuppersonVal == 'My nominee will pick up the items') {
                $('#nomineeDiv').show();
            } else {
                $('#nomineeDiv').hide();
            }
        });
        $("#order_form-submit").click(function() {
            if ($("#flexCheckChecked").prop('checked') == true) {
                $('#checkBoxHelp').html('')
                var errorArray = [];
                $('.required_field').each(function() {
                    var id = $(this).attr("id");
                    console.log(id);
                    var status = setRequired(id);
                    if (status == false) {
                        errorArray.push(id);
                    }
                });
                if (errorArray.length) {
                    return false;
                } else {
                    
                    $("#order_form-store").click();
                }
            } else {
                $('#checkBoxHelp').html('Please accept Term and Conditions.')
            }


        });

        function setRequired(id) {
            var idVal = $.trim($('#' + id).val());
            console.log('setRequired'+id);
            if (id === 'nomineeName') {
                let pickuppersonVal = $('#pickupPerson').val();
                if (pickuppersonVal == 'My nominee will pick up the items' && idVal == '') {
                    $('#' + id).addClass('is-invalid');
                    $(`#${id}-error`).html(`The ${id} field is required.`);
                    $(`#${id}-icon`).removeClass('text-success');
                    return false;
                } else {
                    $('#' + id).removeClass('is-invalid');
                    $(`#${id}-icon`).addClass('text-success');
                    $(`#${id}-error`).html('');
                    return true;
                }
            
            }else if(id === 'datepicker'  && idVal == ''){
                $('#' + id).addClass('is-invalid');
                $(`#${id}-error`).html(`Please select your date of arrival/departure.`);
                $(`#${id}-icon`).removeClass('text-success');
                return false;
            }else if(id === 'flightNumber' && idVal != '' ){
                let flightNumberError = true;
                if(idVal.length == 6 || idVal.length == 5){
                    flightNumberError = false;
                }
                // if(idVal.length != 5){
                //     flightNumberError = true;   
                // }
                if(flightNumberError){
                    $('#' + id).addClass('is-invalid');
                    $(`#${id}-error`).html(`Please provide a valid Flight No. 5 or 6 characters in length.`);
                    $(`#${id}-icon`).removeClass('text-success');
                    return false; 
                }else{
                    $('#' + id).removeClass('is-invalid');
                    $(`#${id}-icon`).addClass('text-success');
                    $(`#${id}-error`).html('');
                    return true;  
                }
            }else if(id === 'flightNumber' && idVal == '' ){
           // else if(id === 'flightNumber' && (idVal == '' || idVal.length != 6)){console.log('flightNumber me aaya');
                $('#' + id).addClass('is-invalid');
                $(`#${id}-error`).html(`Flight number is required, Please provide flight number.`);
                $(`#${id}-icon`).removeClass('text-success');
                return false;
            }else if(idVal == '' ){
                $('#' + id).addClass('is-invalid');
                $(`#${id}-error`).html(`Please provide.`);
                $(`#${id}-icon`).removeClass('text-success');
                return false;
            } else {
                $('#' + id).removeClass('is-invalid');
                $(`#${id}-icon`).addClass('text-success');
                $(`#${id}-error`).html('');
                return true;
            }
        }

        function removeDisabled(storeType) {
            $(`#${storeType}-submit-spin`).addClass('d-none');
            $(`#${storeType}-submit`).prop('disabled', false);
        }
    </script>

</body>

</html>