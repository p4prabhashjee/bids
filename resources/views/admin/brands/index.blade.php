<x-admin-layout>
    <main class="main-content position-relative border-radius-lg ">
        @include('admin.include.navbar', ['module' => 'Brand', 'link' => 'admin.brands.index', 'page' => 'list'])
        <div class="container-fluid py-4">
        <div class="row">
               <div class="col-md-2">
                    <label class="tests" for="name">Search Name</label>
                    <input type="text" id="name" class="form-control" placeholder="name">

                </div>
                <div class="col-md-2">
                    <label class="tests" for="created_at">Created At</label>
                    <input type="date" id="created_at" name="created_at" class="form-control">
                </div>


                <div class="col-md-3 col1 mt-4">
                    <button id="filters" class="btn btn-primary btn-fw">Apply Filters</button>
                    <button class="btn btn-primary btn-fw" id="clearBtns">Reset Filters</button>
                </div>
            </div>
            <div class="row mt-4">
                <div class="card">
                    {{ $dataTable->table(['class' => 'table-responsive']) }}
                </div>
            </div>
        </div>
    </main>
    @push('script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    
    <script type="module">
    $(document).ready(function() {
        if ($.fn.dataTable.isDataTable('#brand-table')) {
            var data = $('#brand-table').DataTable();
        } else {
            var data = $('#brand-table').DataTable({
                paging: false
            });
        }

        $('#filters').on('click', function() {
            var name = $('#name').val();
            var created_at = $('#created_at').val(); 

            // Apply filters
            data.column(2).search(name).draw();
            if (created_at) {
                data.column(4).search(created_at).draw();
            }
        });

        $('#clearBtns').on('click', function() {
            $('#name').val('');
            $('#created_at').val(''); 
            data.column(2).search('').draw();
            data.column(4).search('').draw(); 
            console.log('Filters Cleared');
        });
    });
</script>
@endpush
</x-admin-layout>