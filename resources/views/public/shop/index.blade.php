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
                            <h2>Search</h3>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                {{-- ========search field========= --}}
                                <input class="form-control" type="search" name="" id="search"
                                    placeholder="Search products..">
                                {{-- =======end of search field===== --}}
                            </div>
                        </div>

                        <div class="sub-title">
                            <h2>Categories</h3>
                        </div>

                        <div class="card">
                            <div class="card-body">


                                @if (count($requiredShopData['categories']) > 0)
                                    @foreach ($requiredShopData['categories'] as $key => $category)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input category-radio-input" type="radio"
                                                name="category" value="{{ $category->id }}"
                                                id="{{ $category->name }}-{{ $key }}">
                                            <label class="form-check-label" for="{{ $category->name }}-{{ $key }}">
                                                {{ $category->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif


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
                                            <input class="form-check-input brand-check-input" type="checkbox"
                                                value="{{ $brand->id }}" id="{{ $brand->name }}-{{ $key }}">
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

                                <div id="price-slider" style="margin: 20px;"></div>
                                <p>Price: <span id="min-price"></span> - <span id="max-price"></span></p>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row pb-3 d-flex">
                            <div class="col-md-12 order-3">

                                <div class="row" id="product-card">
                                    <!-- Products will be displayed here dynamically -->
                                </div>


                            </div>
                            <div class="col-12 pb-1 order-1">
                                <div class="d-flex align-items-center justify-content-end mb-4">
                                    <div class="ml-2">

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                                data-bs-toggle="dropdown">Sorting</button>
                                            <div class="dropdown-menu dropdown-menu-right sorting-products-filters">
                                                <a class="dropdown-item" href="javascript:void(0)">Latest</a>
                                                <a class="dropdown-item" href="javascript:void(0)">Price High</a>
                                                <a class="dropdown-item" href="javascript:void(0)">Price Low</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="pagination-links" class="mt-4">
                    <!-- Pagination links will be dynamically added here -->
                </div>
            </div>
        </section>
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            // ==========Filter with price slider(range tag)===================
            const priceSlider = document.getElementById('price-slider');
            noUiSlider.create(priceSlider, {
                start: [0, 1000],
                connect: true,
                range: {
                    'min': 0,
                    'max': 1000
                },
                step: 10,
                tooltips: [true, true],
                format: {
                    to: function(value) {
                        return parseInt(value);
                    },
                    from: function(value) {
                        return parseInt(value);
                    }
                }
            });

            priceSlider.noUiSlider.on('update', function(values) {
                $('#min-price').text(values[0]);
                $('#max-price').text(values[1]);
            });

            priceSlider.noUiSlider.on('change', function() {
                searchProducts();
            });
            // ===========end of filter with price slider range=============


            // ============Search products when typing in the search field(input text tag)======
            let timer;
            $('#search').on('keyup', () => {
                clearTimeout(timer);
                timer = setTimeout(searchProducts, 1000);
            });
            // =========end of search products when typing in the search field=====

            // ======Filter products when clicking on sorting options(select tag)========
            $('.sorting-products-filters a').on('click', function() {
                const sortBy = $(this).text().trim();
                searchProducts(sortBy);
            });
            // ======end of filter products when clicking on sorting options===========

            // =========Filter with category(radio button)=======
            const getSelectedCategory = () => {
                return $('input[name="category"]:checked').val(); // Get the value of the selected radio button
            };
            $('.category-radio-input').on('change', function() {
                searchProducts();
            });
            // ==========end of filter with category(radion button)=======

            //=========Filter with brand names(checkbox)=========
            const getSelectedBrands = () => {
                let selectedBrands = [];
                $('.brand-check-input:checked').each(function() {
                    selectedBrands.push($(this).val());
                });
                console.log(selectedBrands);
                return selectedBrands;
            };
            $('.brand-check-input').on('change', function() {
                searchProducts();
            });
            // =========end of filter with brand names==============

            //========== AJAX call to filter and sort products============
            const searchProducts = (sortBy = 'Latest', pageUrl = null) => {
                const keyword = $('#search').val(); // Get searching keyword
                const brands = getSelectedBrands(); // Get the selected brands
                const category = getSelectedCategory(); // Get the selected category
                const minPrice = priceSlider.noUiSlider.get()[0]; // Get min price from slider
                const maxPrice = priceSlider.noUiSlider.get()[1]; // Get max price from slider

                // Determine the URL for pagination or for sorting/filtering
                const url = pageUrl ? pageUrl : "{{ route('frontend.products') }}";

                // Make AJAX GET request with sorting, brand filters, price range, and category
                $.get(url, {
                        'search': keyword,
                        'sort_by': sortBy,
                        'brands': brands,
                        'min_price': minPrice,
                        'max_price': maxPrice,
                        'category_id': category
                    })
                    .done(response => {
                        const products = response.products;
                        $('#product-card').empty();

                        if (products.length > 0) {
                            products.forEach(product => {
                                let comparePrice = '';
                                if (product.compare_price) {
                                    comparePrice =
                                        `<span class="h6 text-underline"><del>${product.compare_price}</del></span>`;
                                }

                                const productCard = `
                                    <div class="col-4">
                                        <div class="card product-card">
                                            <div class="product-image position-relative">
                                                <a href="/product/${product.slug}" class="product-img">
                                                    <img class="card-img-top" 
                                                    src="{{ asset('storage/images/products/') }}/${product.image}" alt="" style="height:300px">
                                                </a>
                                                <a class="whishlist" href="222"><i class="far fa-heart"></i></a>
                                            
                                               <div class="product-action">
                                                <button class="btn btn-dark add-to-cart-btn" data-id="${product.id}">
                                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                                </button>
                                                </div>
                                            </div>
                                            <div class="card-body text-center mt-3">
                                                <a class="h6 link" href="product.php">${product.title}</a>
                                                <div class="price mt-2">
                                                    <span class="h5"><strong>${product.price}</strong></span>
                                                    ${comparePrice}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                             `;

                                $('#product-card').append(productCard);
                            });
                        } else {
                            $('#product-card').append('<p>No products found</p>');
                        }
                        // Update pagination links
                        $('#pagination-links').html(response.pagination);

                        // Bind click event for pagination links
                        $('#pagination-links a').on('click', function(e) {
                            e.preventDefault();
                            const pageUrl = $(this).attr('href');
                            searchProducts(sortBy, pageUrl);
                        });
                    });
            };
            // ======end of AJAX call to filter and sort products==========

            //======== Initial product load===============
            searchProducts();
            // ======end of Initial product load==========
        });
    </script>
@endsection
