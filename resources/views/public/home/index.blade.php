@extends('public.layouts.master')
@section('content')
    <main>
        <section class="section-1">
            <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel"
                data-bs-interval="false">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <!-- <img src="images/carousel-1.jpg" class="d-block w-100" alt=""> -->

                        <picture>
                            <source media="(max-width: 799px)" srcset="{{ asset('frontend/images/carousel-1-m.jpg') }}" />
                            <source media="(min-width: 800px)" srcset="{{ asset('frontend/images/carousel-1.jpg') }}" />
                            <img src="{{ asset('frontend/images/carousel-1.jpg') }}" alt="" />
                        </picture>

                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3">
                                <h1 class="display-4 text-white mb-3">Kids Fashion</h1>
                                <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet
                                    amet amet ndiam elitr ipsum diam</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('frontend.shop') }}">Shop
                                    Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">

                        <picture>
                            <source media="(max-width: 799px)" srcset="{{ asset('frontend/images/carousel-2-m.jpg') }}" />
                            <source media="(min-width: 800px)" srcset="{{ asset('frontend/images/carousel-2.jpg') }}" />
                            <img src="{{ asset('frontend/images/carousel-2.jpg') }}" alt="" />
                        </picture>

                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3">
                                <h1 class="display-4 text-white mb-3">Womens Fashion</h1>
                                <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet
                                    amet amet ndiam elitr ipsum diam</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('frontend.shop') }}">Shop
                                    Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <!-- <img src="images/carousel-3.jpg" class="d-block w-100" alt=""> -->

                        <picture>
                            <source media="(max-width: 799px)" srcset="{{ asset('frontend/images/carousel-3-m.jpg') }}" />
                            <source media="(min-width: 800px)" srcset="{{ asset('frontend/images/carousel-3.jpg') }}" />
                            <img src="{{ asset('frontend/images/carousel-2.jpg') }}" alt="" />
                        </picture>

                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3">
                                <h1 class="display-4 text-white mb-3">Shop Online at Flat 70% off on Branded Clothes</h1>
                                <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet
                                    amet amet ndiam elitr ipsum diam</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('frontend.shop') }}">Shop
                                    Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
        <section class="section-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="box shadow-lg">
                            <div class="fa icon fa-check text-primary m-0 mr-3"></div>
                            <h2 class="font-weight-semi-bold m-0">Quality Product</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 ">
                        <div class="box shadow-lg">
                            <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
                            <h2 class="font-weight-semi-bold m-0">Free Shipping</h2>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="box shadow-lg">
                            <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
                            <h2 class="font-weight-semi-bold m-0">14-Day Return</h2>
                        </div>
                    </div>
                    <div class="col-lg-3 ">
                        <div class="box shadow-lg">
                            <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                            <h2 class="font-weight-semi-bold m-0">24/7 Support</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-3">
            <div class="container">
                <div class="section-title">
                    <h2>Categories</h2>
                </div>
                <div class="row pb-3">
                    @if (count($requiredData['categories']) > 0)
                        @foreach ($requiredData['categories'] as $category)
                            <div class="col-lg-3">
                                <div class="cat-card">
                                    <div class="left">
                                        <img src="{{ asset('storage/images/category/' . $category->image) }}"
                                            alt="" class="img-fluid" loading="lazy">
                                    </div>
                                    <div class="right">
                                        <div class="cat-data">
                                            <h2>{{ $category->name }}</h2>
                                            <p>{{ $category->products_count }} Products</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </section>

        <section class="section-4 pt-5">
            <div class="container">
                <div class="section-title">
                    <h2>Featured Products</h2>
                </div>
                <div class="row pb-3">
                    @if (count($requiredData['featuredProducts']) > 0)
                        @foreach ($requiredData['featuredProducts'] as $product)
                            <div class="col-md-3">
                                <div class="card product-card">
                                    <div class="product-image position-relative">
                                        <a href="{{ route('frontend.product', $product->slug) }}"
                                            class="product-img"><img class="card-img-top"
                                                src="{{ asset('storage/images/products/' . $product->image) }}"
                                                alt="" loading="lazy"></a>
                                        <a class="whishlist" href="javascript:void(0);" data-id="{{ $product->id }}">
                                            <i class="far fa-heart"></i>
                                        </a>

                                        <div class="product-action">
                                            <button class="btn btn-dark add-to-cart-btn" data-id="{{ $product->id }}">
                                                <i class="fa fa-shopping-cart"></i> Add To Cart
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body text-center mt-3">
                                        <a class="h6 link" href="product.php">{{ $product->title }}</a>
                                        <div class="price mt-2">
                                            <span class="h5"><strong>Rs. {{ $product->price }}</strong></span>
                                            @if ($product->compare_price)
                                                <span class="h6 text-underline"><del>Rs.
                                                        {{ $product->compare_price }}</del></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>

        <section class="section-4 pt-5">
            <div class="container">
                <div class="section-title">
                    <h2>Latest Produsts</h2>
                </div>
                <div class="row pb-3">
                    @if (count($requiredData['latestProducts']) > 0)
                        @foreach ($requiredData['latestProducts'] as $product)
                            <div class="col-md-3">
                                <div class="card product-card">
                                    <div class="product-image position-relative">
                                        <a href="{{ route('frontend.product', $product->slug) }}"
                                            class="product-img"><img class="card-img-top"
                                                src="{{ asset('storage/images/products/' . $product->image) }}"
                                                alt="" loading="lazy"></a>
                                        <a class="whishlist" href="javascript:void(0);" data-id="{{ $product->id }}">
                                            <i class="far fa-heart"></i>
                                        </a>
                                        <div class="product-action">
                                            @if ($product->track_qty == true && $product->qty == 0)
                                                <button class="btn btn-danger">
                                                    <i class="fa fa-shopping-cart"></i> Out of Stock
                                                </button>
                                            @else
                                                <button class="btn btn-dark add-to-cart-btn"
                                                    data-id="{{ $product->id }}">
                                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-body text-center mt-3">
                                        <a class="h6 link" href="product.php">{{ $product->title }}</a>
                                        <div class="price mt-2">
                                            <span class="h5"><strong>Rs. {{ $product->price }}</strong></span>
                                            @if ($product->compare_price)
                                                <span class="h6 text-underline"><del>Rs.
                                                        {{ $product->compare_price }}</del></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
    </main>

    {{-- modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Success</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success" role="alert" id="product_name">
                        loading..
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.whishlist').click(function(e) {
                e.preventDefault();

                var productId = $(this).data('id');

                $.ajax({
                    url: '/add-to-wishlist/' + productId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Display a success message in the modal
                        document.getElementById('product_name').innerText =
                            `"${response.product_name}" has been added to your wishlist.`;
                        $('#exampleModal').modal('show');
                    },
                    error: function(xhr) {
                        // Display different error messages based on the status code
                        if (xhr.status === 401) {
                            // Unauthorized: User not logged in
                            toastify().error('Please log in to add to your wishlist!');
                        } else if (xhr.status === 400) {
                            // Bad request: Product already in wishlist
                            toastify().error('This product is already in your wishlist!');
                        } else {
                            // Other errors
                            toastify().error('An error occurred. Please try again later.');
                        }
                    }
                });

            });
        });
    </script>
@endsection
