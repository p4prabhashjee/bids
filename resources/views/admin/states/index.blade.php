<x-admin-layout>
    <main class="main-content position-relative border-radius-lg ">
        @include('admin.include.navbar', ['module' => 'States', 'link' => 'admin.states.index', 'page' => 'list'])
        <div class="container-fluid py-4">
            <div class="row mt-4">
                <div class="card">
                    {{ $dataTable->table(['class' => 'table-responsive']) }}
                </div>
            </div>
        </div>
    </main>
    @push('script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush

</x-admin-layout>