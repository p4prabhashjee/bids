
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="login-mdl text-center">
            <img src="{{asset('frontend/images/logo.svg')}}" alt="">
            <h2 class="fndt-bld">Verify OTP</h2>
            <p>Please enter 4-digit verification code that was send to your
              Mobile number <a href="" class="text-btn edit-number">"+91 1234567890"</a></p>
              <form action="" class="cmn-frm otp-filds">
                <input type="number" name="" id="">
                <input type="number" name="" id="">
                <input type="number" name="" id="">
                <input type="number" name="" id="">
              </form>
              <p>Didn’t Receive the Code? <a href="" class="text-btn edit-number">Resend</a></p>
              <a href="my-account.html" class="mt-4 btn btn-secondary px-5" > Verify</a>
          </div>
        </div>
         
      </div>
    </div>
  </div>
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
              <li><a href="{{route('products-list')}}">Products</a></li>
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

    <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="{{asset('frontend/js/bootstrap.js')}}"></script>
    <script src="{{asset('frontend/js/slick.min.js')}}"></script>
    <script src="{{asset('frontend/js/main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
 <script>
   
 </script>
  </body>
</html>
