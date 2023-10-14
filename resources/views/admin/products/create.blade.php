<x-admin-layout>
    <main class="main-content position-relative border-radius-lg ">
        @include('admin.include.navbar', ['module' => 'Product Auction', 'link' => 'admin.products.index', 'page' =>
        'Create
        Product Auction'])
        <div class="container-fluid py-4">
            <div class="row mt-4">
                <div class="card">
                    <div class="col-12 col-lg-8 m-auto">
                        <form class="mb-8" action="{{route('admin.products.store')}}" method="POST"
                            enctype="multipart/form-data" style="height: 408px;">
                            @csrf
                            <div class="card p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">Add Product Auction</h5>
                                <p class="mb-0 text-sm">Mandatory informations</p>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label><strong>Product Title</strong></label>
                                            <input class="multisteps-form__input form-control" type="text" name="title"
                                                placeholder="eg. Product Title" onfocus="focused(this)"
                                                onfocusout="defocused(this)" value="{{old('title')}}">
                                            @if($errors->has('title'))
                                            <div class="error">{{$errors->first('title')}}</div>
                                            @endif
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label><strong>Choose a Category:</strong></label>
                                            <select name="category_id"
                                                class="choices__list choices__list--single form-control" id="category"
                                                tabindex="-1" data-choice="active">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $cat)

                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label><strong>Choose a SubCategory:</strong></label>
                                            <select name="subcategory_id"
                                                class="choices__list choices__list--single form-control"
                                                id="subcategory" tabindex="-1" data-choice="active">
                                                <option value="">Select Subcategory</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label><strong>Choose a Brand:</strong></label>
                                            <select name="brand_id"
                                                class="choices__list choices__list--single form-control" id="brand"
                                                tabindex="-1" data-choice="active">
                                                <option value="">Select Brand</option>
                                                @foreach ($brands as $br)
                                                <option value="{{ $br->id }}">{{ $br->name }}</option>
                                                @endforeach
                                            </select>
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
                                            <label>Status</label>
                                            <select class="choices__list choices__list--single form-control"
                                                name="status" id="choices-gender" tabindex="-1" data-choice="active">

                                                <option value="new"
                                                    {{ old('status', 'new') == 'new' ? 'selected' : '' }}>New</option>
                                                <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>
                                                    Open</option>
                                                <option value="suspended"
                                                    {{ old('status') == 'suspended' ? 'selected' : '' }}>Suspended
                                                </option>
                                                <option value="closed"
                                                    {{ old('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                                            </select>
                                            @if ($errors->has('status'))
                                            <div class="error">{{ $errors->first('status') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label><strong>Auction Start Date</strong></label>
                                            <input class="multisteps-form__input form-control" type="date"
                                                id="start_date" name="auction_start_date"
                                                value="{{ old('auction_start_date') }}" min="{{ date('Y-m-d') }}">
                                            @if($errors->has('auction_start_date'))
                                            <div class="error">{{ $errors->first('auction_start_date') }}</div>
                                            @endif
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <label><strong>Auction End Date</strong></label>
                                            <input class="multisteps-form__input form-control" type="date" id="end_date"
                                                name="auction_end_date" value="{{ old('auction_end_date') }}"
                                                min="{{ date('Y-m-d') }}">
                                            @if($errors->has('auction_end_date'))
                                            <div class="error">{{ $errors->first('auction_end_date') }}</div>
                                            @endif
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <label><strong>Auction Start Time</strong></label>
                                            <input class="multisteps-form__input form-control" type="time"
                                                id="start_time" name="auction_start_time"
                                                value="{{ old('auction_start_time') }}">
                                            @if($errors->has('auction_start_time'))
                                            <div class="error">{{ $errors->first('auction_start_time') }}</div>
                                            @endif
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <label><strong>Auction End Time</strong></label>
                                            <input class="multisteps-form__input form-control" type="time" id="end_time"
                                                name="auction_end_time" value="{{ old('auction_end_time') }}">
                                            @if($errors->has('auction_end_time'))
                                            <div class="error">{{ $errors->first('auction_end_time') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label><strong>Reserved Price</strong></label>
                                            <input class="multisteps-form__input form-control" type="number" step="0.01"
                                                id="reserved_price" name="reserved_price"
                                                placeholder="eg. Reserved Price" onfocus="focused(this)"
                                                onfocusout="defocused(this)" value="{{ old('reserved_price') }}">
                                            @if($errors->has('reserved_price'))
                                            <div class="error">{{ $errors->first('reserved_price') }}</div>
                                            @endif
                                        </div>
                                        <!-- <div class="col-12 col-sm-6">
                                            <label><strong>Minimum Bid</strong></label>
                                            <input class="multisteps-form__input form-control" type="number" step="0.01"
                                                id="minimum_bid" name="minimum_bid" placeholder="eg. Minimum Bid"
                                                onfocus="focused(this)" onfocusout="defocused(this)"
                                                value="{{ old('minimum_bid') }}">
                                            @if($errors->has('minimum_bid'))
                                            <div class="error">{{ $errors->first('minimum_bid') }}</div>
                                            @endif
                                        </div> -->
                                        <div class="col-12 col-sm-6">
                                            <label><strong>No Of Entries</strong></label>
                                            <input class="multisteps-form__input form-control" type="number" step="0.01"
                                                id="no_of_entries" name="no_of_entries" placeholder="eg. No Of Entries"
                                                onfocus="focused(this)" onfocusout="defocused(this)"
                                                value="{{ old('no_of_entries') }}">
                                            @if($errors->has('no_of_entries'))
                                            <div class="error">{{ $errors->first('no_of_entries') }}</div>
                                            @endif
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <label><strong>Deposit</strong></label>
                                            <div>
                                                <input type="radio" id="with_deposit" name="deposit" value="with"
                                                    onchange="toggleDepositField()">
                                                <label for="with_deposit"><strong>With Deposit</strong></label>
                                            </div>
                                           
                                            <div class="col-12 col-sm-6">
                                                <input type="radio" id="without_deposit" name="deposit"
                                                    value="without" onchange="toggleDepositField()">
                                                <label for="without_deposit">Without Deposit</label>
                                            </div>
                                            <div id="deposit_field" style="display: none;">
                                                <input class="multisteps-form__input form-control" type="number"
                                                    step="0.01" id="deposit_amount" name="deposit_amount"
                                                    placeholder="eg. Deposit Amount" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" value="{{ old('deposit_amount') }}">
                                                @if($errors->has('deposit_amount'))
                                                <div class="error">{{ $errors->first('deposit_amount') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 mt-3 mt-sm-0">
                                            <label><strong>Gallery Images</strong></label>
                                            <input class="multisteps-form__input form-control" type="file" id="gallery"
                                                name="image_path[]" multiple accept="image/*"
                                                onchange="previewImages()">
                                            <div class="image-preview" id="image-preview"></div>

                                            @if($errors->has('image_path'))
                                            @foreach($errors->get('image_path') as $error)
                                            <div class="error">{{ $error }}</div>
                                            @endforeach
                                            @endif
                                        </div>
                                        <h6>Product Specification </h6>


                                        <div id="chatFieldsContainer">
                                            <div class="row">
                                                <div class="col-12 col-sm-5">
                                                    <label><strong>Feature Name</strong></label>

                                                    <input class="multisteps-form__input form-control" type="text"
                                                        name="name[]" placeholder="eg. Feature name"
                                                        onfocus="focused(this)" onfocusout="defocused(this)">

                                                </div>
                                                <div class="col-12 col-sm-5">
                                                    <label><strong>Feature Value</strong></label>
                                                    <input class="multisteps-form__input form-control" type="text"
                                                        name="value[]" placeholder="eg. Feature value"
                                                        onfocus="focused(this)" onfocusout="defocused(this)">
                                                </div>
                                                <div class="col-12 col-sm-2">

                                                    <button type="button" class="btn btn-danger remove-field"
                                                        disabled>Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="">
                                        <button type="button" class="btn btn-primary add-field">Add More
                                            Feature</button>
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
    </main>
    <!-- subcat script based on category -->
    <script>
    $(document).ready(function() {
        $('#category').on('change', function() {
            var categoryId = $(this).val();
            if (categoryId) {
                $.ajax({
                    url: '{{ route("get-subcategories", ["category" => "__categoryId__"]) }}'
                        .replace('__categoryId__', categoryId),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#subcategory').empty();
                        $('#subcategory').append($('<option>').text('Select Subcategory')
                            .attr('value', ''));
                        $.each(data, function(key, value) {
                            $('#subcategory').append($('<option>').text(value.name)
                                .attr('value', value.id));
                        });
                    }
                });
            } else {
                $('#subcategory').empty();
                $('#subcategory').append($('<option>').text('Select Subcategory').attr('value', ''));
            }
        });
    });
    </script>
    <!-- preview image script -->
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
    <!-- add remove functionality -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('chatFieldsContainer');
        const addFieldBtn = document.querySelector('.add-field');

        addFieldBtn.addEventListener('click', function() {
            const clone = container.firstElementChild.cloneNode(true);

            // Clear values in the cloned row
            clone.querySelector('[name="name[]"]').value = '';
            clone.querySelector('[name="value[]"]').value = '';

            // Enable the Remove button in the new row
            const removeButton = clone.querySelector('.remove-field');
            removeButton.removeAttribute('disabled');

            container.appendChild(clone);
        });

        container.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('remove-field')) {
                // Prevent removing the first row
                if (container.childElementCount > 1) {
                    container.removeChild(event.target.closest('.row'));
                }
            }
        });
    });
    </script>
    <script>
    function toggleDepositField() {
        var depositField = document.getElementById('deposit_field');
        var depositOptionWith = document.getElementById('with_deposit');
        var depositOptionWithout = document.getElementById('without_deposit');

        if (depositOptionWith.checked) {
            depositField.style.display = 'block';
        } else {
            depositField.style.display = 'none';
            document.getElementById('deposit_amount').value = '';
        }

        if (depositOptionWithout.checked) {
            // You can handle logic for the "Without Deposit" option here if needed
        }
    }
    </script>
    <x-head.tinymce-config />
</x-admin-layout>
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
</style>