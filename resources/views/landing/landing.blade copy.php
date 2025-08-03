<!DOCTYPE html>
<html lang="en">
<head>
    <title>IT Equipment Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/landing/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/style.css') }}">

    <style>
        .carousel-item img {
            border-radius: 5px;
            border: 5px solid #ddd;
            width: 100%;
            height: auto;
        }

        .language-dropdown {
            position: absolute;
            top: 10px;
            right: 15px;
            z-index: 10;
        }

        .carousel-padding {
            margin-bottom: 15px;
            padding-left: 15px;
            padding-right: 15px;
        }

        .ftco-footer {
            background: #f8f9fa;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>

{{-- Language Switcher --}}
<div class="language-dropdown">
    <form method="POST" action="{{ route('lang.switch') }}">
        @csrf
        <select name="lang" onchange="this.form.submit()" class="form-control">
            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
            <option value="bn" {{ app()->getLocale() == 'bn' ? 'selected' : '' }}>বাংলা</option>
        </select>
    </form>
</div>

{{-- Carousel --}}
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 ftco-animate d-flex align-items-end carousel-padding">
                <div id="carouselExampleIndicators" class="carousel slide w-100" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('assets/landing/images/slide1.jpg') }}" class="d-block w-100" alt="Slide 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/landing/images/slide2.jpg') }}" class="d-block w-100" alt="Slide 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/landing/images/slide3.jpg') }}" class="d-block w-100" alt="Slide 3">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Comment Section --}}
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center heading-section ftco-animate">
                <h2 class="mb-4">Leave a Comment</h2>
            </div>
        </div>
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Your name" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Your email" required>
            </div>
            <div class="form-group">
                <textarea name="comment" cols="30" rows="5" class="form-control" placeholder="Write your comment..." required></textarea>
            </div>
            <div class="form-group text-center">
                <input type="submit" value="Submit Comment" class="btn btn-primary py-3 px-5">
            </div>
        </form>
    </div>
</section>

{{-- Footer --}}
<footer class="ftco-footer">
    <div class="container">
        <p>&copy; {{ date('Y') }} IT Equipment Management System. All rights reserved.</p>
    </div>
</footer>

{{-- Scripts --}}
<script src="{{ asset('assets/landing/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/landing/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/landing/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/landing/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/landing/js/aos.js') }}"></script>
<script src="{{ asset('assets/landing/js/main.js') }}"></script>

</body>
</html>

