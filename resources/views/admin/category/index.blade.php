@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Categories</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('category.create') }}" class="btn btn-primary">New Category</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card px-2 px-md-4 py-2 py-md-4">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap table-bordered" id="category-table">
                        <thead>
                            <tr>
                                <th width="60">#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th width="100">Status</th>
                                <th>Image</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            // =====setup csrf token======
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            // ===========READ DATA FROM DB(READ)====================//
            var table = $('#category-table').DataTable({
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "ordering": false,
                searchDelay: 2000,
                "ajax": {
                    url: "{{ route('category.index') }}",
                    type: 'GET',
                    dataType: 'JSON'
                },
                "columns": [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'slug',
                        name: 'slug'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            if (data == 1) {
                                return '<i class="far fa-circle-check text-success"></i>';
                            } else {
                                return '<i class="far fa-circle-xmark text-danger"></i>';
                            }
                        }
                    },
                    {
                        data: "image",
                        name: "image",
                        "render": function(data, type, full, meta) {
                            return '<img src="{{ asset('storage/images/category/') }}/' + data +
                                '" alt="Image" style="height:20px">';
                        },
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                "lengthMenu": [
                    [10, 20, 50, -1],
                    [10, 20, 50, "All"]
                ],
                "pagingType": "simple_numbers"
            });
            // ===================================================================//

             // ================DELETE BLOG==============================//
          $('body').on('click', '.delButton', function() {
                let slug = $(this).data('slug');
                if (confirm('Are you sure you want to delete it')) {
                    $.ajax({
                        url: '{{ url('admin/category', '') }}' + '/' + slug,
                        method: 'DELETE',
                        success: function(response) {
                            // refresh the table after delete
                            table.draw();
                            // display the delete success message
                            toastify().success(response.success);
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            });
        // =====================================================================//
        });
    </script>
@endpush
