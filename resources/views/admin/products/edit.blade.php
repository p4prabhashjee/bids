<x-admin-layout>
    <main class="main-content position-relative border-radius-lg ">
        @include('admin.include.navbar', ['module' => 'Product Auction', 'link' => 'admin.products.index', 'page' =>
        'Edit
        Product Auction'])
        <div class="container-fluid py-4">
            <div class="row mt-4">
                <div class="card">
                    <div class="col-12 col-lg-8 m-auto">
                        <form class="mb-8" action="{{route('admin.products.update', $product)}}" method="POST"
                            enctype="multipart/form-data" style="height: 408px;">
                            @csrf
                            @method('PUT')
                            <div class="card p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">Edit ProductAuction</h5>
                                <p class="mb-0 text-sm">Mandatory informations</p>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>Title</label>
                                            <input class="multisteps-form__input form-control" type="text" name="title"
                                                placeholder="eg.Title" onfocus="focused(this)"
                                                onfocusout="defocused(this)" value="{{old('title', $product->title)}}">
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
                                                <option value="{{ $cat->id }}"
                                                    {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label><strong>Choose a SubCategory::</strong></label>
                                            <select name="subcategory_id"
                                                class="choices__list choices__list--single form-control" id="category"
                                                tabindex="-1" data-choice="active">
                                                <option value="">Select SubCategory</option>
                                                @foreach ($subcat as $scat)
                                                <option value="{{ $scat->id }}"
                                                    {{ old('subcategory_id', $product->subcategory_id) == $scat->id ? 'selected' : '' }}>
                                                    {{ $scat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label><strong>Choose a Brand:</strong></label>
                                            <select name="brand_id"
                                                class="choices__list choices__list--single form-control" id="category"
                                                tabindex="-1" data-choice="active">
                                                <option value="">Select Brand</option>
                                                @foreach ($brands as $b)
                                                <option value="{{ $b->id }}"
                                                    {{ old('brand_id', $product->brand_id) == $b->id ? 'selected' : '' }}>
                                                    {{ $b->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label><strong>Choose a AuctionType::</strong></label>
                                            <select name="auction_type_id"
                                                class="choices__list choices__list--single form-control" id="category"
                                                tabindex="-1" data-choice="active">
                                                <option value="">Select AuctionType</option>
                                                @foreach ($auctiontype as $at)
                                                <option value="{{ $at->id }}"
                                                    {{ old('auction_type_id', $product->auction_type_id) == $at->id ? 'selected' : '' }}>
                                                    {{ $at->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>Status</label>
                                            <select class="choices__list choices__list--single form-control"
                                                name="status" id="choices-gender" tabindex="-1" data-choice="active">
                                                <option value="new"
                                                    {{ old('status', $product->status) == 'new' ? 'selected' : '' }}>New
                                                </option>
                                                <option value="open"
                                                    {{ old('status', $product->status) == 'open' ? 'selected' : '' }}>
                                                    Open</option>
                                                <option value="suspended"
                                                    {{ old('status', $product->status) == 'suspended' ? 'selected' : '' }}>
                                                    Suspended</option>
                                                <option value="closed"
                                                    {{ old('status', $product->status) == 'closed' ? 'selected' : '' }}>
                                                    Closed</option>
                                            </select>
                                            @if ($errors->has('status'))
                                            <div class="error">{{ $errors->first('status') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label><strong>Auction Start Date</strong></label>
                                            <input class="multisteps-form__input form-control" type="date"
                                                id="start_date" name="auction_start_date"
                                                value="{{ old('auction_start_date', $product->auction_start_date) }}"
                                                min="{{ date('Y-m-d') }}">
                                            @if($errors->has('auction_start_date'))
                                            <div class="error">{{ $errors->first('auction_start_date') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label><strong>Auction End Date</strong></label>
                                            <input class="multisteps-form__input form-control" type="date" id="end_date"
                                                name="auction_end_date"
                                                value="{{ old('auction_end_date', $product->auction_end_date) }}"
                                                min="{{ date('Y-m-d') }}">
                                            @if($errors->has('auction_end_date'))
                                            <div class="error">{{ $errors->first('auction_end_date') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                       <div class="col-12 col-sm-6">
                                            <label><strong>Auction Start Time</strong></label>
                                            <input class="multisteps-form__input form-control" type="time"
                                                id="start_time" name="auction_start_time"
                                                value="{{ old('auction_start_time', $product->auction_start_time)}}">
                                            @if($errors->has('auction_start_time'))
                                            <div class="error">{{ $errors->first('auction_start_time') }}</div>
                                            @endif
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <label><strong>Auction End Time</strong></label>
                                            <input class="multisteps-form__input form-control" type="time" id="end_time"
                                                name="auction_end_time" value="{{ old('auction_end_time', $product->auction_end_time)}}">
                                            @if($errors->has('auction_end_time'))
                                            <div class="error">{{ $errors->first('auction_end_time') }}</div>
                                            @endif
                                        </div>   
                                    </div>
                                    <div class="row mt-3">
                                       <div class="col-12 col-sm-6">
                                            <label><strong>Reserved Price</strong></label>
                                            <input class="multisteps-form__input form-control" type="number" step="0.01"
                                                id="reserved_price" name="reserved_price"
                                                placeholder="eg. Reserved Price" onfocus="focused(this)"
                                                onfocusout="defocused(this)" value="{{ old('reserved_price', $product->reserved_price)}}">
                                            @if($errors->has('reserved_price'))
                                            <div class="error">{{ $errors->first('reserved_price') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label><strong>Minimum Bid</strong></label>
                                            <input class="multisteps-form__input form-control" type="number" step="0.01"
                                                id="minimum_bid" name="minimum_bid" placeholder="eg. Minimum Bid"
                                                onfocus="focused(this)" onfocusout="defocused(this)"
                                                value="{{ old('minimum_bid', $product->minimum_bid)}}">
                                            @if($errors->has('minimum_bid'))
                                            <div class="error">{{ $errors->first('minimum_bid') }}</div>
                                            @endif
                                        </div>
                                    </div>                   
                                    <!-- gallery image -->
                                    <div class="col-12 col-sm-12 mt-3 mt-sm-0">
                                        <label><strong>Add or Update Gallery Images</strong></label>
                                        <input class="multisteps-form__input form-control" type="file" id="gallery"
                                            name="image_path[]" multiple accept="image/*" onchange="previewImages()">
                                    </div>
                                    <div class="">

                                    @foreach($galleryImages as $image)
                                    <div class="image-preview" id="image-preview">
                                    <img src="{{ asset($image->image_path) }}" alt="Gallery Image">
                                    </div>
                                    @endforeach
                                   </div>

                                    <div class="col-12 col-sm-12 mt-3 mt-sm-0">
                                        <label>Description</label>
                                        @php $description = old('description', $product->description) @endphp
                                        <x-forms.tinymce-editor :name="'description'" :data="$description" />
                                    </div>
                                    <div class="button-row d-flex mt-4">
                                        <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit"
                                            title="Submit">Update Product Auction</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
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