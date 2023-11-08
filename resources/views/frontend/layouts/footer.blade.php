@php
$social = App\Models\Setting::where('is_static',1)->orderBy('title','ASC')->get();
$logo = App\Models\Setting::where('is_static', 2)->orderBy('title', 'ASC')->first();
$pages =App\Models\Page::where('is_static', 1)->orderBy('title', 'ASC')->first();

@endphp

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                @if ($logo)
                <div class="ftr-mang-eb">
                    <img class="f-logo" src="{{ asset('img/settings/' . $logo->image) }}" alt="" />
                    <p>
                        {{$logo->value}}
                    </p>
                </div>
                @else
                <div class="ftr-mang-eb">
                    <img class="f-logo" src="{{asset('frontend/images/logo.svg')}}" alt="" />
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    </p>
                </div>
                @endif

            </div>
            <!-- <div class="col-md-3 mange-text">
                <h3>SHOP</h3>
                <ul class="use-fulllink">
                    <li><a href="product-list.html">Products</a></li>
                    <li><a href="">Overview</a></li>
                    <li><a href="">Pricing</a></li>
                    <li><a href="">Releases</a></li>
                </ul>
            </div> -->
            <div class="col-md-4">
                <h3>Company</h3>
                <ul class="use-fulllink">
                    <li><a href="{{route('about-us')}}">About us</a></li>
                    <li><a href="{{route('contact-us')}}">Contact</a></li>
                    <li><a href="">News</a></li>
                    <li><a href="">Support</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h3>Stay up to date</h3>
                <form action="" class="news-letter">
                    <div class="form-group">
                        <input type="email" name="" id="" placeholder="Enter your email" />
                        <button>Submit</button>
                    </div>
                </form>
                <h3>Social Media</h3>
                <ul class="social-link">

                    @foreach($social as $setting)
                    <li>
                        <a href="{{ $setting->value }}"><img src="{{ asset('img/settings/' . $setting->image) }}"
                                width="30px" alt="" /></a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="privacy-link">
            <ul>

                <li><a href="{{route('terms-conditions')}}">Terms</a></li>
                <li><a href="{{route('privacy-policy')}}">Privacy</a></li>
            </ul>
        </div>
    </div>
</footer>


<div class="wts_fixed">
    <a href="https://wa.me/966555424101" class="whatappFixBtn" target="_blank" id="">
        <img src="{{asset('frontend/images/wts_ic.svg')}}" alt="whatsapp" width="45px" height="45px">
    </a>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="{{asset('frontend/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>

<script type="text/javascript">
$('.home_slider .owl-carousel').owlCarousel({
    loop: true,
    margin: 0,
    dots: true,
    loop: true,
    autoplay: true,
    autoplaySpeed: 3000,
    autoplayHoverPause: false,
    nav: false,
    items: 1,
});
$('.popular_slider.owl-carousel').owlCarousel({
    items: 3,
    margin: 30,
    dots: false,
    loop: true,
    nav: false,
    autoplay: true,
    autoplaySpeed: 3000,
    autoplayHoverPause: false,
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 2,
        },
        1000: {
            items: 3,
        }
    }
});
</script>
<script>
$(document).ready(function() {
    setInterval(() => {
        $('.thisisdemoclass').each(function() {
            var date = $(this).data('date');
            var id = $(this).data('id');
            const targetDate = new Date(date).getTime();
            const currentDate = new Date().getTime();
            const timeRemaining = targetDate - currentDate;
            const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 *
                60));
            const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
            $(this).find('.days').text(days);
            $(this).find('.hours').text(hours);
            $(this).find('.minutes').text(minutes);
            $(this).find('.seconds').text(seconds);
        });
    }, 1000);
})
</script>
</body>

</html>