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
                                @if(count($wishlists)>0)
                                    @foreach ($wishlists as $wishlist)
                                    <div class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom">
                                        <div class="d-block d-sm-flex align-items-start text-center text-sm-start"><a class="d-block flex-shrink-0 mx-auto me-sm-4" href="{{route('frontend.product',$wishlist->product->slug)}}" style="width: 10rem;"><img src="{{ asset('storage/images/products/' . $wishlist->product->image) }}" alt="Product"></a>
                                            <div class="pt-2">
                                                <h3 class="product-title fs-base mb-2"><a href="{{route('frontend.product',$wishlist->product->slug)}}" >{{$wishlist->product->title}}</a></h3>                                        
                                                <div class="fs-lg text-accent pt-2">${{$wishlist->product->price}}</div>
                                            </div>
                                        </div>
                                        <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                                            <form action="{{route('frontend.wishlist.remove',$wishlist->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger btn-sm" type="submit"><i class="fas fa-trash-alt me-2"></i>Remove</button>
                                            </form>
                                        </div>
                                    </div>  
                                    @endforeach
                                @endif
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
