@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('frontend/styles/product_styles.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/styles/product_responsive.css') }}">
<script src="{{ asset('frontend/js/cart_custom.js') }}"></script>
<link rel="stylesheet" href="{{ asset('frontend/styles/blog_styles.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/styles/blog_responsive.css') }}">

@include('layouts.front_partial.collaps_nav')


<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title">Our Blog</h2>
    </div>
</div>


<!-- Blog -->

	<div class="blog">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="blog_posts d-flex flex-row align-items-start justify-content-between">
						
						<!-- Blog post -->
						<div class="blog_post">
							<div class="blog_image" style="background-image:url(images/blog_1.jpg)"></div>
							<div class="blog_text">Vivamus sed nunc in arcu cursus mollis quis et orci. Interdum et malesuada.</div>
							<div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
						</div>

						<!-- Blog post -->
						<div class="blog_post">
							<div class="blog_image" style="background-image:url(images/blog_2.jpg)"></div>
							<div class="blog_text">Cras lobortis nisl nec libero pulvinar lacinia. Nunc sed ullamcorper massa.</div>
							<div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
						</div>

						<!-- Blog post -->
						<div class="blog_post">
							<div class="blog_image" style="background-image:url(images/blog_3.jpg)"></div>
							<div class="blog_text">Fusce tincidunt nulla magna, ac euismod quam viverra id. Fusce eget metus feugiat</div>
							<div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
						</div>

						<!-- Blog post -->
						<div class="blog_post">
							<div class="blog_image" style="background-image:url(images/blog_4.jpg)"></div>
							<div class="blog_text">Etiam leo nibh, consectetur nec orci et, tempus tempus ex</div>
							<div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
						</div>

						<!-- Blog post -->
						<div class="blog_post">
							<div class="blog_image" style="background-image:url(images/blog_5.jpg)"></div>
							<div class="blog_text">Sed viverra pellentesque dictum. Aenean ligula justo, viverra in lacus porttitor</div>
							<div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
						</div>

						<!-- Blog post -->
						<div class="blog_post">
							<div class="blog_image" style="background-image:url(images/blog_6.jpg)"></div>
							<div class="blog_text">In nisl tortor, tempus nec ex vitae, bibendum rutrum mi. Integer tempus nisi</div>
							<div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
						</div>

						<!-- Blog post -->
						<div class="blog_post">
							<div class="blog_image" style="background-image:url(images/blog_7.jpg)"></div>
							<div class="blog_text">Make Life Easier on Yourself by Accepting “Good Enough.” Don’t Pursue Perfection.</div>
							<div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
						</div>

						<!-- Blog post -->
						<div class="blog_post">
							<div class="blog_image" style="background-image:url(images/blog_8.jpg)"></div>
							<div class="blog_text">13 Reasons You Are Failing At Life And Becoming A Bum</div>
							<div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
						</div>

						<!-- Blog post -->
						<div class="blog_post">
							<div class="blog_image" style="background-image:url(images/blog_9.jpg)"></div>
							<div class="blog_text">4 Steps to Getting Anything You Want In Life</div>
							<div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
						</div>
						
					</div>
				</div>
					
			</div>
		</div>
	</div>


@endsection