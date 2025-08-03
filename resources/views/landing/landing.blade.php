<!DOCTYPE html>
<html lang="en">
  <head>
    <title>IWM-IMS</title>
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
			/* margin: 15px; */
			/* margin-bottom: 0px; */
			margin-top: 10px;
			height: auto;
			border: 1px #ddd;
		}
		.hero-wrap {
			width: 100%;
			height: 100vh;
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
			/* height: auto; */
		}
		.carousel-item {
			height: auto;
		}
		.carousel-item {
			max-height: 1200px !important;
		}
		/* .carousel-item {
			max-height: 800px;
		}
		.carousel-item img {
			border-radius: 5px;
			border: 5px solid #ddd;
			height: 500px;
		} */
		.carousel-item img {
			border-radius: 5px;
			border: 5px solid #ddd;
			width: 100%;
			height: auto;
		}
		/* .ol-layer{
			background-color: black !important;
		} */
		.background_black{
			background-color: black !important;
		}
		/* .language-dropdown {
			position: absolute;
			top: 5px;
			right: 5px;
			width: 80px;
			height: 36px !important;
			font-size: 15px;
			background: lightskyblue !important;
			border:0;
			outline:0;
			border-radius: 10px;
			cursor: pointer;
			-webkit-appearance: none;
			-moz-appearance: none;
			text-indent: 1px;
			text-overflow: '';
		} */
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
		.brand-logo{
			align-content: center;
    		justify-content: center;
			margin-bottom: 5px;
		}
		.hero-wrap {
			width: 100%;
			height: 88vh !important;
			position: inherit;
			background-size: cover;
			background-repeat: no-repeat;
			background-position: top center !important;
			position: relative;
			z-index: 0;
		}
		.links{
			padding-left: 15px !important;
			padding-top: 3px;
		}
		.citizen-box {
			text-align: left;
			margin-bottom: 7px;
			border-radius: 10px;
			background: #fff;
			width: 100%;
			float: left;
			padding: 1.2vh 1vh;
		}
		.citizen-box a {
			justify-content: center;
			text-decoration: none;
			text-align: center;
			color: #000;
			font-size: 12px;
			margin: 5px;
			margin-top: 20px;
			width: 100%;
			font-size: 1.7vh;
		}
		.citizen-box img {
			/* width: 75px; */
			width: 6.5vh;
			padding-right: 10px;
			margin-left: 10px;
		}
		.text-white-backgroud-n {
			background-color: rgba(255,255,255);
		}
		.ui-dialog {
			z-index: 999999 !important;
		}
		.slider-text {
			height: unset;
		}

		@media screen and (min-width: 300px) and (max-width: 767px) {
			.hero-wrap {
				height: 130vh !important;
			}
			.brand-logo{
				float: unset;
				text-align: center;
				left: unset;
			}
		}
		@media screen and (min-width: 768px) and (max-width: 850px) {
			.hero-wrap {
				height: 100vh !important;
			}
		}
	</style>
  </head>
  <body>
  	<div class="container-fluid px-md-5  pt-3 pt-md-3">
		<div class="row justify-content-between">
			<div class="col-sx-4 col-sm-3 col-md-12 col-lg-3 d-flex brand-logo">
				<img src="{{ asset('assets/landing/images/IWMLOGO.jpg')}}" style="height: 9vh;margin-top: -2px;">
			</div>
			<div class="col-sx-4 col-sm-9 col-md-12 col-lg-6 order-md-last brand-title">
				<div class="row">
					<div class="col-md-12 text-center" style="padding-right:0px;padding-left:0px;">
						<a class="navbar-brand landing-text-bn" href="/">
							<span class="title">IWM Integrated Management System (IWM-IMS)</span>
							<br>
						</a>
						<a class="navbar-brand landing-text-en" href="/" style="font-size: 37px">
							<span class="title">IWM Integrated Management System (IWM-IMS)</span>
							<br>
						</a>
					</div>
					{{-- <div class="col-md-2 d-md-flex justify-content-end mb-md-0 mb-3" >
						<select name="lang_selector" id="lang_selector" class="form-control language-dropdown">
							<option value="bangla">বাংলা</option>
							<option value="english">English</option>
						</select>
					</div> --}}
				</div>
			</div>
			<div class="col-sx-4 col-sm-3 col-md-12 offset-lg-1 col-lg-2  order-md-last brand-title">
				<div class="row" style="    display: flex;align-content: center;justify-content: center;">
					<select name="lang_selector" id="lang_selector" class="form-control language-dropdown" style="position: relative">
						<option value="bangla">বাংলা</option>
						<option value="english">English</option>
					</select>
					{{-- <button class="btn btn-info pull-right"  style="margin-top:5px;">Login</button> --}}
					<a class="btn btn-info pull-right landing-text-bn" style="margin-top:5px;" href="/dashboard">লগইন</a>
					<a class="btn btn-info pull-right landing-text-en" style="margin-top:5px;" href="/dashboard">Login</a>
				</div>
			</div>
			{{-- <div class="col-sx-2 col-sm-1 col-md-12 col-lg-1 order-md-last brand-title">
				
				<div class="row">
					<button class="btn btn-info">Login</button>
				</div>
			</div> --}}

			{{-- <div class="col-sx-4 col-sm-3 col-md-12 col-lg-3 ">
				<select name="lang_selector" id="lang_selector" class="form-control language-dropdown">
					<option value="bangla">বাংলা</option>
					<option value="english">English</option>
				</select>
			</div> --}}
		</div>
	</div>
		<!-- <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container-fluid">
	    
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="fa fa-bars"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav m-auto">
	        	<li class="nav-item active"><a href="index.html" class="nav-link">Home</a></li>
	        	<li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
	        	<li class="nav-item"><a href="coming-soon.html" class="nav-link">Coming Soon</a></li>
	        	<li class="nav-item"><a href="top-seller.html" class="nav-link">Top Seller</a></li>
	        	<li class="nav-item"><a href="book.html" class="nav-link">Books</a></li>
	        	<li class="nav-item"><a href="author.html" class="nav-link">Author</a></li>
	        	<li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
	          <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav> -->
    <!-- END nav -->
    
    {{-- <section class="hero-wrap" style="background-image: url('{{ asset('assets/landing/images/iwm.jpg')}}');" data-stellar-background-ratio="0.5"> --}}
	<section class="hero-wrap" style="background-image: url('{{ asset('assets/landing/images/iwm.jpg') }}'); background-size: cover; background-position: bottom bottom; height: 100vh;" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container-fluid">
        <div class="row no-gutters slider-text">
		<div class="col-ms-12 col-md-12 col-lg-10 offset-lg-1  ftco-animate d-flex align-items-end" style="margin-bottom:10px;">
			<div class="text w-100 text-white-backgroud-n">
				<p class="mb-0 landing-text-bn" style="text-align: justify;">
				  IWM-IMS (Integrated Management System) is an internal web-based software platform developed by the Institute of Water Modelling (IWM) to centralize and streamline multiple organizational workflows. It serves as a unified digital solution for managing key operational modules such as IT equipment requisition, vehicle requisition, and store and inventory management, with potential to expand into other areas like HR, administration, and finance. 	
				</p>
				<p class="mb-0 landing-text-en" style="text-align: justify;">
				IWM-IMS (Integrated Management System) is an internal web-based software platform developed by the Institute of Water Modelling (IWM) to centralize and streamline multiple organizational workflows. It serves as a unified digital solution for managing key operational modules such as IT equipment requisition, vehicle requisition, and store and inventory management, with potential to expand into other areas like HR, administration, and finance. 
			</div>
		</div>
		 <div class="col-ms-12 col-md-12 col-lg-8 offset-lg-1 ftco-animate d-flex" style="margin-bottom:15px; padding-left: 0px; margin-top: 5px; padding-right: 0px;">
			<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
					<li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
					{{-- <li data-target="#carouselExampleCaptions" data-slide-to="3"></li> --}}
				</ol>
				{{-- <div class="carousel-inner">
					<div class="carousel-item active">
					<img src="{{ asset('assets/landing/images/landing_web_images/banner-8-a.png')}}" class="d-block w-100" alt="Slide Two">
						<div class="carousel-caption d-none d-md-block">
						</div>
					</div>

					<div class="carousel-item">
						<img src="{{ asset('assets/landing/images/landing_web_images/banner-9.png')}}" class="d-block w-100" alt="Slide Three">
						<div class="carousel-caption d-none d-md-block">
						</div>
					</div>
					<div class="carousel-item">
						<img src="{{ asset('assets/landing/images/landing_web_images/banner-11.png')}}" class="d-block w-100" alt="Slide Four">
						<div class="carousel-caption d-none d-md-block">
						</div>
					</div>
				</div> --}}
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
		{{-- <div class="col-lg-2 col-md-12 links">
			<div class="citizen-box  ftco-animate">
				<a href="http://map.land.gov.bd" target="_blank">
					 <img class="img-responsive" src="{{ asset('assets/landing/images/icons/street-map.png')}}" alt="Ministry of Land"> 
					 <span class="landing-text-en">Citizen Portal</span> 
					<span class="landing-text-bn">নাগরিক পোর্টাল</span> 
				</a>
			</div>	
			<div class="citizen-box  ftco-animate">
				<a href="https://minland.gov.bd" target="_blank">
					<img class="img-responsive" src="{{ asset('assets/landing/images/icons/website.png')}}" alt="আর এস খতিয়ান"> 
					<span class="landing-text-en">Ministry of Land</span> 
					<span class="landing-text-bn">ভূমি মন্ত্রণালয়</span> 
			   </a>
			</div>	
			<div class="citizen-box  ftco-animate">
				<a href="https://hotline.land.gov.bd" target="_blank">
					<img class="img-responsive" src="{{ asset('assets/landing/images/icons/dial-pad.png')}}" alt="হটলাইন নাম্বার"> 
					<span class="landing-text-en">Hotline Number</span> 
					<span class="landing-text-bn">হটলাইন নাম্বার</span> 
			   </a>
			</div>	
			<div class="citizen-box  ftco-animate">
				<a href="https://mutation.land.gov.bd" target="_blank">
					<img class="img-responsive" src="{{ asset('assets/landing/images/icons/signboard.png')}}" alt="ই-নামজারি"> 
					<span class="landing-text-en">E-Mutation</span> 
					<span class="landing-text-bn">ই-নামজারি</span> 
				</a>
			</div>	
			<div class="citizen-box  ftco-animate">
				<a href="https://eporcha.gov.bd" target="_blank">
					<img class="img-responsive" src="{{ asset('assets/landing/images/icons/installation.png')}}" alt="ডিজিটাল রেকর্ড রুম"> 
					<span class="landing-text-en">Digital Record Room</span> 
					<span class="landing-text-bn">ডিজিটাল রেকর্ড রুম</span> 
			   </a>
			</div>	
		</div> --}}
		
          {{-- <div class="col-ms-12 col-md-12 col-lg-10 offset-lg-1  ftco-animate d-flex align-items-end" style="margin-bottom:15px;">
			<div class="col-sm-12 col-md-12 col-lg-4 first-div" style="padding-left: 0px;"> 
				<div class="text w-100 text-white-backgroud" style="height: 425px;">
					<p class="mb-0" style="text-align: justify;"> 
						মৌজা ও প্লট ভিত্তিক ভূমি জোনিং প্রকল্পটির আওতায় কোন নির্দিষ্ট এলাকার রিমোট সেন্সিং ইমেজ সংগ্রহ করে মৌজা শীট এর স্ক্যান কপির ওপর প্রক্ষেপন করে মৌজা ও প্লট ভিত্তিক ডিজিটাইজড ভূমি জোনিং মানচিত্র প্রণয়ন করত: ভূমি ব্যবহার পরিকল্পনা প্রণয়ন করা হবে। এটি প্রধানত: প্রশাসনকে ভূমির ভবিষ্যৎ পরিকল্পনা প্রণয়নে সহায়তা করবে। প্রকল্পটির মাধ্যমে প্লট নাম্বার এবং প্লট ভিত্তিক বিস্তারিত তথ্যাদি ভূমি জোনিং মানচিত্রে সন্নিবেশিত করা হবে বিধায় জেলা ও উপজেলা পর্যায়ের ভূমি প্রশাসনের দায়িত্ব প্রাপ্ত কর্মকর্তাগণ এই তথ্য ব্যবহার করে অপ্রতুল ভূমি সম্পদের অনুকূল/বিচক্ষণ ব্যবহার করে দেশের ভূমি সম্পদ সংরক্ষণে প্রয়োজনীয় ভূমিকা রাখতে পারবে। 
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-8" style="padding-right:15px">
				<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
					  <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
					  <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
					  <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                      <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
					</ol>
					<div class="carousel-inner">
					  <div class="carousel-item active">
						<img src="{{ asset('assets/landing/images/slide_one.jpg')}}" class="d-block w-100" alt="Slide One">
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
          	
          </div> --}}
			{{-- <div class="col-md-6 col-sm-12 col-lg-2  offset-lg-2 card-div landing-text-bn">
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
			</div> --}}
			{{-- <div class="col-sm-12 col-md-2 card-div">
				<a href="#"><div class="card" style="width: 100%;">
					<img class="card-img-top" src="{{ asset('assets/landing/images/icons/growth.png')}}" style="" alt="Card image cap">
					<div class="card-body">
					  <p class="card-text">Project Progress <span class="card-details">Package 1-9</span></p>
					</div>
				  </div>
				</a>
			</div> --}}
			{{-- <div class="col-md-6 col-sm-12 col-lg-2 card-div landing-text-bn">
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
			</div> --}}

        </div>
      </div>
    </section>
