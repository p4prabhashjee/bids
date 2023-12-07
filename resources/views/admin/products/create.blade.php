<x-admin-layout>
    <main class="main-content position-relative border-radius-lg ">
        @include('admin.include.navbar', ['module' => 'Product Auction', 'link' => 'admin.products.index', 'page' =>
        'Create
        Product Auction'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="col-12 col-lg-8 m-auto">
                            <form action="{{route('admin.products.store')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                                    <h5 class="font-weight-bolder mb-0">Add Product Auction</h5>
                                    <p class="mb-0 text-sm">Mandatory informations</p>
                                    <div class="multisteps-form__content">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label><strong>Product Title</strong></label>
                                                <input class="multisteps-form__input form-control" type="text"
                                                    name="title" placeholder="eg. Product Title" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" value="{{old('title')}}">
                                                @if($errors->has('title'))
                                                <div class="error">{{$errors->first('title')}}</div>
                                                @endif

                                            </div>
                                           
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label><strong>Choose AuctionType:</strong></label>
                                                <select name="auction_type_id"
                                                    class="choices__list choices__list--single form-control" id="brand"
                                                    tabindex="-1" data-choice="active">
                                                    <option value="">Select AuctionType</option>
                                                    @foreach ($auctiontype as $at)
                                                    <option value="{{ $at->id }}">{{ $at->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label><strong>Choose Project:</strong></label>
                                                <select name="project_id"
                                                    class="choices__list choices__list--single form-control" id="project"
                                                    tabindex="-1" data-choice="active">
                                                    <option value="">Select Project</option>
                                                    @foreach ($projects as $pr)
                                                    <option value="{{ $pr->id }}">{{ $pr->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                          

                                            <div class="col-12 col-sm-6" id="end-date-container">
                                                <label><strong>End Date & Time</strong></label>
                                                <input class="multisteps-form__input form-control" type="text" id="end_date" name="auction_end_date"
                                                    value="{{ old('auction_end_date') }}" data-input data-enable-time data-date-format="Y-m-d H:i"
                                                    data-min-date="{{ date('Y-m-d') }}">
                                                @if($errors->has('auction_end_date'))
                                                <div class="error">{{ $errors->first('auction_end_date') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label>Status</label>
                                                <select class="choices__list choices__list--single form-control"
                                                    name="status" id="choices-gender" tabindex="-1"
                                                    data-choice="active">

                                                    <option value="new"
                                                        {{ old('status', 'new') == 'new' ? 'selected' : '' }}>New
                                                    </option>
                                                    <option value="open"
                                                        {{ old('status') == 'open' ? 'selected' : '' }}>
                                                        Open</option>
                                                    <option value="suspended"
                                                        {{ old('status') == 'suspended' ? 'selected' : '' }}>Suspended
                                                    </option>
                                                    <option value="closed"
                                                        {{ old('status') == 'closed' ? 'selected' : '' }}>Closed
                                                    </option>
                                                </select>
                                                @if ($errors->has('status'))
                                                <div class="error">{{ $errors->first('status') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 test">
                                                <label><strong>Is Popular:</strong></label>
                                                <input type="checkbox" name="is_popular" value="1">
                                            </div>
                                           
                                            <div class="col-12 col-sm-6">
                                                <label><strong> Price</strong></label>
                                                <input class="multisteps-form__input form-control" type="number"
                                                    id="reserved_price" name="reserved_price"
                                                    placeholder="eg. Reserved Price" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" value="{{ old('reserved_price') }}">
                                                @if($errors->has('reserved_price'))
                                                <div class="error">{{ $errors->first('reserved_price') }}</div>
                                                @endif
                                            </div>
                                            <h6>Estimated Price Range </h6>
                                            <div class="col-12 col-sm-6">
                                                <label><strong>Start Price</strong></label>
                                                <input class="multisteps-form__input form-control" type="number"
                                                    id="estimated_price" name="	start_price"
                                                    placeholder="eg. Estimated Price" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" value="{{ old('start_price') }}">
                                                @if($errors->has('start_price'))
                                                <div class="error">{{ $errors->first('start_price') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <label><strong>End  Price</strong></label>
                                                <input class="multisteps-form__input form-control" type="number"
                                                    id="estimated_price" name="end_price"
                                                    placeholder="eg. Estimated Price" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" value="{{ old('end_price') }}">
                                                @if($errors->has('end_price'))
                                                <div class="error">{{ $errors->first('end_price') }}</div>
                                                @endif
                                            </div>

                                            <!-- <div class="col-12 col-sm-6">
                                                <label><strong>Increment Percentage</strong></label>
                                                <input class="multisteps-form__input form-control" type="number" id="increment_percentage" name="Increment" placeholder="eg. Increment Percentage" onfocus="focused(this)" onfocusout="defocused(this)" value="{{ old('increment_percentage') }}">
                                                @if($errors->has('increment_percentage'))
                                                <div class="error">{{ $errors->first('increment_percentage') }}</div>
                                                @endif
                                            </div> -->
                                           
                                            <div class="col-12 col-sm-12 mt-3 mt-sm-0">
                                                <label><strong>Gallery Images</strong></label>
                                                <input class="multisteps-form__input form-control" type="file"
                                                    id="gallery" name="image_path[]" multiple accept="image/*"
                                                    onchange="previewImages()">
                                                <div class="image-preview" id="image-preview"></div>

                                                @if($errors->has('image_path'))
                                                @foreach($errors->get('image_path') as $error)
                                                <div class="error">{{ $error }}</div>
                                                @endforeach
                                                @endif
                                            </div>
                                           
                                        </div>

                                        <div class="col-12 col-sm-12 mt-3 mt-sm-0">
                                            <label>Description</label>
                                            @php $description = old('description') @endphp
                                            <x-forms.tinymce-editor :name="'description'" :data="$description" />
                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit"
                                                title="Submit">Add Product Auction</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- subcat script based on category -->
   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Add an event listener to the auction type select element -->
<!-- <script>
    $(document).ready(function () {
        $('#brand').on('change', function () {
            var selectedAuction = $(this).val();
            
            if (selectedAuction) {
                // Make an AJAX request to get the categories based on the selected auction
                $.ajax({
                    url: "{{ route('get-categories', ':auction') }}".replace(':auction', selectedAuction),
                    type: 'GET',
                    success: function (data) {
                        // Populate the category select element with the retrieved categories
                        var categorySelect = $('#category');
                        categorySelect.empty();
                        categorySelect.append($('<option value="">Select Category</option>'));
                        $.each(data, function (key, value) {
                            categorySelect.append($('<option value="' + value.id + '">' + value.name + '</option>'));
                        });
                    }
                });
            } else {
                // If no auction type is selected, clear the category select options
                $('#category').empty().append('<option value="">Select Category</option>');
            }
        });
    });
</script> -->

<script>
    $('#brand').on('change', function () {
    var auctionType = $(this).val();
    if (auctionType) {
        $.ajax({
            type: 'GET',
            url: '/get-project/' + auctionType,
            success: function (data) {
                $('#project').empty();
                $('#project').append($('<option value="">Select Project</option>'));
                $.each(data, function (key, value) {
                    $('#project').append($('<option value="' + value.id + '">' + value.name + '</option>'));
                });
            }
        });
    } else {
        $('#project').empty();
        $('#project').append($('<option value="">Select Project</option>'));
    }
});
</script>
    <script>
    function previewImages() {
        var preview = document.getElementById('image-preview');
        preview.innerHTML = '';

        var files = document.getElementById('gallery').files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.onload = function(e) {
                var image = document.createElement('img');
                image.src = e.target.result;
                preview.appendChild(image);
            };

            reader.readAsDataURL(file);
        }
    }
    </script>
    <script>
$(document).ready(function() {
    // Function to handle the change event of the auction type select
    $("#brand").on("change", function() {
        // Get the selected value
        var selectedValue = $(this).val();

        // Check if the selected value is "3" (which corresponds to "Live" in your database)
        if (selectedValue === "2") {
            // Hide the "End Date & Time" container
            $("#end-date-container").hide();
        } else {
            // Show the "End Date & Time" container for other auction types
            $("#end-date-container").show();
        }
    });

    // Trigger the change event initially to set the initial state
    $("#brand").trigger("change");
});
</script>

    <x-head.tinymce-config />
</x-admin-layout>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
    flatpickr("#end_date", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: "{{ date('Y-m-d') }}",
    });
</script>


<style>
.image-preview {
    display: flex;
    flex-wrap: wrap;
    margin-top: 10px;
}

.image-preview img {
    max-width: 100px;
    max-height: 100px;
    margin: 5px;
}

.remove-field {
    margin-top: 30px;
}
.test {
    margin-top: 2rem !important;
}
</style>