<x-admin-layout>
    <main class="main-content position-relative border-radius-lg ">
        @include('admin.include.navbar', ['module' => 'Pages', 'link' => 'admin.pages.index', 'page' => 'Edit Page'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="col-12 col-lg-8 m-auto">
                            <form action="{{route('admin.pages.update', $page)}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                                    <h5 class="font-weight-bolder mb-0">Edit Page</h5>
                                    <p class="mb-0 text-sm">Mandatory informations</p>
                                    <div class="multisteps-form__content">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>Title</label>
                                                <input class="multisteps-form__input form-control" type="text"
                                                    name="title" placeholder="eg. Michael" onfocus="focused(this)"
                                                    onfocusout="defocused(this)"
                                                    value="{{old('title', $page->title)}}">
                                                @if($errors->has('title'))
                                                <div class="error">{{$errors->first('title')}}</div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label>Slug</label>
                                                <input class="multisteps-form__input form-control" name="slug"
                                                    type="text" placeholder="eg. Prior" onfocus="focused(this)"
                                                    onfocusout="defocused(this)"
                                                    value="{{old('slug', $page->slug)}}">
                                                @if($errors->has('slug'))
                                                <div class="error">{{$errors->first('slug')}}</div>
                                                @endif
                                            </div>
                                        </div>
                                       
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <label>Blog Image</label>
                                                <input class="form-control" type="file" placeholder="Blog Image"
                                                    onfocus="focused(this)" name="image"
                                                    accept="image/png, image/jpeg, image/jpg" onfocusout="defocused(this)">
                                                @if($errors->has('image'))
                                                <div class="error">{{$errors->first('image')}}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 mt-3 mt-sm-0">
                                            <label>Description</label>
                                            @php $description = old('content', $page->content) @endphp
                                            <x-forms.tinymce-editor :name="'content'" :data="$description" />
                                        </div>
                                        
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit"
                                                title="Submit">Update Page</button>
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