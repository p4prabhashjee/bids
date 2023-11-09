<x-admin-layout>

    <main class="main-content position-relative border-radius-lg ">
        @include('admin.include.navbar', ['module' => 'Projects', 'link' => 'admin.projects.index', 'page' => 'Create
        Project'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="col-12 col-lg-8 m-auto">
                            <form action="{{route('admin.projects.store')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                                    <h5 class="font-weight-bolder mb-0">Add Project</h5>
                                    <p class="mb-0 text-sm">Mandatory informations</p>
                                    <div class="multisteps-form__content">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>Name</label>
                                                <input class="multisteps-form__input form-control" type="text" name="name"
                                                    placeholder="eg. Name" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" value="{{old('name')}}">
                                                @if($errors->has('name'))
                                                <div class="error">{{$errors->first('name')}}</div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label>Project Image</label>
                                                <input class="form-control" type="file" placeholder="Project Image"
                                                    onfocus="focused(this)" name="image_path"
                                                    accept="image/png, image/jpeg, image/jpg" onfocusout="defocused(this)">
                                                @if($errors->has('image_path'))
                                                <div class="error">{{$errors->first('image_path')}}</div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <label><strong>Start Date & Time</strong></label>
                                                <input class="multisteps-form__input form-control" type="text" id="start_date" name="start_date_time"
                                                    value="{{ old('start_date_time') }}" data-input
                                                    data-enable-time data-date-format="Y-m-d H:i" data-min-date="{{ date('Y-m-d') }}">
                                                @if($errors->has('start_date_time'))
                                                <div class="error">{{ $errors->first('start_date_time') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <label><strong>Buyers_Premium</strong></label>
                                                <input class="multisteps-form__input form-control" type="number"
                                                    id="estimated_price" name="buyers_premium"
                                                    placeholder="eg.Min Price" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" value="{{ old('buyers_premium') }}">
                                                @if($errors->has('buyers_premium'))
                                                <div class="error">{{ $errors->first('buyers_premium') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label>status</label>
                                                <select class="choices__list choices__list--single form-control"
                                                    name="status" id="choices-gender" tabindex="-1" data-choice="active">
                                                    <option value="0">Draft</option>
                                                    <option selected value="1">Published</option>
                                                </select>
                                                @if($errors->has('status'))
                                                <div class="error">{{$errors->first('status')}}</div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label><strong>Choose AuctionType:</strong></label>
                                                <select name="auction_type_id"
                                                    class="choices__list choices__list--single form-control" id="brand"
                                                    tabindex="-1" data-choice="active">
                                                    <option value="">Choose AuctionType</option>
                                                    @foreach ($auctiontype as $at)
                                                    <option value="{{ $at->id }}">{{ $at->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-12 col-sm-6 mt-3 test">
                                                <label><strong>Is Trending:</strong></label>
                                                <input type="checkbox" name="is_trending" value="1">
                                            </div>
                                            <div class="col-12 col-sm-12 mt-3 mt-sm-0">
                                                <label>Description</label>
                                                @php $description = old('description') @endphp
                                                <x-forms.tinymce-editor :name="'description'" :data="$description" />
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit"
                                                    title="Submit">Add Blog</button>
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


    <x-head.tinymce-config />
</x-admin-layout>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
    flatpickr("#start_date", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: "{{ date('Y-m-d') }}",
    });
</script>

<style>
.test {
    margin-top: 2rem !important;
}
</style>
