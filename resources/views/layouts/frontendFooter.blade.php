<footer class="footer_section bg-darktext-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h5>Call Us 24x7</h5>
                <p>Reach our call center at</p>
                <a href="tel:+968 2453 1111" style="text-decoration: none;">
                    <p class="text_style"> +968 2453 1111</p>
                </a>
            </div>
            <div class="col-md-3">
                <h5>Email Us</h5>
                <p>Please <a href="https://sindbad.omanair.com/SindbadProd/login" class="text_style">Login</a> to your Sindbad account and click on Sindbad help.</p>
            </div>
            <div class="col-md-3">
                <h5>FAQ's</h5>
                <p>Have a query? need clarification? We suggest you take a look at our <a href="https://sindbad.omanair.com/faqs" class="text_style">FAQs</a> page which may have the answers to your questions.</p>
            </div>
            <div class="col-md-3">
                <h5>Oman Air Office</h5>
                <p>Get contact details of worldwide <a href="https://www.omanair.com/gbl/en/contact-us" class="text_style">Oman Air Offices</a> </p>
            </div>
        </div>
    </div>
</footer>
<div class="footer_copyright bg-dark text-white py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-6 ">
                <p class="m-0 p-0">© Oman Air. All rights reserved</p>
            </div>
            <div class="col-md-6  text-md-end text-end ml-auto">
                <ul class="list-unstyled d-flex m-0 justify-content-end ">
                    <li>
                        <a href="https://sindbad.omanair.com/terms-and-conditions" class="text-white px-2 text-decoration-none">Terms of Use </a>
                    </li>
                    <li>
                        <a href="https://www.omanair.com/in/en/privacy-policy" class="text-white px-2 text-decoration-none">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="https://www.omanair.com/in/en/cookie-policy" class="text-white px-2 text-decoration-none">Cookie Policy</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/jquery-3.6.1.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

<script src="{{asset('home-page/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('home-page/js/custom.js')}}"></script>


<!-- Initialize Swiper -->

<script>
    var swiper = new Swiper(".mySwiperproduct", {
        lazy: true,
       
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

<!-- Initialize Swiper -->

<script>
    var swiper = new Swiper(".mySwiper", {
        lazy: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>

<script>
    $(document).ready(function() {
        getHeaderCartCount();
    });

    function searchOmanairData() {
        let searchInput = $('#searchInput').val();
        let searchText = searchInput.replace(' ', '+')
        let url = 'https://sindbad.omanair.com/search_sindbad?search_text=' + searchText;
        window.open(url);
    }

    function searchSindbadData() {
        let searchInput = $('#searchInput').val();
        let currentHost = window.location.host;
        $(location).attr('href');
        console.log(currentHost);
        let url = '/search?search_text=' + searchInput;
        console.log(url);
        window.open(url);
    }

    function getHeaderCartCount() {
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
                    let cartCount = productArray.length;
                    $('#cartIconCount').html(cartCount);
                    let newCartStr = data.newCartStr;
                    $.cookie('rewardSbCart', newCartStr, {
                        expires: 7,
                        path: '/'
                    });
                } else {
                    $('#cartIconCount').html(0);
                }
            });

        } else {
            $('#cartIconCount').html(0);
        }
    }
</script>
<script>
    function openNav() {
        document.getElementById("mySidepanel").style.width = "370px";
    }

    function closeNav() {
        document.getElementById("mySidepanel").style.width = "0";
    }
</script>
