<x-admin-layout>
    <main class="main-content position-relative border-radius-lg ">
        @include('admin.include.navbar', ['module' => 'Auctiontype', 'link' => 'admin.auctiontypes.index', 'page' => 'Edit
        Blog'])
        <div class="container-fluid py-4">
            <div class="row mt-4">
                <div class="card">
                    <div class="col-12 col-lg-8 m-auto">
                        <form class="mb-8" action="{{route('admin.auctiontypes.update', $auctiontype)}}" method="POST"
                            enctype="multipart/form-data" style="height: 408px;">
                            @csrf
                            @method('PUT')
                            <div class="card p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">Edit Auctiontype</h5>
                                <p class="mb-0 text-sm">Mandatory informations</p>
                                <div class="multisteps-form__content">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>Name</label>
                                            <input class="multisteps-form__input form-control" type="text" name="name"
                                                placeholder="eg. Name" onfocus="focused(this)"
                                                onfocusout="defocused(this)" value="{{old('name', $auctiontype->name)}}">
                                            @if($errors->has('name'))
                                            <div class="error">{{$errors->first('name')}}</div>
                                            @endif
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>status</label>
                                            <select class="choices__list choices__list--single form-control"
                                                name="status" id="choices-gender" tabindex="-1">
                                                <option {{old('status', $auctiontype->status) == 0 ? "selected" : ""}}
                                                    value="0">
                                                    Inactive</option>
                                                <option {{old('status', $auctiontype->status) == 1 ? "selected" : ""}}
                                                    value="1">
                                                    Active
                                                </option>
                                            </select>
                                            @if($errors->has('status'))
                                            <div class="error">{{$errors->first('status')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 mt-3 mt-sm-0">
                                        <label>Description</label>
                                        @php $description = old('description', $auctiontype->description) @endphp
                                        <x-forms.tinymce-editor :name="'description'" :data="$description" />
                                    </div>
                                    <div class="button-row d-flex mt-4">
                                        <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit"
                                            title="Submit">Update Auctiontype</button>
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