<!-- 
		<section class="ftco-section ftco-no-pt mt-5 mt-md-0">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-3 d-flex align-items-stretch ftco-animate">
    				<div class="services-2 text-center">
    					<div class="icon-wrap">
	    					<div class="icon d-flex align-items-center justify-content-center">
	    						<span class="flaticon-fantasy"></span>
	    					</div>
    					</div>
    					<h2><a href="#">Children's Book</a></h2>
    					<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
    				</div>
    			</div>
    			<div class="col-md-3 d-flex align-items-stretch ftco-animate">
    				<div class="services-2 text-center">
    					<div class="icon-wrap">
	    					<div class="icon d-flex align-items-center justify-content-center">
	    						<span class="flaticon-heart"></span>
	    					</div>
    					</div>
    					<h2><a href="#">Romance</a></h2>
  						<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
    				</div>
    			</div>
    			<div class="col-md-3 d-flex align-items-stretch ftco-animate">
    				<div class="services-2 text-center">
    					<div class="icon-wrap">
	    					<div class="icon d-flex align-items-center justify-content-center">
	    						<span class="flaticon-model"></span>
	    					</div>
    					</div>
    					<h2><a href="#">Art &amp; Architecture</a></h2>
  						<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
    				</div>
    			</div>
    			<div class="col-md-3 d-flex align-items-stretch ftco-animate">
    				<div class="services-2 text-center">
    					<div class="icon-wrap">
	    					<div class="icon d-flex align-items-center justify-content-center">
	    						<span class="flaticon-history"></span>
	    					</div>
    					</div>
    					<h2><a href="#">History</a></h2>
  						<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
    				</div>
    			</div>
    		</div>
    	</div>
    </section> -->
