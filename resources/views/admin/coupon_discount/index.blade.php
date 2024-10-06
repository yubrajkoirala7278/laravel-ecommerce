@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Discount Coupon</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('coupon_discount.create') }}" class="btn btn-primary">New Coupon</a>
                </div>
            </div>
            <div style="overflow-x: auto;white-space: nowrap;">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Max Uses</th>
                            <th>Max Uses User</th>
                            <th>Type</th>
                            <th>Discount Amount</th>
                            <th>Min Amount</th>
                            <th>Status</th>
                            <th>Starts At</th>
                            <th>Ends At</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            
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
                },
                cache: false // Disable caching
            });
            // =========end of csrf token setup=======

            // ==========Render DataTable==========
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                searchDelay: 2000,
                ajax: "{{ route('coupon_discount.index') }}",
                type: 'GET',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'code',
                        name: 'code',
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'description',
                        name: 'description',
                        render: function(data) {
                            if (!data) {
                                return '-';
                            }
                            return data.length > 130 ? data.substring(0, 130) + '...' : data;
                        }
                    },
                    {
                        data: 'max_uses',
                        name: 'max_uses',
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'max_uses_user',
                        name: 'max_uses_user',
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'type',
                        name: 'type',
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'discount_amount',
                        name: 'discount_amount',
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'min_amount',
                        name: 'min_amount',
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data) {
                            return data ? (data == 1 ? 'Active' : 'Draft') : 'Draft';
                        }
                    },
                    {
                        data: 'starts_at',
                        name: 'starts_at',
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'expires_at',
                        name: 'expires_at',
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return data ? data : '-';
                        }
                    },
                ]
            });
            // ========end of rendering data table==========

            // =========delete coupon discount===========
            $('body').on('click', '.deleteCouponDiscount', function() {
                var discount_coupon_id = $(this).data("id");

                // Show confirmation dialog and check if the user clicked "OK"
                if (confirm("Are you sure you want to delete this coupon discount?")) {
                    // If confirmed, proceed with the AJAX request
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('/admin/coupon_discount') }}" + '/' + discount_coupon_id,
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
            // =========end to delete coupon discount=====
        });
    </script>
@endpush
