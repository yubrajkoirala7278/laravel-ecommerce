@extends('public.layouts.master')
@section('content')
    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                        <li class="breadcrumb-item"><a class="white-text" href="#">Shop</a></li>
                        <li class="breadcrumb-item">Checkout</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class="section-9 pt-4">
            <div class="container">
                <div class="thank-you-message text-center">
                    <i class="fa fa-check-circle text-success mb-4" style="font-size: 5rem;"></i>
                    <h1 class="display-4 text-success">Thank You!</h1>
                    <p class="lead">Your order has been placed successfully.</p>
                    <p>We appreciate your business! If you have any questions, please feel free to contact us at any time.</p>
                    <a href="{{route('frontend.home')}}" class="btn btn-success mt-3">Continue Shopping</a>
                </div>
            </div>
        </section>
    </main>
@endsection
