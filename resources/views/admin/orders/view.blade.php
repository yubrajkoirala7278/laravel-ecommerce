@extends('admin.layouts.app')
@section('header-links')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order: {{ $order->id }}</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="orders.html" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header pt-3">
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <h1 class="h5 mb-3">Shipping Address</h1>
                                    <address>
                                        <strong>{{ $order->first_name }} {{ $order->last_name }}</strong><br>
                                        {{ $order->address }} , {{ $order->apartment }}<br>
                                        {{ $order->city }}, {{ $order->country_name }}<br>
                                        Phone: {{ $order->phone }}<br>
                                        Email: {{ $order->email }}
                                    </address>
                                </div>



                                <div class="col-sm-4 invoice-col">
                                    <b>Invoice #007612</b><br>
                                    <br>
                                    <b>Order ID:</b> {{ $order->id }}<br>
                                    <b>Total:</b> ${{ $order->total_charge }}<br>
                                    <b>Status:</b> <span class="text-success">{{ $order->status }}</span>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th width="100">Price</th>
                                        <th width="100">Qty</th>
                                        <th width="100">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($order->order_items) > 0)
                                        @foreach ($order->order_items as $item)
                                            <tr>
                                                <td>{{ $item->product_name }}</td>
                                                <td>${{ $item->price }}</td>
                                                <td>${{ $item->qty }}</td>
                                                <td>${{ $item->price * $item->qty }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    <tr>
                                        <th colspan="3" class="text-right">Subtotal:</th>
                                        <td>${{ $order->sub_total }}</td>
                                    </tr>

                                    <tr>
                                        <th colspan="3" class="text-right">Shipping:</th>
                                        <td>${{ $order->shipping_charge }}</td>
                                    </tr>

                                    <tr>
                                        <th colspan="3" class="text-right">Coupon Discount:</th>
                                        <td>${{ $order->coupon_discount }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-right">Grand Total:</th>
                                        <td>${{ $order->total_charge }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Order Status</h2>
                            <form action="{{route('admin.update.status',$order->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-control">
                                        <option value="pending"
                                            {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="shipped"
                                            {{ old('status', $order->status) == 'shipped' ? 'selected' : '' }}>Shipped
                                        </option>
                                        <option value="delivered"
                                            {{ old('status', $order->status) == 'delivered' ? 'selected' : '' }}>Delivered
                                        </option>
                                        <option value="cancelled"
                                            {{ old('status', $order->status) == 'cancelled' ? 'selected' : '' }}>Cancelled
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="shipped_date">Shipped Date</label>
                                    <input type="text" name="shipped_date" id="shipped_date"  name="datetime"
                                        class="form-control" placeholder="Select date and time"
                                        value="{{ old('shipped_date',$order->shipped_date) }}">
                                    @error('shipped_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary" type="subit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Send Inovice Email</h2>
                            <div class="mb-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Customer</option>
                                    <option value="">Admin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->

@endsection


@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#shipped_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true
        });
    });
</script>
@endpush
