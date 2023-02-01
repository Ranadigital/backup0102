<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--  CSS -->
    <!-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/homestyle.css') }}">
        <link rel="stylesheet" href="{{asset('css/swiper-bundle.min.css')}}" />
 -->

    <link href="{{asset('home-page/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('home-page/css/style.css')}}">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"
    />
    <!-- <link rel="stylesheet" href="{{asset('home-page/swiper/css/swiper-bundle.min.css')}}" /> -->
    <script src="{{asset('js/swiper-bundle.min.js')}}"></script>
    <!--    
    <link href="{{asset('home-page/css/bootstrap.min.css')}}" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="{{asset('home-page/swiper/css/swiper-bundle.min.css')}}" /> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>sindbad</title>
    <style>
        .one {
            word-spacing: 10px;
        }

        #mySidepanel a {
            font-size: 1.1rem;
        }

        #mySidepanel a img {
            margin-right: 20px;
            width: 30px;
        }

        a.closebtn {
            font-size: 40px !important;
        }

        #mySidepanel a img,
        div#mySidepanel button img {
            margin-right: 20px;
            width: 25px;
        }

        div#mySidepanel button {
            background: transparent;
            color: #fff;
            padding: 8px 10px 8px 35px;
            border: none;
            width: 100%;
            text-align: left;
        }

        ul.list_total {
            list-style: none;
        }



        .header_right.d-flex.justify-content-end.align-items-center.g-3 {
            position: relative;
        }
        /* a.nav-link.px-2 {
    position: relative;
} */
        /* span#cartIconCount {
    background-color: #b19962;
    color: #fff;
    border-radius: 30px;
    width: 25px;
    height: 25px;
    display: inline-block;
    padding: 6px;
    position: absolute;
    top: -10px;
    font-weight: 500;
    font-size: 14px;
    left: 27px;
    text-align: center;
    line-height: 15px;
} */
        .search-box {
    position: absolute;
    top: 2px;
    right: 140px;
    min-width: 315px;
            display: none;
        }

        #search_head {
            position: relative;
            z-index: 2;
            cursor: pointer;
            color: #3d4044;
            padding-top: 9px;
        }
        span#cartIconCount {
    color: #000;
}
        .fa-search:before {
    content: "\f002";
    font-size: 18px;
}
        .search-box:before {
    content: "";
    position: absolute;
    top: -5px;
    transform: rotate(-30deg);
    right: 7px;
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    border-top: 14px solid transparent;
    border-bottom: 14px solid #b09963;
}

        .search-box input[type="text"] {
            width: 200px;
            padding: 5px 10px;
            margin-left: 23px;
            border: 1px solid #b09963;
            outline: none;

        }

        .search-box input[type="button"] {
            width: 80px;
            padding: 5px 0;
            background: #b09963;
            color: #fff;
            margin-left: -6px;
            border: 1px solid #b09963;
            outline: none;
            cursor: pointer;
        }
    </style>
   
</head>