<!-- 
		<section class="ftco-counter ftco-section ftco-no-pt ftco-no-pb img bg-light" id="section-counter">
    	<div class="container">
    		<div class="row">
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18 py-4 mb-4">
              <div class="text align-items-center">
                <strong class="number" data-number="75678">0</strong>
                <span>Active Readers</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18 py-4 mb-4">
              <div class="text align-items-center">
                <strong class="number" data-number="3040">0</strong>
                <span>Total Pages</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18 py-4 mb-4">
              <div class="text align-items-center">
                <strong class="number" data-number="283">0</strong>
                <span>Cup Of Coffee</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18 py-4 mb-4">
              <div class="text align-items-center">
                <strong class="number" data-number="14500">0</strong>
                <span>Facebook Fans</span>
              </div>
            </div>
          </div>
        </div>
    	</div>
    </section> -->
<!-- 
    <section class="ftco-section">
			<div class="container">
				<div class="row">
					<div class="col-md-6 img img-3 d-flex justify-content-center align-items-center" style="background-image: url(images/about-1.jpg);">
					</div>
					<div class="col-md-6 wrap-about pl-md-5 ftco-animate py-5">
	          <div class="heading-section">
	          	<span class="subheading">Welcome To Publishing Company</span>
	            <h2 class="mb-4">Publishing Company Created By Authors</h2>

	            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
	            <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country.</p>

	            <a href="#" class="btn btn-primary">View All Our Authors</a>
	          </div>

					</div>
				</div>
			</div>
		</section>
		 -->
