<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/styles/bootstrap4/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/slick-1.8.0/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/styles/main_styles.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/styles/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/toastr/toastr.css') }}">
    {{--  <link rel="stylesheet" href="{{ asset('frontend/styles/cart_styles.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/styles/cart_responsive.css') }}">  --}}
      <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <link rel="stylesheet" href="{{ asset('frontend/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
    {{--  <link rel="stylesheet" href="{{ asset('frontend/styles/shop_styles.css') }}">  --}}
    <link rel="stylesheet" href="{{ asset('frontend/styles/shop_responsive.css') }}">


</head>

<body>

<div class="super_container">

	<!-- Header -->

	<header class="header">

		<!-- Top Bar -->

		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('frontend/images/phone.png') }}" alt=""></div>{{ $setting->phone_two }}</div>
                        <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('frontend/images/mail.png') }}" alt=""></div><a href="#"><span class="__cf_email__" data-cfemail="34525547404755585147745359555d581a575b59">{{ $setting->main_email }}</span></a></div>

						<div class="top_bar_content ml-auto">
							@if(Auth::check())
                            <div class="top_bar_menu">
                                <ul class="standard_dropdown top_bar_dropdown" >
                                    <li>
                                        <a href="#">{{ Auth::user()->name }}<i class="fas fa-chevron-down"></i></a>
                                        <ul style="width:200px;">
                                            <li><a href="{{ route('home') }}">Profile</a></li>
                                            <li><a href="{{ route('customer.logout') }}">Logout</a></li>
                                        </ul>
                                    </li>

                                </ul>
                            </div>
                            @endif

                            @guest
							<div class="top_bar_menu">
								<ul class="standard_dropdown top_bar_dropdown">
									<li>


										<a href="#">Login<i class="fas fa-chevron-down"></i></a>
										<ul style="width:300px; padding:10px">
											<div>
                                                <form action="{{ route('login') }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control" name="email" requiired="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" class="form-control" name="password" requiired="">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-sm btn-info">Login</button>
                                                    </div>
                                                     <div class="form-group row">
                                                       <div class="offset-md-2">
                                                           <div class="form-check">
                                                               <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                               <label class="form-check-label" for="remember">
                                                                   {{ __('Remember Me') }}
                                                               </label>
                                                           </div>
                                                       </div>
                                                   </div>
                                                </form>
                                                <div class="form-group">
                                                    <a href="{{ route('social.oauth', 'google') }}" class="btn btn-danger btn-block">Login With Google</a>
                                                </div>
                                            </div>
										</ul>

									</li>
									<li>
										<a href="{{route('register')}}">Register</a>
									</li>
								</ul>
							</div>
                            @endguest

						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Header Main -->

		<div class="header_main">
			<div class="container">
				<div class="row">

					<!-- Logo -->
					<div class="col-lg-3 col-sm-3 col-3 order-1">
						<div class="logo_container">
							<div class="logo">
                                    <a href="{{ url('/') }}" class="logo">Shopping Mart</a>
                            </div>
						</div>
					</div>

					<!-- Search -->
					<div class="col-lg-5 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
									<form action="#" class="header_search_form clearfix">
										<input type="search" required="required" class="header_search_input" placeholder="Search for products...">
										<div class="custom_dropdown">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc">All Categories</span>
												<i class="fas fa-chevron-down"></i>
												<ul class="custom_list clc">
													<li><a class="clc" href="#">All Categories</a></li>
													<li><a class="clc" href="#">Computers</a></li>
													<li><a class="clc" href="#">Laptops</a></li>
													<li><a class="clc" href="#">Cameras</a></li>
													<li><a class="clc" href="#">Hardware</a></li>
													<li><a class="clc" href="#">Smartphones</a></li>
												</ul>
											</div>
										</div>
										<button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{ asset('frontend/images/search.png') }}" alt=""></button>
									</form>
								</div>
							</div>
						</div>
					</div>

                    @php
                        $wishlist=DB::table('wishlists')->where('user_id',Auth::id())->count();
                    @endphp
					<!-- Wishlist -->
					<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
							<div class="wishlist d-flex flex-row align-items-center justify-content-end">
								<div class="wishlist_icon"><img src="{{ asset('frontend/images/heart.png') }}" alt="">
                                    <div class="cart_count"><span>{{ $wishlist }}</span></div>
                                </div>
								<div class="wishlist_content">
									<div class="wishlist_text"><a href="{{ route('wishlist') }}">Wishlist</a></div>
									{{--  <div class="wishlist_count">115</div>  --}}
								</div>
							</div>

							<!-- Cart -->
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<img src="{{ asset('frontend/images/cart.png') }}" alt="">
										<div class="cart_count"><span>{{ Cart::content()->count() }}</span></div>
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="{{ route('cart') }}">Cart</a></div>
										<div class="cart_price">{{ $setting->currency }} {{ Cart::subtotal() }}</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Main Navigation -->

         @yield('navbar')
	</header>

    @yield('content')

	<!-- Footer -->
    @php
        $pages_one=DB::table('pages')->where('page_position',1)->get();
        $pages_two=DB::table('pages')->where('page_position',2)->get();
    @endphp
	<footer class="footer">
		<div class="container">
			<div class="row">

				<div class="col-lg-3 footer_col">
					<div class="footer_column footer_contact">
						<div class="logo_container">
							<div class="logo">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $setting->logo }}" class="rounded-circle me-2" height="50" width="50" alt="Logo">
                                    <a href="#" class="fw-bold fs-5 text-decoration-none logo"><small>Shopping Mart</small></a>
                                </div>
                            </div>
						</div>
						<div class="footer_title">Got Question? Call Us 24/7</div>
						<div class="footer_phone">{{ $setting->phone_one }}</div>
						<div class="footer_contact_text">
							<p> {{ $setting->address }}</p>
						</div>
						<div class="footer_social">
							<ul>
								<li><a href="{{ $setting->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="{{ $setting->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
								<li><a href="{{ $setting->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
								<li><a href="{{ $setting->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
								<li><a href="{{ $setting->linkedin }}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-lg-2 offset-lg-2">
					<div class="footer_column">
						<div class="footer_title">Other Pages</div>
						<ul class="footer_list">
                            @foreach($pages_one as $row)
							<li><a href="{{ route('view.page', $row->page_slug) }}">{{ $row->page_name }}</a></li>
                            @endforeach
					</div>
				</div>

				<div class="col-lg-2">
					<div class="footer_column">
						<ul class="footer_list footer_list_2">
							@foreach($pages_two as $rows)
							<li><a href="{{ route('view.page', $row->page_slug) }}">{{ $rows->page_name }}</a></li>
                            @endforeach
						</ul>
					</div>
				</div>

				<div class="col-lg-2">
					<div class="footer_column">
						<div class="footer_title">Customer Care</div>
						<ul class="footer_list">
							<li><a href="{{ route('home') }}">My Account</a></li>
							<li><a href="{{ route('order.tracking') }}">Order Tracking</a></li>
							<li><a href="#">Wish List</a></li>
							<li><a href="#">Blog</a></li>
							<li><a href="#">Contact Us</a></li>
							<li><a href="#">Become A Vendor</a></li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</footer>

	<!-- Copyright -->

	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col">

					<div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
						<div class="copyright_content">
Copyright &copy;<script data-cfasync="false" src="frontend/../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://templatespoint.net/" target="_blank">TemplatesPoint</a>
</div>
						<div class="logos ml-sm-auto">
							<ul class="logos_list">
								<li><a href="#"><img src="{{ asset('frontend/images/logos_1.png') }}" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset('frontend/images/logos_2.png') }}" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset('frontend/images/logos_3.png') }}" alt=""></a></li>
                                <li><a href="#"><img src="{{ asset('frontend/images/logos_4.png') }}" alt=""></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('frontend/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('frontend/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/greensock/TweenMax.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/greensock/TimelineMax.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/greensock/animation.gsap.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/greensock/ScrollToPlugin.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ asset('frontend/plugins/slick-1.8.0/slick.js') }}"></script>
<script src="{{ asset('frontend/plugins/easing/easing.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>
<script src="{{ asset('frontend/js/product_custom.js') }}"></script>
<script src="{{ asset('frontend/js/shop_custom.js') }}"></script>
<script src="{{ asset('frontend/plugins/Isotope/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
<script src="{{ asset('frontend/plugins/parallax-js-master/parallax.min.js') }}"></script>


<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
    };

    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    @if(session('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif

    @if(session('info'))
        toastr.info("{{ session('info') }}");
    @endif
</script>


<script type="text/javascript" charset="utf-8">
    function cart() {
         $.ajax({
            type:'get',
            url:'#',
            dataType: 'json',
            success:function(data){
               $('.cart_qty').empty();
               $('.cart_total').empty();
               $('.cart_qty').append(data.cart_qty);
               $('.cart_total').append(data.cart_total);
            }
        });
    }
    $(document).ready(function(event) {
        cart();
    });

 </script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

</body>


</html>
