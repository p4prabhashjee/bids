<div class="modal fade" id="editAddress" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="px-2 ">
                    <h2 class="mb-5 text-dark">Edit Address</h2>

                    <form action="{{ url('/addresses/update/' . $address->id) }}" method="post" class="cmn-frm" id="address-form">

                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="">First Name </label>
                                    <input type="text" name="first_name" id="first_name_input">


                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="">Last Name </label>
                                    <input type="text" name="last_name" id="last_name_input">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Appartment, Suite, etc </label>
                                    <input type="text" name="apartment" id="apartment">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="">City </label>
                                    <input type="text" name="city" id="city">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="">Country / Region </label>
                                    <input type="text" name="country" id="country">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="">State </label>
                                    <input type="text" name="state" id="state">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label for="">Zip Code </label>
                                    <input type="text" name="zipcode" id="zipcode">
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
    function editAddress(address) {
        // Populate the form fields with the address data
        document.getElementById("first_name_input").value = address.first_name;
        document.getElementById("last_name_input").value = address.last_name;
        document.getElementById("apartment").value = address.apartment;
        document.getElementById("city").value = address.city;
        document.getElementById("country").value = address.country;
        document.getElementById("state").value = address.state;
        document.getElementById("zipcode").value = address.zipcode;
        document.getElementById("is_save").checked = address.is_save;
        $('#editAddress').modal('show');
    }
</script>
@include('frontend.layouts.footer')
