@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Shipping</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('shipping.create') }}" class="btn btn-primary">New Shipping</a>
                </div>
            </div>
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Country</th>
                        <th>Amount</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection

@push('script')
    <script>
        $(function() {
            // ==========csrf token setup=========
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

            });
            // =========end of csrf token setup=======

            // ==========Render DataTable==========
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                searchDelay: 2000,
                ajax: "{{ route('shipping.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'country_name',
                        name: 'country_name'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
            // ========end of rendering data table==========

            // =========delete shipping charge===========
            $('body').on('click', '.deleteShippingCharge', function() {
                var shipping_id = $(this).data("id");

                // Show confirmation dialog and check if the user clicked "OK"
                if (confirm("Are you sure you want to delete this shipping charge?")) {
                    // If confirmed, proceed with the AJAX request
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('/admin/shipping') }}" + '/' + shipping_id,
                        success: function(data) {
                            table.draw(); // Redraw the table (assuming DataTable or similar)
                            toastify().success(data.success);
                        },
                        error: function(data) {
                            toastify().error(data.error);
                        }
                    });
                }
            });

            // =========end to delete shipping charge=====
        });
    </script>
@endpush