<body>
    <header class="bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 col-4">
                    <div class="logo py-3">
                    <a href="/"> <img src="{{asset('images/Sindbad_Logo.png')}}" alt="logo" class="logo_width"></a>
                        <a href="/" class="border-left ms-2 ps-3"> <img src="{{asset('images/muscat-logo.png')}}" alt="logo" class="logo_width"></a>
                    </div>
                </div>
                <div class="col-md-4  col-7">
                    <div class="header_right d-flex justify-content-end align-items-center g-3">
                        <div class="icons">
                            <ul class="cart_link list-unstyled  d-flex justify-content-end align-items-center mb-0">
                                <li class="nav-item">
                                    <div class="input-groupn pe-3" id="chkSearch">
                                    <!-- <i class="bi bi-search" aria-hidden="true" id="search_head"></i> -->
         
                                        <i class="fa fa-search" aria-hidden="true" id="search_head"></i>
                                        <div class="search-box">
                                            <input type="text" id="searchInput" name="searchInput" placeholder="Search.." />
                                            <input type="button" value="Search" id="btn_search" onclick="searchSindbadData()" />
                                        </div>

                                    </div>
                                </li>

                                <li class="nav-item">
                                    <a href="{{url('cart')}}" class="nav-link px-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000" class="bi bi-bag" viewBox="0 0 16 16">
                                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                        </svg>
                                        <span id="cartIconCount"></span>
                                    </a>
                                </li>
                            </ul>
                            <a href="https://sindbad.omanair.com/terms-and-conditions" class="mt-1 terms_condition text-end d-block">Terms & conditions</a>
                        </div>
                        <button class="openbtn" onclick="openNav()">☰</button>
                    </div>
                    <div id="mySidepanel" class="sidepanel">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                        <a href="https://sindbad.omanair.com/SindbadProd/memberHome"> <img src="{{asset('images/user-icon-gold.svg')}}"> My Account</a>
                        <button id="drop_list4"><img src="{{asset('images/categoryn.svg')}}" class="drop_list4">Categories</button>
                        <ul class="list_total4" style="display: none; list-style:none;">
                        <li> <a class="dropdown-item drop-menue" href="{{url('czRBR0ZHc3duaDkydnV3Z1ZsTy9hZz09')}}"><span><img class="submenu-icon" src="{{asset('images/COSMETICS-MAKE-UP.svg')}}" alt="submenu icon">Cosmetics / Make-up </span> </a></li>
                        <li> <a class="dropdown-item drop-menue" href="{{url('OWhPeElIem9oREdmVWlHeVluMEpKUT09')}}"><span><img class="submenu-icon" src="{{asset('images/Electronics-Communication.svg')}}" alt="submenu icon">Electronics & Communication</span> </a></li>
                        <li> <a class="dropdown-item drop-menue" href="{{url('Y2pNUkYxa1BYWVd1OFBLT01KbWhGdz09')}}"><span><img class="submenu-icon" src="{{asset('images/FOOD-CONFECTIONERY.svg')}}" alt="submenu icon">Food & Confectionery </span> </a></li>
                        <li> <a class="dropdown-item drop-menue" href="{{url('ZUsyZFpoSGZrTTRXdVNTR3VHZzhvUT09')}}"><span><img class="submenu-icon" src="{{asset('images/FRAGRANCES.svg')}}" alt="submenu icon">Fragrances </span> </a></li>
                        <li> <a class="dropdown-item drop-menue" href="{{url('ZENTYmN3aDdLanlqNWNLYVF1M3dsQT09')}}"><span><img class="submenu-icon" src="{{asset('images/SKINCARE-PRODUCTS.svg')}}" alt="submenu icon">Skincare Products </span> </a></li>
                        <li> <a class="dropdown-item drop-menue" href="{{url('QUo1Y0w1bktQMDhEWHFqYjhWUWVHQT09')}}"><span><img class="submenu-icon" src="{{asset('images/TOYS.svg')}}" alt="submenu icon">Toys </span> </a></li>
                        <li> <a class="dropdown-item drop-menue" href="{{url('SWNseGhGbzJvNHhBMWVlWUdtVFlJUT09')}}"><span><img class="submenu-icon" src="{{asset('images/travel-luggage.svg')}}" alt="submenu icon">Travel & Luggage </span> </a></li>
                        <li> <a class="dropdown-item drop-menue" href="{{url('MHVtUnVOQ3M4Y3REcVNaaHBHY2x6dz09')}}"><span><img class="submenu-icon" src="{{asset('images/liquor.svg')}}" alt="submenu icon">Liquor </span> </a></li>
                        <li> <a class="dropdown-item drop-menue" href="{{url('YWUweTVEcERuRzFuZ0VzbVkvY0pmZz09')}}"><span><img class="submenu-icon" src="{{asset('images/tobacco.svg')}}" alt="submenu icon">Tobacco </span> </a></li>
                        </ul>
                        <button id="drop_list1"><img src="{{asset('images/benifits.svg')}}">Benefits </button>
                        <ul class="list_total" style="display: none; list-style:none;">
                            <li><a class="dropdown-item drop-menue" href="https://sindbad.omanair.com/sindbad-blue"><span><img class="submenu-icon" src="{{asset('images/economy-class.svg')}}" alt="submenu icon">Sindbad Blue Tier</span></a></li>
                            <li><a class="dropdown-item" href="https://sindbad.omanair.com/sindbad-silver"><span><img class="submenu-icon" src="{{asset('images/business-class-icon.svg')}}" alt="submenu icon">Sindbad Silver Tier</span></a></li>
                            <li><a class="dropdown-item" href="https://sindbad.omanair.com/sindbad-gold"><span><img class="submenu-icon" src="{{asset('images/first-class.svg')}}" alt="submenu icon">Sindbad Gold Tier</span></a></li>
                            <li><a class="dropdown-item" href="https://sindbad.omanair.com/junior-sindbad"><span><img class="submenu-icon" src="{{asset('images/junior.svg')}}" alt="submenu icon">Junior Sindbad</span></a></li>
                            <li><a class="dropdown-item" href="https://sindbad.omanair.com/digital-blue-cards"><span><img class="submenu-icon" src="{{asset('images/family.svg')}}" alt="submenu icon">Family Account</span></a></li>

                            <li><a class="dropdown-item" href="https://sindbad.omanair.com/digital-blue-cards"><span><img class="submenu-icon" src="{{asset('images/credit-card-2.svg')}}" alt="submenu icon">Sindbad Digital Card</span></a></li>
                        </ul>


                        <button id="drop_list2"><img src="{{asset('images/earn-miles.svg')}}" class="drop_list2">Earn Miles </button>
                        <ul class="list_total2" style="display: none; list-style:none;">
                            <li><a class="dropdown-item drop-menue" href="https://sindbad.omanair.com/earn-miles-with-omanair"><span><img class="submenu-icon" src="{{asset('images/omanair-logo-icon.svg')}}" alt="submenu icon">Earn miles with Oman Air </span></a></li>
                            <li><a class="dropdown-item drop-menue" href="https://sindbad.omanair.com/earn-miles-with-partners"><span><img class="submenu-icon" src="{{asset('images/partners.svg')}}" alt="submenu icon">Earn miles with partners</span></a></li>
                            <li><a class="dropdown-item drop-menue " href="https://sindbad.omanair.com/claim-your-missing-miles-online-in-real-time">
                                    <p><img class="submenu-icon" src="{{asset('images/increase.svg')}}" alt="submenu icon"></p>

                                    <p>Claim your missing miles online in Real Time!</p>
                                </a>
                            </li>
                            <li><a class="dropdown-item drop-menue" href="https://sindbad.omanair.com/SindbadProd/mileageCalculator"><span><img class="submenu-icon" src="{{asset('images/calculator_1.svg')}}" alt="submenu icon">Mileage Calculator</span></a></li>

                        </ul>

                        <button id="drop_list3"><img src="{{asset('images/spend-miles.svg')}}" class="drop_list3">Spend Miles </button>
                        <ul class="list_total3" style="display: none; list-style:none;">
                            <li><a class="dropdown-item drop-menue" href="https://sindbad.omanair.com/earn-miles-with-omanair"><span><img class="submenu-icon" src="{{asset('images/ticket.svg')}}" alt="submenu icon">Flight tickets and upgrades </span></a></li>
                            <li><a class="dropdown-item" href="https://sindbad.omanair.com/earn-miles-with-partners"><span><img class="submenu-icon" src="{{asset('images/baggage-allowance-icon.svg')}}" alt="submenu icon">Pre-paid Baggage</span></a></li>
                            <li><a class="dropdown-item" href="https://sindbad.omanair.com/claim-your-missing-miles-online-in-real-time"><span><img class="submenu-icon" src="{{asset('images/exchange-refund-icon.svg')}}" alt="submenu icon">Seat selection</span></a></li>


                        </ul>
                       
                        <a href="https://sindbad.omanair.com/special-offers"><img src="{{asset('images/offers.svg')}}">Special Offers</a>
                        <a href="https://sindbad.omanair.com/buy-gift-and-transfer-miles"><img src="{{asset('images/gold-gift-svgrepo-com-01.svg')}}">Buy,Gift,Transfer</a>
                        <a href="https://sindbad.omanair.com/winners"><img src="{{asset('images/special-services.svg')}}">Winners</a>
                        <a href="https://sindbad.omanair.com/partners"><img src="{{asset('images/partners.svg')}}">Partners</a>
                        <a href="https://sindbad.omanair.com/contact-us"><img src="{{asset('images/gold-phone-icon.svg')}}">Contact Us</a>
                        <a href="https://sindbad.omanair.com/faqs"><img src="{{asset('images/baggage-faq-icon.svg')}}">FAQs</a>
                       
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

        <script>
            $(document).ready(function() {
                $("#search_head").click(function() {
                    $(".search-box").show();
                    $("#searchInput").focus();
                });

            });
            $("#searchInput").keyup(function(event) {
                if (event.keyCode === 13) {
                    $("#btn_search").click();
                }
            });
            document.body.addEventListener('click', function(e) {
                let elem = document.querySelector('#search_head');
                let seachrInput = document.querySelector('#searchInput');
                let disableSeacrh = true;
                console.log(e.target);
                if (e.target == elem) {
                    disableSeacrh = false;
                } 
                if(e.target == seachrInput){
                    disableSeacrh = false;
                }
                console.log(disableSeacrh);
                if(disableSeacrh){
                    $(".search-box").hide();
                }
            });
            $(document).on('click', function (event) {
  if (!$(event.target).closest('.search-box').length) {
    // ... clicked on the 'body', but not inside of #menutop
  }
});
        </script>
        <script>
            $(document).ready(function() {
                $("#drop_list1").click(function() {
                    $(".list_total").toggle(300);
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $("#drop_list2").click(function() {
                    $(".list_total2").toggle(300);
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $("#drop_list3").click(function() {
                    $(".list_total3").toggle(300);
                });
            });
        </script>
         <script>
            $(document).ready(function() {
                $("#drop_list4").click(function() {
                    $(".list_total4").toggle(300);
                });
            });
        </script>
      
    </header>