<!-- 		 
		<section class="ftco-section ftco-no-pt">
    	<div class="container-fluid px-md-4">
    		<div class="row justify-content-center pb-5 mb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading">Books</span>
            <h2>New Release</h2>
          </div>
        </div>
    		<div class="row">
    			<div class="col-md-6 col-lg-4 d-flex">
    				<div class="book-wrap d-lg-flex">
    					<div class="img d-flex justify-content-end" style="background-image: url(images/book-1.jpg);">
    						<div class="in-text">
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Add to cart">
    								<span class="flaticon-shopping-cart"></span>
    							</a>
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Add to Wishlist">
    								<span class="flaticon-heart-1"></span>
    							</a>
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Quick View">
    								<span class="flaticon-search"></span>
    							</a>
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Compare">
    								<span class="flaticon-visibility"></span>
    							</a>
    						</div>
    					</div>
    					<div class="text p-4">
    						<p class="mb-2"><span class="price">$12.00</span></p>
    						<h2><a href="#">You Are Your Only Limit</a></h2>
    						<span class="position">By John Nathan Muller</span>
    					</div>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-4 d-flex">
    				<div class="book-wrap d-lg-flex">
    					<div class="img d-flex justify-content-end" style="background-image: url(images/book-2.jpg);">
    						<div class="in-text">
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Add to cart">
    								<span class="flaticon-shopping-cart"></span>
    							</a>
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Add to Wishlist">
    								<span class="flaticon-heart-1"></span>
    							</a>
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Quick View">
    								<span class="flaticon-search"></span>
    							</a>
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Compare">
    								<span class="flaticon-visibility"></span>
    							</a>
    						</div>
    					</div>
    					<div class="text p-4">
    						<p class="mb-2"><span class="price sale">$12.00</span> <span class="price">$8.00</span></p>
    						<h2><a href="#">101 Essays That Will Change The Way Your Thinks</a></h2>
    						<span class="position">By John Nathan Muller</span>
    					</div>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-4 d-flex">
    				<div class="book-wrap d-lg-flex">
    					<div class="img d-flex justify-content-end" style="background-image: url(images/book-3.jpg);">
    						<div class="in-text">
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Add to cart">
    								<span class="flaticon-shopping-cart"></span>
    							</a>
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Add to Wishlist">
    								<span class="flaticon-heart-1"></span>
    							</a>
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Quick View">
    								<span class="flaticon-search"></span>
    							</a>
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Compare">
    								<span class="flaticon-visibility"></span>
    							</a>
    						</div>
    					</div>
    					<div class="text p-4">
    						<p class="mb-2"><span class="price">$12.00</span></p>
    						<h2><a href="#">Your Soul Is A River</a></h2>
    						<span class="position">By John Nathan Muller</span>
    					</div>
    				</div>
    			</div>

    			<div class="col-md-6 col-lg-4 d-flex">
    				<div class="book-wrap d-lg-flex">
    					<div class="img d-flex justify-content-end" style="background-image: url(images/book-4.jpg);">
    						<div class="in-text">
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Add to cart">
    								<span class="flaticon-shopping-cart"></span>
    							</a>
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Add to Wishlist">
    								<span class="flaticon-heart-1"></span>
    							</a>
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Quick View">
    								<span class="flaticon-search"></span>
    							</a>
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Compare">
    								<span class="flaticon-visibility"></span>
    							</a>
    						</div>
    					</div>
    					<div class="text p-4 order-md-first">
    						<p class="mb-2"><span class="price">$9.00</span></p>
    						<h2><a href="#">All The Letters I Should Have Sent</a></h2>
    						<span class="position">By John Nathan Muller</span>
    					</div>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-4 d-flex">
    				<div class="book-wrap d-lg-flex">
    					<div class="img d-flex justify-content-end" style="background-image: url(images/book-5.jpg);">
    						<div class="in-text">
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Add to cart">
    								<span class="flaticon-shopping-cart"></span>
    							</a>
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Add to Wishlist">
    								<span class="flaticon-heart-1"></span>
    							</a>
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Quick View">
    								<span class="flaticon-search"></span>
    							</a>
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Compare">
    								<span class="flaticon-visibility"></span>
    							</a>
    						</div>
    					</div>
    					<div class="text p-4 order-md-first">
    						<p class="mb-2"><span class="price">$20.00</span></p>
    						<h2><a href="#">Happy</a></h2>
    						<span class="position">By John Nathan Muller</span>
    					</div>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-4 d-flex">
    				<div class="book-wrap d-lg-flex">
    					<div class="img d-flex justify-content-end" style="background-image: url(images/book-6.jpg);">
    						<div class="in-text">
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Add to cart">
    								<span class="flaticon-shopping-cart"></span>
    							</a>
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Add to Wishlist">
    								<span class="flaticon-heart-1"></span>
    							</a>
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Quick View">
    								<span class="flaticon-search"></span>
    							</a>
    							<a href="#" class="icon d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="left" title="Compare">
    								<span class="flaticon-visibility"></span>
    							</a>
    						</div>
    					</div>
    					<div class="text p-4 order-md-first">
    						<p class="mb-2"><span class="price">$12.00</span></p>
    						<h2><a href="#">Milk &amp; Honey</a></h2>
    						<span class="position">By John Nathan Muller</span>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
   -->
