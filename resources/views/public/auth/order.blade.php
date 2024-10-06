@extends('public.layouts.master')
@section('content')
    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                        <li class="breadcrumb-item">Settings</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class=" section-11 ">
            <div class="container  mt-5">
                <div class="row">
                    <div class="col-md-3">
                        @include('public.auth.account_panel')
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
                            </div>
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Orders #</th>
                                                <th>Date Purchased</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($orders) > 0)
                                                @foreach ($orders as $key => $order)
                                                    <tr>
                                                        <td>
                                                            <a href="{{route('frontend.my_order_details',$order->id)}}">{{ $key + 1 }}</a>
                                                        </td>
                                                        <td>{{ $order->created_at->format('d M, Y') }}</td>
                                                        <td>
                                                            @if ($order->status == 'pending')
                                                                <span class="badge bg-danger">{{ $order->status }}</span>
                                                            @elseif ($order->status == 'shipped')
                                                                <span class="badge bg-warning">{{ $order->status }}</span>
                                                            @else
                                                                <span class="badge bg-success">{{ $order->status }}</span>
                                                            @endif
                                                        </td>

                                                        <td>${{ $order->total_charge }}</td>
                                                        <td>
                                                            <a href="{{route('frontend.my_order_details',$order->id)}}" class="btn btn-primary btn-sm text-white">View</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('script')
@endsection
