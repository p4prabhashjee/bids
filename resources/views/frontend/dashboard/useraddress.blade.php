@include('frontend.layouts.header')


<section class="account-hero-section">
    <div class="container">
        <h1>Manage Address</h1>
    </div>
</section>


<section class="dtl-user-box">
    <div class="container">
        <div class="account-outer-box">
            <div class="row">
                @include('frontend.dashboard.sidebar')
                <div class="col-md-9 " style="padding-bottom: 300px;">
                    <div class="heading-act">
                        <h2>Manage Address</h2>
                    </div>
                    <div class="manage-adress">

                        <a class="text-btn edit-number d-flex align-items-center border-bottom px-3 py-4"
                            data-bs-target="#addressman" data-bs-toggle="modal" data-bs-dismiss="modal"
                            type="button"><img class="me-2" src="{{asset('frontend/images/add-address.svg')}}"
                                alt="">Add
                            New Address</a>
                        @foreach($userAddresses as $address)
                        <div class="border-bottom">
                            <div class="address-filds">
                                <img class="location-icon" src="{{ asset('frontend/images/location.svg') }}" alt="">
                                <h4>Address {{ $loop->iteration }}</h4>
                                <div class="d-flex align-items-center gap-2 justify-content-between">
                                    <p>
                                        {{ $address->first_name }} {{ $address->last_name }} -
                                        {{ $address->apartment }}, {{ $address->city }}, {{ $address->country }},
                                        {{ $address->state }}, {{ $address->zipcode }}
                                    </p>
                                    <div class="action-btn">
                                        
                                    <a href="javascript:void(0)" onclick="editAddress({{ json_encode($address) }})" class="text-btn">Edit</a>
                                        <a href="{{ route('addresses.delete', $address->id)}}"
                                            class="text-btn text-danger">Delete</a>

                                    </div>

                                   
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


<!--  -->
<div class="modal fade" id="addressman" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="px-2 ">
                    <h2 class="mb-5 text-dark">Add Address</h2>

                    <form action="{{ route('adduseraddress') }}" method="post" class="cmn-frm" id="address-form">
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
                                    <input type="text" name="last_name" id="">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Appartment, Suite, etc </label>
                                    <input type="text" name="apartment" id="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="">City </label>
                                    <input type="text" name="city" id="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="">Country / Region </label>
                                    <input type="text" name="country" id="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="">State </label>
                                    <input type="text" name="state" id="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="">Zip Code </label>
                                    <input type="text" name="zipcode" id="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group d-flex gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" name="is_save"
                                            id="is_save">
                                        <label class="form-check-label" for="is_save"></label>
                                    </div>
                                    <label for="">Save this information for next time</label>
                                </div>
                            </div>
                        </div>
                        <button class="my-4 btn btn-secondary px-5" id="submit-address" title="Submit">Save the
                            Address</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!--  -->
<div id="validation-errors" class="alert alert-danger" style="display: none;"></div>
<!-- edit address -->
<div class="modal fade" id="editAddress" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="px-2 ">
                    <h2 class="mb-5 text-dark">Edit Address</h2>

                    <form action="{{ route('addresses.update', ['id' => $address->id]) }}" method="post" class="cmn-frm" id="address-form">

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
                                    <input type="text" name="last_name" id="">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Appartment, Suite, etc </label>
                                    <input type="text" name="apartment" id="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="">City </label>
                                    <input type="text" name="city" id="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="">Country / Region </label>
                                    <input type="text" name="country" id="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="">State </label>
                                    <input type="text" name="state" id="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="">Zip Code </label>
                                    <input type="text" name="zipcode" id="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group d-flex gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" name="is_save"
                                            id="is_save">
                                        <label class="form-check-label" for="is_save"></label>
                                    </div>
                                    <label for="">Save this information for next time</label>
                                </div>
                            </div>
                        </div>
                        <button class="my-4 btn btn-secondary px-5" id="submit-address" title="Submit">Save the
                            Address</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $("#submit-address").click(function(e) {
        e.preventDefault();

        var first_name = $("#first_name").val();

        if (!first_name) {
            $("#first_name").addClass("is-invalid");
            $("#validation-errors").html("Please fix the validation errors.");
            $("#validation-errors").show();
            return;
        }

        var formData = $("#address-form").serialize();
        $.ajax({
            type: "POST",
            url: "{{ route('adduseraddress') }}",
            data: formData,
            success: function(data) {
                if (data.Status === 'true') {
                    $('#addressman').modal('hide');
                } else {
                    // Handle errors
                    $("#validation-errors").html("Error: " + data.Message);
                    $("#validation-errors").show();

                    if (data.Errors) {
                        $.each(data.Errors, function(key, value) {
                            $("#" + key).addClass("is-invalid");
                            $("#validation-errors").append("<p>" + value[0] +
                                "</p>");
                        });
                    }
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr);
            }
        });
    });

    $("input").focus(function() {
        $(this).removeClass("is-invalid");
    });
});
</script>
<script>
    function editAddress(address) {
        // Populate the form fields with the address data
        document.getElementById("first_name").value = address.first_name;
        document.getElementById("last_name").value = address.last_name;
        document.getElementById("apartment").value = address.apartment;
        document.getElementById("city").value = address.city;
        document.getElementById("country").value = address.country;
        document.getElementById("state").value = address.state;
        document.getElementById("zipcode").value = address.zipcode;
        document.getElementById("is_save").checked = address.is_save;

        // Show the edit modal
        $('#editAddress').modal('show');
    }
</script>



@include('frontend.layouts.footer')