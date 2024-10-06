@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card px-2 px-md-4 py-2 py-md-4">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap table-bordered" id="orders-table">
                        <thead>
                            <tr>
                                <th width="60">#</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th width="100">Status</th>
                                <th>Total</th>
                                <th>Date Purchased</th>
                                <th>Action</th>
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
            var table = $('#orders-table').DataTable({
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "ordering": false,
                searchDelay: 2000,
                "ajax": {
                    url: "{{ route('admin.orders') }}",
                    type: 'GET',
                    dataType: 'JSON'
                },
                "columns": [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: null,
                        name: 'full_name',
                        render: function(data, type, row) {
                            return `${row.first_name} ${row.last_name}`;
                        }
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            if (data == 'pending') {
                                return '<span class="badge bg-danger">Pending</span>';
                            } else if (data == 'delivered') {
                                return '<span class="badge bg-primary">Delivered</span>';
                            } else {
                                return '<span class="badge bg-success">Shipped</span>';
                            }
                        }
                    },
                    {
                        data: 'total_charge',
                        name: 'total_charge',
                        render: function(data, type, row) {
                            return `$${parseFloat(data).toLocaleString()}`;
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'view',
                        name: 'view'
                    }
                ],
                "lengthMenu": [
                    [10, 20, 50, -1],
                    [10, 20, 50, "All"]
                ],
                "pagingType": "simple_numbers"
            });
            // ===================================================================//
        });
    </script>
@endpush
