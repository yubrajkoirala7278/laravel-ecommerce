<!DOCTYPE html>
<html class="no-js" lang="en_AU" />

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Ecommerce</title>
    <meta name="description" content="" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/slick-theme.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/video-js.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css') }}?v={{ rand(111, 999) }}" />

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleaspis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Raleway:ital,wght@0,400;0,600;0,800;1,200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@300;400;700;900&display=swap"
        rel="stylesheet">

    <!-- Fav Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="#" />

    {{-- price range slider range --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.js"></script>
    {{-- csrf token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- toastify css --}}
    @toastifyCss

</head>

<body data-instant-intensity="mousedown">

    <div class="bg-light top-header">
        <div class="container">
            <div class="row align-items-center py-3 d-none d-lg-flex justify-content-between">
                <div class="col-lg-4 logo">
                    <a href="{{ route('frontend.home') }}" class="text-decoration-none">
                        <span class="h1 text-uppercase text-primary bg-dark px-2">Online</span>
                        <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">SHOP</span>
                    </a>
                </div>
                <div class="col-lg-6 col-6 text-left  d-flex justify-content-end align-items-center">
                    <a href="{{route('frontend.my_account')}}" class="nav-link text-dark">Profile</a>
                    <form action="">
                        <div class="input-group">
                            <input type="text" placeholder="Search For Products" class="form-control"
                                aria-label="Amount (to the nearest dollar)">
                            <span class="input-group-text">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </form>
                    <a href="{{route('frontend.cart')}}" class="cart-icon mx-3">
                        <i class="fa-solid fa-cart-shopping fs-4"></i>
                        <span class="cart-badge" id="cart-count">0</span>
                    </a>
                    @if (Auth::user())
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <a href="#" class="nav-link btn btn-success text-white ms-2"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link btn btn-success text-white ms-2">Login</a>
                    @endif

                </div>
            </div>
        </div>
    </div>

    @yield('content')
    <footer class="bg-dark mt-5">
        <div class="container pb-5 pt-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-card">
                        <h3>Get In Touch</h3>
                        <p>No dolore ipsum accusam no lorem. <br>
                            123 Street, New York, USA <br>
                            exampl@example.com <br>
                            000 000 0000</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="footer-card">
                        <h3>Important Links</h3>
                        <ul>
                            <li><a href="{{route('frontend.aboutus')}}" title="About">About</a></li>
                            <li><a href="{{route('frontend.contactus')}}" title="Contact Us">Contact Us</a></li>
                            <li><a href="#" title="Privacy">Privacy</a></li>
                            <li><a href="{{route('frontend.terms_and_conditions')}}" title="">Terms & Conditions</a></li>
                            <li><a href="#" title="Privacy">Refund Policy</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="footer-card">
                        <h3>My Account</h3>
                        <ul>
                            <li><a href="#" title="Sell">Login</a></li>
                            <li><a href="#" title="Advertise">Register</a></li>
                            <li><a href="#" title="Contact Us">My Orders</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="copy-right text-center">
                            <p>© Copyright 2022 Amazing Shop. All Rights Reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
    <script src="{{ asset('frontend/js/instantpages.5.1.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/lazyload.17.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    {{-- <script>
        window.onscroll = function() {
            myFunction()
        };

        var navbar = document.getElementById("navbar");
        var sticky = navbar.offsetTop;

        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }
    </script> --}}

    {{-- custom js --}}
    @yield('script')

    {{-- toastify  --}}
    @if (session()->has('success') || session()->has('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (session()->has('success'))
                    toastify().success({!! json_encode(session('success')) !!});
                @endif
                @if (session()->has('error'))
                    toastify().error({!! json_encode(session('error')) !!});
                @endif
            });
        </script>
    @endif
    @toastifyJs

    <script type="text/javascript">
        $(document).ready(function() {

            // ============add to cart==================
            $(document).on('click', '.add-to-cart-btn', function(e) {
                e.preventDefault();

                var id = $(this).data('id');

                $.ajax({
                    url: '{{ route('frontend.addToCart', ':id') }}'.replace(':id', id),
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            // Display success message
                            toastify().success(response.success);
                            // call method to update cart count
                            updateCartCount();
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) { // Conflict error
                            toastify().error(xhr.responseJSON.error);
                        } else {
                            toastify().error('An error occurred. Please try again.');
                        }
                    }
                });
            });
            // =============end of add to cart================

            //=========== Function to update the cart count===========
            function updateCartCount() {
                $.ajax({
                    url: '{{ route('frontend.getCartCount') }}',
                    type: 'GET',
                    success: function(response) {
                        // Update the cart count badge dynamically
                        if (response.cartCount > 9) {
                            $('#cart-count').text('9+');
                        } else {
                            $('#cart-count').text(response.cartCount);
                        }

                    },
                    error: function() {
                        console.error('Failed to update cart count');
                    }
                });
            }
            // =============end of Function to update the cart count=============

            // ===========call function to update cart count initially==============
            updateCartCount();
            // =====end of calling function to update cart count initially=========
        });
    </script>


</body>

</html>
