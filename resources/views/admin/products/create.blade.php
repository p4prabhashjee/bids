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
    <x-head.tinymce-config />
</x-admin-layout>