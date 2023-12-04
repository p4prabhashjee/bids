@include('frontend.layouts.header')
<style>
  .error-message{
    color: #eb5b5b;
    margin-bottom: 7px;
}
.form-check{
  
  margin-top: 2.125rem;
}
  </style>
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
            <div class="login-detail p-5 pb-5">
              <h2>Sign Up</h2>
              <!-- <p>Lorem Ipsum is simply dummy text of the printing  <br>
                and typesetting industry.</p> -->
                <form action="{{ route('registration') }}" method="post" class="cmn-frm">
                  @csrf
                  <div class="row">
                    <div class="col-lg-6 col-md-12">
                      <div class="form-group">
                        <label for="">First Name </label>
                        <input type="text" name="first_name" id="first_name">
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                      <div class="form-group">
                        <label for="">Last Name </label>
                        <input type="text" name="last_name" id="last_name">
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                      <div class="form-group">
                        <label for="">Email Address </label>
                        <input type="text" name="email" id="email">

                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                      <div class="form-group">
                        <label for="">Country code </label>
                        <select name="country_code" class="choices__list choices__list--single form-control" id="country_code" tabindex="-1" data-choice="active">
                          <option value="">Choose Country</option>
                          @foreach ($cont as $at)
                          <option value="+{{ $at->phonecode }}">+{{ $at->phonecode }}</option>
                          @endforeach
                      </select>

                      </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                      <div class="form-group">
                        <label for="">Phone Number </label>
                       <input type="number"  placeholder="Phone Number" name="phone" id="mobile_code-login">

                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">Address </label>
                        <input type="text" name="address" id="address">

                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input class="pe-5" type="password" name="password" id="password">
                            <i class="fa fa-eye-slash input-icon" id="password-toggle"></i>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password">
                            <i class="fa fa-eye-slash input-icon" id="confirm-password-toggle"></i>
                        </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group d-flex gap-2 align-items-center">
                       <div class="form-check">
                        <input class="form-check-label" type="checkbox" name="is_term" id="is_term" value="1">
                        <label class="form-check-label" for="flexCheckDefault"> </label>
                      </div>
                        <label for="">Accept <a href="" class="text-btn text-capitalize">Terms & Conditions.</a></label> 
                      </div>
                    </div>
                  </div>
                    <button class="btn btn-secondary login-btn font-bld"  title="Submit"> Sign Up</button>
                                      
                </form>
                <span class="sign-tag-line">if you have an account? <a href="{{route('signin')}}" class="text-btn">Login</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="login-mdl text-center">
            <img src="{{asset('frontend/images/logo.svg')}}" alt="">
            <h2 class="fndt-bld">Verify OTP</h2>
            <p>Please enter 4-digit verification code that was send to your
              Mobile/Email <a href="" class="text-btn edit-number numberTag">"+91 1234567890"</a></p>
              <form action="{{ route('verify-otp') }}" method="post" class="cmn-frm otp-filds" id="otp-verification-form">
              
                <input type="number otpValue" name="otp" id="first" maxlength="1" />
                <input type="number otpValue" name="otp" id="second" maxlength="1" />
                <input type="number otpValue" name="otp" id="third" maxlength="1" />
                <input type="number otpValue" name="otp" id="fourth" maxlength="1" />
              </form>
              <p>Didn’t Receive the Code? <a href="" class="text-btn edit-number">Resend</a></p>
              <!-- <button type="submit" class="mt-4 btn btn-secondary px-5 btn-verify">Verify</button> -->
              <button type="button" name="verify-otp" class="mt-4 btn btn-secondary px-5 btn-verify-otp">Verify</button>
          </div>
        </div>
         
      </div>
    </div>
  </div>

    <script src="{{asset('frontend/js/jquery.min.js')}}"></script> 
    <script src="{{asset('frontend/js/bootstrap.js')}}"></script> 
    <script src="{{asset('frontend/js/main.js')}}"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"> </script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>
    <script>
    function focusOnNextInput(currentInput, nextInputId) {
      if (currentInput.value && currentInput.value.length === 1) {
        document.getElementById(nextInputId).focus();
      }
    }
  </script>

<script>
$(document).ready(function() {
    $("form.cmn-frm").submit(function(event) {
        event.preventDefault();
        $(".error-message").remove();
        var valid = true;

        // Validate First Name
       
        var firstName = $("#first_name").val();
        if (!firstName) {
            $("#first_name").after('<div class="error-message">First Name is required.</div>');
            valid = false;
        }
        // Validate Last Name
        var lastName = $("#last_name").val();
        if (!lastName) {
            $("#last_name").after('<div class="error-message">Last Name is required.</div>');
            valid = false;
        }
        // Validate Email Address
        var email = $("#email").val();
        if (!email) {
            $("#email").after('<div class="error-message">Email Address is required.</div>');
            valid = false;
        }
        // phone mumber
        var phone = $("#mobile_code-login").val();
        if (!phone) {
            $("#mobile_code-login").after('<div class="error-message">Phone Number is required.</div>');
            valid = false;
        }
         // phone mumber
        var address = $("#address").val();
        if (!address) {
            $("#address").after('<div class="error-message">Address Field is required.</div>');
            valid = false;
        }
        // password
        var password = $("#password").val();
        if (!password) {
            $("#password").after('<div class="error-message">Password Field is required.</div>');
            valid = false;
        }
        var confirm_password = $("#confirm_password").val();
        if (!confirm_password) {
            $("#confirm_password").after('<div class="error-message">Password and confirm password not match.</div>');
            valid = false;
        }

        // Input event handler for password and confirm_password
        $("#password, #confirm_password").on("input", function() {
            $(this).next(".error-message").remove();
        });
        $("input[type='text']").on("input", function() {
            $(this).next(".error-message").remove();
        });

        if (valid) {
            $.ajax({
                type: "POST",
                url: "{{ route('registration') }}",
                data: $("form.cmn-frm").serialize(),
                success: function(response) {
                  if(response.status == 'error') {
                    alert(`${response.message}: ${response.error}`)
                  } else {
                    // $('.numberTag').text(" "+ $('#country_code').val()+' '+$('#mobile_code-login').val())
                    $('.numberTag').text(" "+ ' '+$('#email').val())
                    openOtpVerificationModal();
                  }                    
                },
                error: function() {
                   alert('Error in request!');
                }
            });
        }
    });

    function openOtpVerificationModal() {
        $("#exampleModalToggle").modal("show");
    }
    
    // for mobile tel code
    $("#mobile_code-login").intlTelInput({
      initialCountry: "in",
      separateDialCode: true, 
    });
});
</script>

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
<script>

$('body').on('click','.btn-verify-otp', function(){
  verifyOTP();
})

function verifyOTP() {
  const otpValue = document.getElementById("first").value + document.getElementById("second").value + document.getElementById("third").value + document.getElementById("fourth").value;
//  Auth::user()->phone 
  let number  = $('#mobile_code-login').val();

  $.ajax({
      type: "POST",
      url: "{{ route('verify-otp') }}",
      data: {otpValue: otpValue, number: number},
      headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
      },
      success: function(response) {
        if(response.status == 'error') {
          // alert(`${response.message}: ${response.error}`)
          alert("Invalid OTP. Please try again.");
        } else {
          window.location.href = "{{ url('/') }}";
          // $('.numberTag').text(" "+ $('#country_code').val()+' '+$('#mobile_code-login').val())
          // openOtpVerificationModal();
        }                    
      },
      error: function() {
        alert("An error occurred while verifying OTP.");
      }
  });


}
</script>


  </body>
@include('frontend.layouts.footer')
