@include('frontend.layouts.header')

<section class="account-hero-section">
      <div class="container">
        <h1>My Account</h1>
      </div>
    </section>
    
    <section class="dtl-user-box">
      <div class="container">
        <div class="account-outer-box">
          <div class="row">
           @include('frontend.dashboard.sidebar')
            <div class="col-md-9 " style="padding-bottom: 300px;">
              <div class="heading-act">
                <h2 text-align="center">My Account <button type="submit"  id="editProfileButton" class="btn btn-secondary">Edit Profile</button></h2>
              </div>
              <div class="profile-detail-section">
                <form action="{{ route('profileupdate', ['id' => $users->id]) }}" class="cmn-frm px-4" method="POST" enctype="multipart/form-data">
                  
               
                  <div class="profile-side border-0 py-4">
                    <div class="img-prfe">
                      <img src="{{asset('frontend/images/dummyuser.png')}}" alt="">
                      <input type="file" name="profile_pic" class="form-control" placeholder="profile_pic" onchange="previewImage(event)">
                    </div>
                    <h2>{{$users->first_name}}</h2>
                    <a href="">{{$users->email}}</a>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="form-group">
                          <label for="">First Name</label>
                          <input type="text" name="first_name" id="" value="{{ old('first_name', $users->first_name) }}" readonly>
                        
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                      <div class="form-group">
                        <label for="">Last Name</label>
                        <input type="text" name="last_name" id="" value="{{ old('last_name', $users->last_name) }}" readonly>
                      </div>
                  </div>
                  <div class="col-md-12 col-lg-6">
                    <div class="form-group">
                      <label for="">Email Address</label>
                      <input type="text" name="email" id="" value="{{ old('email', $users->email) }}" readonly>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                  <div class="form-group">
                    <label for="">Phone Number</label>
                    <input type="text" name="phone" id="" value="{{ old('phone', $users->phone) }}" readonly>
                  </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">Address</label>
                  <input type="text" name="address" id="" value="{{ old('address', $users->address) }}" readonly>
                </div>
            </div>
                  </div>
                </form> 
              </div>
              <div class="notificn-off mt-4 mx-4"  id="notificationSection">
                <h2>Notification <span><div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                </div></h2>
              </div>
              <div class="notificn-off mb-5 mx-4"  id="changePasswordLink">
                <a href="{{ url('changepassword') }}">Change Password</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $("#editProfileButton").click(function() {
    var $button = $(this);
    
    // Check the current text of the button
    if ($button.text() === "Edit Profile") {
      // Change the button text to "Save"
      $button.text("Save");
      
      // Make the form fields editable
      $("input[readonly]").prop("readonly", false);
      
      // Hide the notification section and change password link
      $("#notificationSection").hide();
      $("#changePasswordLink").hide();
    } else if ($button.text() === "Save") {
      // Change the button text back to "Edit Profile"
      $button.text("Edit Profile");
      
      // Make the form fields read-only again
      $("input[readonly]").prop("readonly", true);
      
      // Show the notification section and change password link
      $("#notificationSection").show();
      $("#changePasswordLink").show();
    }
  });
});
</script>


   

    <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="{{asset('frontend/js/bootstrap.js')}}"></script>
    <script src="{{asset('frontend/js/slick.min.js')}}"></script>
    <script src="{{asset('frontend/js/main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
    <script>
      const imgs = document.querySelectorAll(".img-select a");
      const imgBtns = [...imgs];
      let imgId = 1;

      imgBtns.forEach((imgItem) => {
        imgItem.addEventListener("click", (event) => {
          event.preventDefault();
          imgId = imgItem.dataset.id;
          slideImage();
        });
      });

      function slideImage() {
        const displayWidth = document.querySelector(
          ".img-showcase img:first-child"
        ).clientWidth;

        document.querySelector(".img-showcase").style.transform = `translateX(${
          -(imgId - 1) * displayWidth
        }px)`;
      }

      window.addEventListener("resize", slideImage);
    </script>

@include('frontend.layouts.footer')
