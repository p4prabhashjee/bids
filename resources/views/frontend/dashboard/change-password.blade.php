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
                                    <input type="password" name="current_password" id=""class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" name="password" id="" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="" class="form-control" >
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

@include('frontend.layouts.footer')