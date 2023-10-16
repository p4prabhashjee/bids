<x-admin-layout>
    <main class="main-content position-relative border-radius-lg ">
        @include('admin.include.navbar', ['module' => 'States', 'link' => 'admin.states.index', 'page' => 'Edit
        State'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="col-12 col-lg-8 m-auto">
                            <form action="{{route('admin.states.update', $state)}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                                    <h5 class="font-weight-bolder mb-0">Edit State</h5>
                                    <p class="mb-0 text-sm">Mandatory informations</p>
                                    <div class="multisteps-form__content">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>Name</label>
                                                <input class="multisteps-form__input form-control" type="text" name="name"
                                                    placeholder="eg. Rajasthan" onfocus="focused(this)"
                                                    onfocusout="defocused(this)" value="{{old('name', $state->name)}}">
                                                @if($errors->has('name'))
                                                <div class="error">{{$errors->first('name')}}</div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label>Select Country</label>
                                                <select class="choices__list choices__list--single form-control"
                                                    name="country_id" id="choices-gender" tabindex="-1">
                                                    <option value="">Select Country</option>
                                                    @foreach ($countries as $country)
                                                    <option
                                                        {{old('country_id', $state->country_id) == $country->id ? "selected" : ""}}
                                                        value="{{$country->id}}">
                                                        {{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('country_id'))
                                                <div class="error">{{$errors->first('country_id')}}</div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label>State Image</label>
                                                <input class="form-control" type="file" placeholder="State Image"
                                                    onfocus="focused(this)" name="image"
                                                    accept="image/png, image/jpeg, image/jpg" onfocusout="defocused(this)">
                                                @if($errors->has('image'))
                                                <div class="error">{{$errors->first('image')}}</div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label>status</label>
                                                <select class="choices__list choices__list--single form-control"
                                                    name="status" id="choices-gender" tabindex="-1">
                                                    <option {{old('status', $state->status) == 0 ? "selected" : ""}}
                                                        value="0">
                                                        Inactive</option>
                                                    <option {{old('status', $state->status) == 1 ? "selected" : ""}}
                                                        value="1">
                                                        Active
                                                    </option>
                                                </select>
                                                @if($errors->has('status'))
                                                <div class="error">{{$errors->first('status')}}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit"
                                                title="Submit">Update State</button>
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
</x-admin-layout>