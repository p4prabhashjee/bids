<footer>
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="ftr-mang-eb">
              <img class="f-logo" src="{{asset('frontend/images/logo.svg')}}" alt="" />
              <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
              </p>
            </div>
          </div>
          <div class="col-md-3 mange-text">
            <h3>SHOP</h3>
            <ul class="use-fulllink">
              <li><a href="product-list.html">Products</a></li>
              <li><a href="">Overview</a></li>
              <li><a href="">Pricing</a></li>
              <li><a href="">Releases</a></li>
            </ul>
          </div>
          <div class="col-md-2">
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
                <input
                  type="email"
                  name=""
                  id=""
                  placeholder="Enter your email"
                />
                <button>Submit</button>
              </div>
            </form>
            <h3>Social Media</h3>
            <ul class="social-link">
              <li>
                <a href=""><img src="{{asset('frontend/images/youtube.svg')}}" alt="" /></a>
              </li>
              <li>
                <a href=""><img src="{{asset('frontend/images/twitter.svg')}}" alt="" /></a>
              </li>
              <li>
                <a href=""><img src="{{asset('frontend/images/facebook.svg')}}" alt="" /></a>
              </li>
              <li>
                <a href=""><img src="{{asset('frontend/images/instagram.svg')}}" alt="" /></a>
              </li>
              <li>
                <a href=""><img src="{{asset('frontend/images/linkdin.png')}}" alt="" /></a>
              </li>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
    <script src="{{asset('frontend/js/main.js')}}"></script>

    <script type="text/javascript">
        $('.home_slider .owl-carousel').owlCarousel({
            loop: true,
            margin: 0,
            dots: true,
            loop:true,
            autoplay:true,
            autoplaySpeed: 3000,
            autoplayHoverPause: false,
            nav: false,
            items: 1,
        });
        $('.popular_slider.owl-carousel').owlCarousel({
            items: 3,
            margin: 30,
            dots: false,
            loop:true,
            nav: false,
            autoplay:true,
            autoplaySpeed: 3000,
            autoplayHoverPause: false,
            responsive:{
                0:{
                    items:1,
                },
                600:{
                    items:2,
                },
                1000:{
                    items:3,
                }
            }
        }); 
    </script>
  </body>
</html>
