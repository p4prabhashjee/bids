@include('frontend.layouts.header')
<section class="account-hero-section">
      <div class="container">
        <h1>Change Password</h1>
      </div>
    </section>
<section class="dtl-user-box">
    <div class="container">
        <div class="account-outer-box">
            <div class="row">
                @include('frontend.dashboard.sidebar')

                <div class="col-md-9 " style="padding-bottom: 300px;">
                    <div class="heading-act">
                        <h2>Change Password</h2>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="profile-detail-section">
                        <form action="{{ route('change-password') }}" class="cmn-frm px-4" method="POST">
                          @csrf
           
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label for="current_password">Old Password</label>
                                    <input type="password" name="current_password" id="password"class="form-control" >
                                    <i class="fa fa-eye-slash input-icon" id="password-toggle"></i>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" name="password" id="newpassword" class="form-control" >
                                    <i class="fa fa-eye-slash input-icon" id="new-password-toggle"></i>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" >
                                    <i class="fa fa-eye-slash input-icon" id="confirm-password-toggle"></i>
                                </div>
                            </div>

                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-secondary login-btn text-capitalize">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
    $('form').submit(function(event) {
        var currentPassword = $('input[name="current_password"]').val();
        var newPassword = $('input[name="password"]').val();
        var confirmPassword = $('input[name="confirm_password"]').val();

        var errors = [];

        // Validate current password
        if (currentPassword === '') {
            errors.push('Current password is required.');
        }

        // Validate new password
        if (newPassword === '') {
            errors.push('New password is required.');
        } else if (newPassword.length < 6) {
            errors.push('New password should be at least 6 characters.');
        }

        // Validate password confirmation
        if (confirmPassword === '') {
            errors.push('Confirm password is required.');
        } else if (newPassword !== confirmPassword) {
            errors.push('New password and confirm password do not match.');
        }

        // Display errors
        if (errors.length > 0) {
            event.preventDefault();
            var errorHtml = '';
            for (var i = 0; i < errors.length; i++) {
                errorHtml += '<li>' + errors[i] + '</li>';
            }
            errorHtml += '';
            $('.error-messages').html(errorHtml);
        }
    });
});

</script>
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
    $('#new-password-toggle').click(function() {
        const confirmPasswordInput = $('#newpassword');
        if (confirmPasswordInput.attr('type') === 'password') {
            confirmPasswordInput.attr('type', 'text');
            $('#new-password-toggle').removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            confirmPasswordInput.attr('type', 'password');
            $('#new-password-toggle').removeClass('fa-eye').addClass('fa-eye-slash');
        }
    });
});
</script>

@include('frontend.layouts.footer')