<!-- <!DOCTYPE html>
<html lang="en">
  <head>
    <title>IWM Integrated Management System (IWM-IMS)</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('assets/landing/css/animate.css') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/landing/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/magnific-popup.css') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/landing/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/style.css') }}">
	<style>
		.carousel-item img {
			border-radius: 5px;
			border: 5px solid #ddd;
			height: 425px;
		}
		.card-img-top {
			width: 35%;
			margin-left: 33%;
			border-top-left-radius: calc(0.25rem - 1px);
			border-top-right-radius: calc(0.25rem - 1px);
			margin-top: 10px;
		}
		.card-details {
			font-size: 13px;
			display: inherit;
		}
		.text-white-backgroud-n {
			background-color: rgba(255,255,255,0.8);
			padding: 20px;
			border-radius: 5px;
			margin-top: 10px;
			height: auto;
			border: 1px #ddd;
		}
		.hero-wrap {
			width: 100%;
			height: 115vh;
			position: inherit;
			background-size: cover;
			background-repeat: no-repeat;
			background-position: top center !important;
			position: relative;
			z-index: 0;
		}
		.carousel-item img {
			border-radius: 5px;
			border: 5px solid #ddd;
			height: 600px;
		}
		.carousel-item {
			height: auto;
		}
		.carousel-item {
			max-height: 1200px !important;
		}

		.carousel-item img {
			border-radius: 5px;
			border: 5px solid #ddd;
			width: 100%;
			height: auto;
		}

		.background_black{
			background-color: black !important;
		}
		.language-dropdown {
			position: absolute;
			top: 5px;
			right: 5px;
			width: auto;
			height: 36px !important;
			font-size: 15px;
			border: 0;
			outline: 0;
			border-radius: 10px;
			-moz-appearance: none;
			text-indent: 1px;
			text-overflow: '';
		}
		p.landing-text-bn {
			font-family: 'Kalpurush', sans-serif;
			font-size: 18px !important;
		}
		.landing-text-en {
			display: none;
		}
		.ftco-footer {
			background: unset;
			position: fixed;
			width: 100%;
			bottom: 0;
		}
		.ftco-footer p {
			font-size: 13px;
		}
	</style>
  </head>
  <body>



  	<div class="container-fluid px-md-5  pt-3 pt-md-3">
		<div class="row justify-content-between">
			<div class="col-sx-4 col-sm-3 col-md-12 col-lg-3 d-flex brand-logo">
				<img src="{{ asset('assets/landing/images/logo-1.png')}}" style="height: 9vh;margin-top: -2px;">
			</div>
			<div class="col-sx-4 col-sm-9 col-md-12 col-lg-6 order-md-last brand-title">
				<div class="row">
					<div class="col-md-12 text-center" style="padding-right:0px;padding-left:0px;">
						<a class="navbar-brand landing-text-bn" href="/">
							<span class="title">মৌজা ও প্লট ভিত্তিক জাতীয় ডিজিটাল ভূমি জোনিং প্রকল্প</span>
							<br>
						</a>
						<a class="navbar-brand landing-text-en" href="/" style="font-size: 37px">
							<span class="title">Mauza and Plot Based National Digital Land Zoning Project</span>
							<br>
						</a>
					</div>
				</div>
			</div>
			<div class="col-sx-4 col-sm-3 col-md-12 col-lg-3 order-md-last brand-title">
				<div class="row">
					<select name="lang_selector" id="lang_selector" class="form-control language-dropdown">
						<option value="bangla">বাংলা</option>
						<option value="english">English</option>
					</select>
				</div>
			</div>

		</div>
	</div>

    
    <section class="hero-wrap" style="background-image: url('{{ asset('assets/landing/images/main_bg.png')}}');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container-fluid">
        <div class="row no-gutters slider-text">
		<div class="col-ms-12 col-md-12 col-lg-10 offset-lg-1  ftco-animate d-flex align-items-end" style="margin-bottom:5px;">
			<div class="text w-100 text-white-backgroud-n">
				<p class="mb-0 landing-text-bn" style="text-align: justify;">
					মৌজা ও প্লট ভিত্তিক জাতীয় ডিজিটাল ভূমি জোনিং প্রকল্পটির আওতায় ভূমির যথাযথ ব্যবহার নিশ্চিত করা এবং যথেচ্ছ ব্যবহার প্রতিরোধ করার জন্য বিভিন্ন কাজে ব্যবহার্য এলাকা ও ক্ষেত্র ভিত্তিক (কৃষি, আবাসিক,  বনাঞ্চল, জলমহাল, রাস্তঘাট, শিল্প প্রতিষ্ঠান, চা বাগান, উপকূলীয় এলাকা, চরাঞ্চল ইত্যাদি) ভূমি চিন্থিত করা হবে। এই প্রকল্পে মৌজা ম্যাপ শীট সমূহ ডিজিটাইজড ও জিও রেফারেন্সিং করা হচ্ছে। স্যাটেলাইট ইমেজ সংগ্রহ পূর্বক তা প্রক্ষেপন করে মৌজা ও প্লট ভিত্তিক ডিজিটাল ভূমি ব্যবহার ও ভূমি জোনিং মানচিত্র ও প্রতিবেদন প্রণয়ন করা হবে। এই তথ্য ব্যবহার করে অপ্রতুল ভূমি সম্পদের অনুকূল/বিচক্ষণ ব্যবহার করে দেশের ভূমি সম্পদ সংরক্ষণে প্রয়োজনীয় ভূমিকা রাখতে পারবে। এটি প্রধানত: প্রশাসনকে ভূমির ভবিষ্যৎ পরিকল্পনা প্রণয়নে সহায়তা করবে।
				</p>
				<p class="mb-0 landing-text-en" style="text-align: justify;">
					Mouza and plot based national digital land zoning project will ensure proper use of land and prevent arbitrary use of land under different use areas and sector wise (agricultural, residential, forest, waterways, highways, industrial establishments, tea plantations, coastal areas, grazing areas etc.) land will be registered. In this project Mouza map sheets are being digitized and geo-referenced. Mouza and plot based digital land use and land zoning maps and reports will be prepared after collecting satellite images and projecting them. By using this information one can play a necessary role in conserving the country's land resources by making optimal/judicious use of the scarce land resources. It will mainly help the administration in planning the future of the land.
				</p>
			</div>
		</div>
		 <div class="col-ms-12 col-md-12 col-lg-8 offset-lg-2  ftco-animate d-flex align-items-end" style="margin-bottom:15px;    padding-left: 15px;
		 padding-right: 15px;">
			<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
				  <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
				  <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
				</ol>
				<div class="carousel-inner">
				  <div class="carousel-item active">
					<img src="{{ asset('assets/landing/images/slide_two.jpg')}}" class="d-block w-100" alt="Slide One">
					<div class="carousel-caption d-none d-md-block">
					</div>
				  </div>
				  <div class="carousel-item">
					<img src="{{ asset('assets/landing/images/slide_two.jpg')}}" class="d-block w-100" alt="Slide Two">
					<div class="carousel-caption d-none d-md-block">
					</div>
				  </div>
				</div>
				<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
				  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				  <span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
				  <span class="carousel-control-next-icon" aria-hidden="true"></span>
				  <span class="sr-only">Next</span>
				</a>
			  </div>
		</div>
		
			<div class="col-md-6 col-sm-12 col-lg-2  offset-lg-2 card-div landing-text-bn">
				<a href="/dashboard"><div class="card" style="width: 100%;">
					<img class="card-img-top" src="{{ asset('assets/landing/images/icons/dashboard.png')}}" alt="BDMLS Dashboard">
					<div class="card-body">
					  <p class="card-text">ড্যাশবোর্ড<span class="card-details">প্যাকেজ-৯</span></p>
					</div>
				  </div>
				</a>
			</div>
			<div class="col-md-6 col-sm-12 col-lg-2 card-div landing-text-bn">
				<a href="#"><div class="card" style="width: 100%;">
					<img class="card-img-top" src="{{ asset('assets/landing/images/icons/digital.png')}}" alt="Card image cap">
					<div class="card-body">
					  <p class="card-text">ডিজিটাইজেশন<span class="card-details">প্যাকেজ ১-৮</span></p>
					</div>
				  </div>
				</a>
			</div>
			<div class="col-md-6 col-sm-12 col-lg-2 card-div landing-text-bn">
				<a href="{{ route('comments.index') }}"><div class="card" style="width: 100%;">
					<img class="card-img-top" src="{{ asset('assets/landing/images/icons/feedback.png')}}" style="" alt="Card image cap">
					<div class="card-body">
					  <p class="card-text">ফিডব্যাক সিস্টেম <span class="card-details">প্যাকেজ ১-৯</span></p>
					</div>
				  </div>
				</a>
			</div>
			<div class="col-md-6 col-sm-12 col-lg-2 card-div landing-text-bn">
				<a href="#"><div class="card" style="width: 100%;">
					<img class="card-img-top" src="{{ asset('assets/landing/images/icons/user-interface.png')}}" style="" alt="Card image cap">
					<div class="card-body">
					  <p class="card-text">মোবাইল অ্যাপ <span class="card-details">প্যাকেজ-৯</span></p>
					</div>
				  </div>
				</a>
				<br><br>
			</div>

			<div class="col-md-6 col-sm-12 col-lg-2  offset-lg-2 card-div landing-text-en">
				<a href="/dashboard"><div class="card" style="width: 100%;">
					<img class="card-img-top" src="{{ asset('assets/landing/images/icons/dashboard.png')}}" alt="BDMLS Dashboard">
					<div class="card-body">
					  <p class="card-text">Dashboard<span class="card-details">Package-9</span></p>
					</div>
				  </div>
				</a>
			</div>
			<div class="col-md-6 col-sm-12 col-lg-2 card-div landing-text-en">
				<a href="#"><div class="card" style="width: 100%;">
					<img class="card-img-top" src="{{ asset('assets/landing/images/icons/digital.png')}}" alt="Card image cap">
					<div class="card-body">
					  <p class="card-text">Mouza Digitization<span class="card-details">Package 1-8</span></p>
					</div>
				  </div>
				</a>
			</div>
			<div class="col-md-6 col-sm-12 col-lg-2 card-div landing-text-en">
				<a href="/comments"><div class="card" style="width: 100%;">
					<img class="card-img-top" src="{{ asset('assets/landing/images/icons/feedback.png')}}" style="" alt="Card image cap">
					<div class="card-body">
					  <p class="card-text">Feedback System <span class="card-details">Package 1-9</span></p>
					</div>
				  </div>
				</a>
			</div>

			<div class="col-md-6 col-sm-12 col-lg-2 card-div landing-text-en">
				<a href="#"><div class="card" style="width: 100%;">
					<img class="card-img-top" src="{{ asset('assets/landing/images/icons/user-interface.png')}}" style="" alt="Card image cap">
					<div class="card-body">
					  <p class="card-text">Mobile App <span class="card-details">Package-9</span></p>
					</div>
				  </div>
				</a>
				<br><br>
			</div>

        </div>
      </div>
    </section>


    <footer class="ftco-footer" style="bottom: 0; position: fixed;">
      <div class="container-fluid px-0 bg-green">
      	<div class="container-fluid">
      		<div class="row">
	          <div class="col-sm-12 col-md-6">
	            <p class="mb-0" style="color: rgba(255,255,255,.5); text-align: left;">
					<a href="https://www.iwmbd.org/" target="_blank">Copyright &copy;<script>document.write(new Date().getFullYear());</script>-IWM</a>
				</p>
	          </div>
			  <div class="col-sm-12 col-md-6">
	            <p class="mb-0" style="color: rgba(255,255,255,.5); text-align: right;">
					Design & developed by <a href="javascript:void(0);">ICT-IWM</a>
				</p>
	
	          </div>
	        </div>
      	</div>
      </div>
    </footer>
    
  


  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="{{ asset('assets/landing/js/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/landing/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{ asset('assets/landing/js/popper.min.js')}}"></script>
  <script src="{{ asset('assets/landing/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('assets/landing/js/jquery.easing.1.3.js')}}"></script>
  <script src="{{ asset('assets/landing/js/jquery.waypoints.min.js')}}"></script>
  <script src="{{ asset('assets/landing/js/jquery.stellar.min.js')}}"></script>
  <script src="{{ asset('assets/landing/js/owl.carousel.min.js')}}"></script>
  <script src="{{ asset('assets/landing/js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{ asset('assets/landing/js/jquery.animateNumber.min.js')}}"></script>
  <script src="{{ asset('assets/landing/js/scrollax.min.js')}}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="{{ asset('assets/landing/js/google-map.js')}}"></script>
  <script src="{{ asset('assets/landing/js/main.js')}}"></script>
  <link href="https://fonts.maateen.me/kalpurush/font.css" rel="stylesheet">

  <script>
	  $(function() {
		  $('.landing-text-en').hide();
		  $('#lang_selector').change(function(){
			  if($('#lang_selector').val() == 'bangla') {
				  $('.landing-text-bn').show();
				  $('.landing-text-en').hide();
			  }
			  else if($('#lang_selector').val() == 'english') {
				  $('.landing-text-en').show();
				  $('.landing-text-bn').hide();
			  }
		  });
	  });
  </script>
    
  </body>
</html> -->