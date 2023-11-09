<x-admin-layout>
    <main class="main-content position-relative border-radius-lg ">
        @include('admin.include.navbar', ['module' => 'Bidvalue', 'link' => 'admin.bidvalues.index', 'page' => 'Create
        Bidvalue'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="col-12 col-lg-8 m-auto">
                            <form action="{{route('admin.bidvalues.store')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                                    <h5 class="font-weight-bolder mb-0">Add Bid Value</h5>
                                    <p class="mb-0 text-sm">Mandatory informations</p>
                                    <div class="multisteps-form__content">
                                        <div class="row mt-3">
                                            <!-- <div class="col-12 col-sm-6">
                                                <label>min_price</label>
                                                <input class="multisteps-form__input form-control" type="number" name="bidvalue"
                                                    placeholder="eg. 4000" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" value="{{old('bidvalue')}}">
                                                @if($errors->has('bidvalue'))
                                                <div class="error">{{$errors->first('bidvalue')}}</div>
                                                @endif
                                            </div> -->
                                            <div class="col-12 col-sm-6">
                                                <label><strong>Min Price</strong></label>
                                                <input class="multisteps-form__input form-control" type="number"
                                                    id="estimated_price" name="min_price"
                                                    placeholder="eg.Min Price" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" value="{{ old('min_price') }}">
                                                @if($errors->has('min_price'))
                                                <div class="error">{{ $errors->first('min_price') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <label><strong>Max Price</strong></label>
                                                <input class="multisteps-form__input form-control" type="number"
                                                    id="estimated_price" name="max_price"
                                                    placeholder="eg. Max Price" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" value="{{ old('max_price') }}">
                                                @if($errors->has('max_price'))
                                                <div class="error">{{ $errors->first('max_price') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <label><strong>Percentage Value</strong></label>
                                                <input class="multisteps-form__input form-control" type="number"
                                                    id="estimated_price" name="percentage"
                                                    placeholder="eg. Percentage" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" value="{{ old('percentage') }}">
                                                @if($errors->has('percentage'))
                                                <div class="error">{{ $errors->first('percentage') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label>Status</label>
                                                <select class="choices__list choices__list--single form-control"
                                                    name="status" id="choices-gender" tabindex="-1" data-choice="active">
                                                    <option value="0">Draft</option>
                                                    <option selected value="1">Published</option>
                                                </select>
                                                @if($errors->has('status'))
                                                <div class="error">{{$errors->first('status')}}</div>
                                                @endif
                                            </div>
                                            <!-- <div class="col-12 col-sm-12 mt-3 mt-sm-0">
                                                <label>Description</label>
                                                @php $description = old('description') @endphp
                                                <x-forms.tinymce-editor :name="'description'" :data="$description" />
                                            </div> -->
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit"
                                                    title="Submit">Add Bidvalue</button>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <x-head.tinymce-config />
</x-admin-layout>