@include('frontend.layouts.header')

<body>
  <div class="user-login align-just">
    <div class="container">
      <div class="login-outer-box">
        <div class="row">
          <div class="col-md-6">
            <div class="auction-type align-just h-100">
              <img src="{{asset('frontend/images/logo-light.svg')}}" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="login-detail">
              <h2>Login</h2>
               
                <form action="{{ route('loggedin') }}" method="POST" class="cmn-frm">
                   @csrf
                  <div class="form-group">
                    <label for="">Email or phone number </label>
                    <input type="text" name="email" id="email">
                  </div>
                  <div class="form-group">
                    <label for="">Password </label>
                    <input class="pe-4" type="password" name="password" id="password">
                    <i class="fa fa-eye-slash input-icon" id="password-toggle"></i>
                  </div>
                  <a  class="text-btn forgt-btn edit-number" data-bs-toggle="modal" href="#forgotpassword" type="button">Forgot Password?</a>
                  <!-- <button class="btn btn-secondary login-btn" data-bs-toggle="modal" href="#exampleModalToggle" type="button"> Login</button> -->
                  <button class="btn btn-secondary login-btn" type="submit">Login</button>
                </form>
                <span class="sign-tag-line">if you don't have an account? <a href="{{route('register')}}" class="text-btn">Sign Up</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
   
  <div class="modal fade" id="forgotpassword" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="login-mdl text-center">
            <img src="{{asset('frontend/images/logo.svg')}}" alt="">
            <h2>Forgot Password</h2>
            <p>Enter the email associated with youe account and we’ll send an
              email with instructions to reset your password.</p>
              <form action="" class="cmn-frm mt-4">
                <div class="form-group text-start">
                  <label for=" ">Email or phone number </label>
                  <input type="number" name="" id="">
                </div>
                 
              </form>
              <a  class="my-4 btn btn-secondary px-5" data-bs-target="#newpassword" data-bs-toggle="modal" data-bs-dismiss="modal" type="button"> Send Link</a>
              <a   class="text-btn d-flex justify-content-center gap-2 align-items-center" data-bs-dismiss="modal" aria-label="Close"><img src="{{asset('frontend/images/back-arrow.svg')}}" alt=""> Back to login </a>
          </div>
        </div>
         
      </div>
    </div>
  </div>


  <div class="modal fade" id="newpassword" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="login-mdl text-center">
            <img src="{{asset('frontend/images/logo.svg')}}" alt="">
            <h2 class="fndt-bld">Set New Password</h2>
            <p>Your new password must be different from <br>
              previous used password.</p>
              <form action="" class="cmn-frm mt-4">
                <div class="form-group text-start">
                  <label for="">New Password </label>
                  <input class="pe-5" type="password" name="" id="">
                  <i class="fa fa-eye-slash input-icon"></i>
                </div>
                <div class="form-group text-start">
                  <label for="">Confirm New Password </label>
                  <input class="pe-5" type="password" name="" id="">
                  <i class="fa fa-eye-slash input-icon"></i>
                </div>
                 
              </form>
              <a href="login.html" class="my-4 btn btn-secondary px-5" > Reset Password</a>
              <a   class="text-btn d-flex justify-content-center gap-2 align-items-center" data-bs-dismiss="modal" aria-label="Close"><img src="{{asset('frontend/images/back-arrow.svg')}}" alt=""> Back to login </a>
          </div>
        </div>
         
      </div>
    </div>
  </div>
  
    
    

    <script src="{{asset('frontend/js/jquery.min.js')}}"></script> 
    <script src="{{asset('frontend/js/bootstrap.js')}}"></script> 
    <script src="{{asset('frontend/js/main.js')}}"></script> 
    <script>
$(document).ready(function() {
    $('#password-toggle').click(function() {
        const passwordInput = $('#password');
        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
            $('#password-toggle').removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            passwordInput.attr('type', 'password');
            $('#password-toggle').removeClass('fa-eye').addClass('fa-eye-slash');
        }
    });

    $('#confirm-password-toggle').click(function() {
        const confirmPasswordInput = $('#confirm_password');
        if (confirmPasswordInput.attr('type') === 'password') {
            confirmPasswordInput.attr('type', 'text');
            $('#confirm-password-toggle').removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            confirmPasswordInput.attr('type', 'password');
            $('#confirm-password-toggle').removeClass('fa-eye').addClass('fa-eye-slash');
        }
    });
});
</script>
  </body>

  @include('frontend.layouts.footer')
