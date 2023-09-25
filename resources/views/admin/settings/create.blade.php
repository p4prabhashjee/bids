<x-admin-layout>
    <main class="main-content position-relative border-radius-lg ">
        @include('admin.include.navbar', ['module' => 'Setting', 'link' => 'admin.settings.index', 'settings' => 'Create Setting'])
        <div class="container-fluid py-4">
            <div class="row mt-4">
                <div class="card">
                    <div class="col-12 col-lg-8 m-auto">
                        <form class="mb-8" action="{{route('admin.settings.store')}}" method="POST"
                            enctype="multipart/form-data" style="height: 408px;">
                            @csrf
                            <div class="card p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">Add Setting</h5>
                                <p class="mb-0 text-sm">Mandatory informations</p>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>Title</label>
                                            <input class="multisteps-form__input form-control" type="text"
                                                name="title" placeholder="eg. Michael" onfocus="focused(this)"
                                                onfocusout="defocused(this)" value="{{old('title')}}">
                                            @if($errors->has('title'))
                                            <div class="error">{{$errors->first('title')}}</div>
                                            @endif
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>Slug</label>
                                            <input class="multisteps-form__input form-control" name="slug"
                                                type="text" placeholder="eg. Prior" onfocus="focused(this)"
                                                onfocusout="defocused(this)" value="{{old('slug')}}">
                                            @if($errors->has('slug'))
                                            <div class="error">{{$errors->first('slug')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>Value</label>
                                            <input class="multisteps-form__input form-control" type="text"
                                                name="value" placeholder="eg. Michael" onfocus="focused(this)"
                                                onfocusout="defocused(this)" value="{{old('value')}}">
                                            @if($errors->has('value'))
                                            <div class="error">{{$errors->first('value')}}</div>
                                            @endif
                                        </div>
                                           <div class="col-12 col-sm-6">
                                            <label>Image</label>
                                            <input class="form-control" type="file" placeholder="Image"
                                                onfocus="focused(this)" name="image"
                                                accept="image/png, image/jpeg, image/jpg" onfocusout="defocused(this)">
                                            @if($errors->has('image'))
                                            <div class="error">{{$errors->first('image')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="button-row d-flex mt-4">
                                        <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit"
                                            title="Submit">Add Setting</button>
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