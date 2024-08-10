@extends('public.layouts.master')
@section('content')
    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                        <li class="breadcrumb-item active">Shop</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class="section-6 pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 sidebar">
                        <div class="sub-title">
                            <h2>Categories</h3>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="accordion accordion-flush" id="accordionExample">
                                    @if (count($requiredShopData['categories']) > 0)
                                        @foreach ($requiredShopData['categories'] as $key => $category)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading-{{ $key }}">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-{{ $key }}" aria-expanded="false"
                                                        aria-controls="collapse-{{ $key }}">
                                                        {{ $category->name }}
                                                    </button>
                                                </h2>
                                                <div id="collapse-{{ $key }}" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-{{ $key }}"
                                                    data-bs-parent="#accordionExample" style="">
                                                    <div class="accordion-body">
                                                        <div class="navbar-nav">
                                                            @if (count($category->subCategory) > 0)
                                                                @foreach ($category->subCategory as $subCategory)
                                                                    <a href=""
                                                                        class="nav-item nav-link">{{ $subCategory->name }}</a>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="sub-title mt-5">
                            <h2>Brand</h3>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                @if (count($requiredShopData['brands']) > 0)
                                    @foreach ($requiredShopData['brands'] as $key => $brand)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="{{ $brand->name }}-{{ $key }}">
                                            <label class="form-check-label" for="{{ $brand->name }}-{{ $key }}">
                                                {{ $brand->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif


                            </div>
                        </div>

                        <div class="sub-title mt-5">
                            <h2>Price</h3>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        $0-$100
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        $100-$200
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        $200-$500
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        $500+
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row pb-3">
                            <div class="col-12 pb-1">
                                <div class="d-flex align-items-center justify-content-end mb-4">
                                    <div class="ml-2">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                                data-bs-toggle="dropdown">Sorting</button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Latest</a>
                                                <a class="dropdown-item" href="#">Price High</a>
                                                <a class="dropdown-item" href="#">Price Low</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if (count($requiredShopData['products']))
                                @foreach ($requiredShopData['products'] as $product)
                                    <div class="col-md-4">
                                        <div class="card product-card">
                                            <div class="product-image position-relative">
                                                <a href="" class="product-img"><img class="card-img-top"
                                                        src="{{ asset('storage/images/products/' . $product->image) }}"
                                                        alt=""></a>
                                                <a class="whishlist" href="222"><i class="far fa-heart"></i></a>

                                                <div class="product-action">
                                                    <a class="btn btn-dark" href="#">
                                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body text-center mt-3">
                                                <a class="h6 link" href="product.php">{{$product->title}}</a>
                                                <div class="price mt-2">
                                                    <span class="h5"><strong>${{$product->price}}</strong></span>
                                                        @if($product->compare_price)
                                                    <span class="h6 text-underline"><del>${{$product->compare_price}}</del></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="col-md-12 pt-5">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end">
                                        {{ $requiredShopData['products']->links() }}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