<!--    
    <section class="ftco-section testimony-section ftco-no-pb">
    	<div class="img img-bg border" style="background-image: url(images/bg_4.jpg);"></div>
    	<div class="overlay"></div>
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
          	<span class="subheading">Testimonial</span>
            <h2 class="mb-3">Kinds Words From Clients</h2>
          </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl">
              <div class="item">
                <div class="testimony-wrap py-4">
                	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                  <div class="text">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <div class="d-flex align-items-center">
                    	<div class="user-img" style="background-image: url(images/person_1.jpg)"></div>
                    	<div class="pl-3">
		                    <p class="name">Roger Scott</p>
		                    <span class="position">Marketing Manager</span>
		                  </div>
	                  </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap py-4">
                	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                  <div class="text">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <div class="d-flex align-items-center">
                    	<div class="user-img" style="background-image: url(images/person_2.jpg)"></div>
                    	<div class="pl-3">
		                    <p class="name">Roger Scott</p>
		                    <span class="position">Marketing Manager</span>
		                  </div>
	                  </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap py-4">
                	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                  <div class="text">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <div class="d-flex align-items-center">
                    	<div class="user-img" style="background-image: url(images/person_3.jpg)"></div>
                    	<div class="pl-3">
		                    <p class="name">Roger Scott</p>
		                    <span class="position">Marketing Manager</span>
		                  </div>
	                  </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap py-4">
                	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                  <div class="text">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <div class="d-flex align-items-center">
                    	<div class="user-img" style="background-image: url(images/person_1.jpg)"></div>
                    	<div class="pl-3">
		                    <p class="name">Roger Scott</p>
		                    <span class="position">Marketing Manager</span>
		                  </div>
	                  </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap py-4">
                	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                  <div class="text">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <div class="d-flex align-items-center">
                    	<div class="user-img" style="background-image: url(images/person_2.jpg)"></div>
                    	<div class="pl-3">
		                    <p class="name">Roger Scott</p>
		                    <span class="position">Marketing Manager</span>
		                  </div>
	                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->



		<!-- <section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row justify-content-center pb-5 mb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading">Price &amp; Plans</span>
            <h2>Affordable Packages</h2>
          </div>
        </div>
    		<div class="row">
    			<div class="col-md-4 ftco-animate d-flex">
	          <div class="block-7 w-100">
	            <div class="text-center">
		            <span class="price"><sup>$</sup> <span class="number">49</span> <sub>/mo</sub></span>
		            <span class="excerpt d-block">For Adults</span>
		            <ul class="pricing-text mb-5">
		              <li><span class="fa fa-check mr-2"></span>Individual Counseling</li>
		              <li><span class="fa fa-check mr-2"></span>Couples Therapy</li>
		              <li><span class="fa fa-check mr-2"></span>Family Therapy</li>
		            </ul>

		            <a href="#" class="btn btn-primary d-block px-2 py-3">Get Started</a>
	            </div>
	          </div>
	        </div>
	        <div class="col-md-4 ftco-animate d-flex">
	          <div class="block-7 w-100">
	            <div class="text-center">
		            <span class="price"><sup>$</sup> <span class="number">79</span> <sub>/mo</sub></span>
		            <span class="excerpt d-block">For Children</span>
		            <ul class="pricing-text mb-5">
		              <li><span class="fa fa-check mr-2"></span>Counseling for Children</li>
		              <li><span class="fa fa-check mr-2"></span>Behavioral Management</li>
		              <li><span class="fa fa-check mr-2"></span>Educational Counseling</li>
		            </ul>

		            <a href="#" class="btn btn-primary d-block px-2 py-3">Get Started</a>
	            </div>
	          </div>
	        </div>
	        <div class="col-md-4 ftco-animate d-flex">
	          <div class="block-7 w-100">
	            <div class="text-center">
		            <span class="price"><sup>$</sup> <span class="number">109</span> <sub>/mo</sub></span>
		            <span class="excerpt d-block">For Business</span>
		            <ul class="pricing-text mb-5">
		              <li><span class="fa fa-check mr-2"></span>Consultancy Services</li>
		              <li><span class="fa fa-check mr-2"></span>Employee Counseling</li>
		              <li><span class="fa fa-check mr-2"></span>Psychological Assessment</li>
		            </ul>

		            <a href="#" class="btn btn-primary d-block px-2 py-3">Get Started</a>
	            </div>
	          </div>
	        </div>
	      </div>
    	</div>
    </section> -->
		
		<!-- <section class="ftco-appointment ftco-section img" style="background-image: url(images/bg_2.jpg);">
			<div class="overlay"></div>
    	<div class="container">
    		<div class="row">
    			<div class="col-md-6 half ftco-animate">
    				<h2 class="mb-4">Send a Message &amp; Get in touch!</h2>
    				<form action="#" class="appointment">
    					<div class="row">
								<div class="col-md-6">
									<div class="form-group">
			              <input type="text" class="form-control" placeholder="Your Name">
			            </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
			              <input type="text" class="form-control" placeholder="Email">
			            </div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
			    					<div class="form-field">
	          					<div class="select-wrap">
	                      <div class="icon"><span class="fa fa-chevron-down"></span></div>
	                      <select name="" id="" class="form-control">
	                      	<option value="">Services</option>
	                        <option value="">Relation Problem</option>
	                        <option value="">Couple Counseling</option>
	                        <option value="">Depression Treatment</option>
	                        <option value="">Family Problem</option>
	                        <option value="">Personal Problem</option>
	                        <option value="">Business Problem</option>
	                      </select>
	                    </div>
			              </div>
			    				</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
			              <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
			            </div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
			              <input type="submit" value="Send message" class="btn btn-primary py-3 px-4">
			            </div>
								</div>
    					</div>
	          </form>
    			</div>
    		</div>
    	</div>
    </section> -->
<!-- 
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading">Blog</span>
            <h2>Recent Blog</h2>
          </div>
        </div>
        <div class="row d-flex">
          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <div class="text text-center">
              	<a href="blog-single.html" class="block-20 img" style="background-image: url('images/image_1.jpg');">
	              </a>
	              <div class="meta text-center mb-2 d-flex align-items-center justify-content-center">
                	<div>
                		<span class="day">02</span>
                		<span class="mos">May</span>
                		<span class="yr">2020</span>
                	</div>
                </div>
                <h3 class="heading mb-3"><a href="#">New Friends With Books</a></h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <div class="text text-center">
              	<a href="blog-single.html" class="block-20 img" style="background-image: url('images/image_2.jpg');">
	              </a>
	              <div class="meta text-center mb-2 d-flex align-items-center justify-content-center">
                	<div>
                		<span class="day">02</span>
                		<span class="mos">May</span>
                		<span class="yr">2020</span>
                	</div>
                </div>
                <h3 class="heading mb-3"><a href="#">New Friends With Books</a></h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <div class="text text-center">
              	<a href="blog-single.html" class="block-20 img" style="background-image: url('images/image_3.jpg');">
	              </a>
	              <div class="meta text-center mb-2 d-flex align-items-center justify-content-center">
                	<div>
                		<span class="day">02</span>
                		<span class="mos">May</span>
                		<span class="yr">2020</span>
                	</div>
                </div>
                <h3 class="heading mb-3"><a href="#">New Friends With Books</a></h3>
								<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>              
							</div>
            </div>
          </div>
        </div>
      </div>
    </section>	 -->

    <footer class="ftco-footer" style="bottom: 0; position: fixed;">
      <div class="container-fluid px-0 bg-green">
      	<div class="container-fluid">
      		<div class="row">
	          <div class="col-sm-12 col-md-6">
	            <p class="mb-0" style="color: rgba(255,255,255,.5); text-align: left;">
					<a href="https://www.iwmbd.org/" target="_blank">Copyright &copy;<script>document.write(new Date().getFullYear());</script> Institute of Water Modelling (IWM). All rights reserved.</a>
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
    
  

  <!-- loader -->
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
</html>