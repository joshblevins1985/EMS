 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>PEASI | Portal</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="/assets/css/one-page-parallax/app.min.css" rel="stylesheet" />
	<script src="https://kit.fontawesome.com/22694c7a2d.js" crossorigin="anonymous"></script>
	<link href="/assets/css/theme/default.css" id="theme" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
</head>
<body data-spy="scroll" data-target="#header" data-offset="51">
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-transparent navbar-fixed-top navbar-expand-lg">
			<!-- begin container -->
			<div class="container">
				<!-- begin navbar-brand -->
				<a href="/" class="navbar-brand">

					<span class="brand-text mt-2">
						<span class="text-danger">Portsmouth</span> <span class="text-silver"> Ambulance</span>
					</span>
				</a>
				<!-- end navbar-brand -->
				<!-- begin navbar-toggle -->
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- end navbar-header -->
				<!-- begin navbar-collapse -->
				<div class="collapse navbar-collapse" id="header-navbar">
					<ul class="nav navbar-nav navbar-right">
						<li class="nav-item dropdown">
							<a class="nav-link active" href="#home" data-click="scroll-to-target" data-scroll-target="#home">HOME <b class="caret"></b></a>
							<div class="dropdown-menu dropdown-menu-left animated fadeInDown">
								<a class="dropdown-item" href="/login">Employee Login</a>

							</div>
						</li>
						<li class="nav-item"><a class="nav-link" href="#about" data-click="scroll-to-target">ABOUT</a></li>
						<li class="nav-item"><a class="nav-link" href="#team" data-click="scroll-to-target">CAREERS</a></li>
						<li class="nav-item"><a class="nav-link" href="#service" data-click="scroll-to-target">SERVICES</a></li>
						<li class="nav-item"><a class="nav-link" href="#client" data-click="scroll-to-target">CLIENT</a></li>
						<li class="nav-item"><a class="nav-link" href="#contact" data-click="scroll-to-target">CONTACT</a></li>
						<li class="nav-item"><a class="nav-link" href="/application/create" >EMPLOYMENT APP</a></li>
						@if(Auth::user())
						<li class="nav-item"><a class="nav-link bg-danger" href="dashboard" >MY DASHBOARD</a></li>
						@endif
						@if(!Auth::user())
						<li class="nav-item"><a href="/login" class="btn btn-outline-white btn-theme btn-block mt-3 ml-3">Employee Login</a></li>
						@endif

					</ul>

				</div>
				<!-- end navbar-collapse -->
			</div>
			<!-- end container -->
		</div>
		<!-- end #header -->

		<!-- begin #home -->
		<div id="home" class="content has-bg home">
			<!-- begin content-bg -->
			<div class="content-bg" style="background-image: url(/assets/img/emergency.jpg);"
				data-paroller="true"
				data-paroller-factor="0.5"
				data-paroller-factor-xs="0.25">
			</div>
			<!-- end content-bg -->
			<!-- begin container -->
			<div class="container home-content">
				<h3>Welcome to Portsmouth Emergency Ambulance Service Inc</h3>
				<h5>Online Portal</h5>
				<p>

				</p>
				<a href="#" class="btn btn-theme btn-danger">Transport Forms</a> <a href="/application/create" class="btn btn-theme btn-outline-white">Careers</a><br />
				<br />

			</div>
			<!-- end container -->
		</div>
		<!-- end #home -->

		<!-- begin #about -->
		<div id="about" class="content" data-scrollview="true">
			<!-- begin container -->
			<div class="container" data-animation="true" data-animation-type="fadeInDown">
				<h2 class="content-title">About Us</h2>
				<p class="content-desc">

				</p>
				<!-- begin row -->
				<div class="row">
					<!-- begin col-4 -->
					<div class="col-md-4 col-sm-12">
						<!-- begin about -->
						<div class="about">
							<h3 class="mb-3">Our Mission</h3>
							<p>
								Our mission is to be the choice provider for local hospitals, nursing homes, medical facilities and
                                residents for the areas that we serve. This is often accomplished by establishing
                                close working relationships with our customers to continually meet and exceed their needs in
                                the area of ground medical transportation.
							</p>

						</div>
						<!-- end about -->
					</div>
					<!-- end col-4 -->
					<!-- begin col-4 -->
					<div class="col-md-4 col-sm-12">
						<h3 class="mb-3">Our Philosophy</h3>
						<!-- begin about-author -->
						<div class="about-author">
							<div class="quote">
								<i class="fa fa-quote-left"></i>
								<h3>One Mission, <br /><span>One Team</span></h3>
								<i class="fa fa-quote-right"></i>
							</div>

						</div>
						<!-- end about-author -->
					</div>
					<!-- end col-4 -->
					<!-- begin col-4 -->
					<div class="col-md-4 col-sm-12">
						<h3 class="mb-3">Our Promise</h3>

							<p>
								Our staff of trained professionals will be held to the
                                highest standards and are required to pay attention to detail in all aspects of their job functions.
                                With our high standards and trained professionals, family members will always be assured their
                                loved ones are in safe hands and receiving the best care and treatment possible during
                                transport.
							</p>
					</div>
					<!-- end col-4 -->
				</div>
				<!-- end row -->
			</div>
			<!-- end container -->
		</div>
		<!-- end #about -->

		<!-- begin #milestone -->
		<div id="milestone" class="content bg-black-darker has-bg" data-scrollview="true">
			<!-- begin content-bg -->
			<div class="content-bg" style="background-image: url(/assets/img/bg/bg-milestone.jpg)"
				data-paroller="true"
				data-paroller-factor="0.5"
				data-paroller-factor-md="0.01"
				data-paroller-factor-xs="0.01"></div>
			<!-- end content-bg -->
			<!-- begin container -->
			<div class="container">
				<!-- begin row -->
				<div class="row">
					<!-- begin col-3 -->
					<div class="col-md-3 milestone-col">
						<div class="milestone">
							<div class="number" data-animation="true" data-animation-type="number" data-final-number="150000">150,000</div>
							<div class="title">Non-Emergency Transports</div>
						</div>
					</div>
					<!-- end col-3 -->
					<!-- begin col-3 -->
					<div class="col-md-3 milestone-col">
						<div class="milestone">
							<div class="number" data-animation="true" data-animation-type="number" data-final-number="10000">10,000</div>
							<div class="title">Events Covered</div>
						</div>
					</div>
					<!-- end col-3 -->
					<!-- begin col-3 -->
					<div class="col-md-3 milestone-col">
						<div class="milestone">
							<div class="number" data-animation="true" data-animation-type="number" data-final-number="20">20</div>
							<div class="title">Counties Served</div>
						</div>
					</div>
					<!-- end col-3 -->
					<!-- begin col-3 -->
					<div class="col-md-3 milestone-col">
						<div class="milestone">
							<div class="number" data-animation="true" data-animation-type="number" data-final-number="10">10</div>
							<div class="title">911 Contracts</div>
						</div>
					</div>
					<!-- end col-3 -->
				</div>
				<!-- end row -->
			</div>
			<!-- end container -->
		</div>
		<!-- end #milestone -->

		<!-- begin #team -->
		<div id="team" class="content" data-scrollview="true">
			<!-- begin container -->
			<div class="container">
				<h2 class="content-title">Join Our Team</h2>
				<p class="content-desc">

				</p>
				<!-- begin row -->
				<div class="row">
					<!-- begin col-4 -->
					<div class="col-md-4 col-sm-12">
						<!-- begin team -->
						<div class="team">
							<div class="image" data-animation="true" data-animation-type="flipInX">
								<img src="/assets/img/dispatch.jpg" height= "150px" width="200px" alt="Ryan Teller" />
							</div>
							<div class="info">
								<h3 class="name">Dispatcher</h3>
								<div class="title text-primary">Portsmouth Communications</div>
								<p>Our dispatchers are the first point of contact for our clients and emergency calls. They recieve a variety of reports, ranging from car accidents to cardiac arresst. Dispatcher coordinate the logistics of our emergency and non-emergency responders.</p>
								<div class="social">
									<a href="#"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
									<a href="#"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
									<a href="#"><i class="fab fa-google-plus-g fa-lg fa-fw"></i></a>
								</div>
							</div>
						</div>
						<!-- end team -->
					</div>
					<!-- end col-4 -->
					<!-- begin col-4 -->
					<div class="col-md-4 col-sm-12">
						<!-- begin team -->
						<div class="team">
							<div class="image" data-animation="true" data-animation-type="flipInX">
								<img src="/assets/img/scheduling.jpg" height= "150px" width="200px" alt="Jonny Cash" />
							</div>
							<div class="info">
								<h3 class="name">Scheduling</h3>
								<div class="title text-primary">Transportation Billing Network</div>
								<p>Become part of our logistics team, where you will play a large role in the planning of our non-emergency operations.</p>
								<div class="social">
									<a href="#"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
									<a href="#"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
									<a href="#"><i class="fab fa-google-plus-g fa-lg fa-fw"></i></a>
								</div>
							</div>
						</div>
						<!-- end team -->
					</div>
					<!-- end col-4 -->
					<!-- begin col-4 -->
					<div class="col-md-4 col-sm-12">
						<!-- begin team -->
						<div class="team">
							<div class="image" data-animation="true" data-animation-type="flipInX">
								<img src="/assets/img/billing.jpg" height= "150px" width="200px" alt="Mia Donovan" />
							</div>
							<div class="info">
								<h3 class="name">Billing</h3>
								<div class="title text-primary">Transportation Billing Network</div>
								<p>Our billing team performs data entry and reads ambulance and or medicare reports, assigns ICD-10 codes and other unique billing codes to each report, and enters required data into the computer using billing software.</p>
								<div class="social">
									<a href="#"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
									<a href="#"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
									<a href="#"><i class="fab fa-google-plus-g fa-lg fa-fw"></i></a>
								</div>
							</div>
						</div>
						<!-- end team -->
					</div>
					<!-- end col-4 -->
				</div>
				<!-- end row -->
				<!-- begin row -->
				<div class="row">
					<!-- begin col-4 -->
					<div class="col-md-4 col-sm-12">
						<!-- begin team -->
						<div class="team">
							<div class="image" data-animation="true" data-animation-type="flipInX">
								<img src="/assets/img/ambulance.jpg" height= "150px" width="200px" alt="Ryan Teller" />
							</div>
							<div class="info">
								<h3 class="name">EMT</h3>
								<div class="title text-primary">PEASI</div>
								<p>Emergency medical technicians respond to nom-emergency and medical emergencies to deliver patient care, support, and evaluation in a pre-hospital setting, like on scene and during transport ot the hospital. This generally includes assessing the patient, determining the proper care, and administering treatment.</p>
								<div class="social">
									<a href="#"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
									<a href="#"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
									<a href="#"><i class="fab fa-google-plus-g fa-lg fa-fw"></i></a>
								</div>
							</div>
						</div>
						<!-- end team -->
					</div>
					<!-- end col-4 -->
					<!-- begin col-4 -->
					<div class="col-md-4 col-sm-12">
						<!-- begin team -->
						<div class="team">
							<div class="image" data-animation="true" data-animation-type="flipInX">
								<img src="/assets/img/ift.jpg" height= "150px" width="200px" alt="Jonny Cash" />
							</div>
							<div class="info">
								<h3 class="name">AEMT</h3>
								<div class="title text-primary">PEASI</div>
								<p>Advanced Emergency medical technicians respond to nom-emergency and medical emergencies to deliver patient care, support, and evaluation in a pre-hospital setting, like on scene and during transport ot the hospital. This generally includes assessing the patient, determining the proper care, and administering advanced emergency treatment.</p>
								<div class="social">
									<a href="#"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
									<a href="#"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
									<a href="#"><i class="fab fa-google-plus-g fa-lg fa-fw"></i></a>
								</div>
							</div>
						</div>
						<!-- end team -->
					</div>
					<!-- end col-4 -->
					<!-- begin col-4 -->
					<div class="col-md-4 col-sm-12">
						<!-- begin team -->
						<div class="team">
							<div class="image" data-animation="true" data-animation-type="flipInX">
								<img src="/assets/img/ems.jpg" height= "150px" width="200px" alt="Mia Donovan" />
							</div>
							<div class="info">
								<h3 class="name">PARAMEDIC</h3>
								<div class="title text-primary">PEASI</div>
								<p>Highly trained and skilled medical professionals who are and extension of the emergency department physician during and emergnecy or non-emergency transport.  </p>
								<div class="social">
									<a href="#"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
									<a href="#"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
									<a href="#"><i class="fab fa-google-plus-g fa-lg fa-fw"></i></a>
								</div>
							</div>
						</div>
						<!-- end team -->
					</div>
					<!-- end col-4 -->
				</div>
				<!-- end row -->
			</div>
			<!-- end container -->
		</div>
		<!-- end #team -->

		<!-- begin #quote -->
		<div id="quote" class="content bg-black-darker has-bg" data-scrollview="true">
			<!-- begin content-bg -->
			<div class="content-bg" style="background-image: url(..//assets/img/bg/bg-quote.jpg)"
				data-paroller-factor="0.5"
				data-paroller-factor-md="0.01"
				data-paroller-factor-xs="0.01">
			</div>
			<!-- end content-bg -->
			<!-- begin container -->
			<div class="container" data-animation="true" data-animation-type="fadeInLeft">
				<!-- begin row -->
				<div class="row">
					<!-- begin col-12 -->
					<div class="col-md-12 quote">
						<i class="fa fa-quote-left"></i> There is no higher honor than to be given the responsibility <br />
						to care for another <span class="text-danger">human being</span>!
						<i class="fa fa-quote-right"></i>
						<small>Richard K. Schachern</small>
					</div>
					<!-- end col-12 -->
				</div>
				<!-- end row -->
			</div>
			<!-- end container -->
		</div>
		<!-- end #quote -->

		<!-- beign #service -->
		<div id="service" class="content" data-scrollview="true">
			<!-- begin container -->
			<div class="container">
				<h2 class="content-title">Our Services</h2>
				<p class="content-desc">

				</p>
				<!-- begin row -->
				<div class="row">
					<!-- begin col-4 -->
					<div class="col-md-4 col-sm-12">
						<div class="service">
							<div class="icon" data-animation="true" data-animation-type="bounceIn"><i class="far fa-hospital"></i></div>
							<div class="info">
								<h4 class="title">911 Emergency Services</h4>
								<p class="desc">Our team of companies offer quick, efficient response with highley trained and skilled advanced life support teams, throughout the Ohio and Kentucky areas.</p>
							</div>
						</div>
					</div>
					<!-- end col-4 -->
					<!-- begin col-4 -->
					<div class="col-md-4 col-sm-12">
						<div class="service">
							<div class="icon" data-animation="true" data-animation-type="bounceIn"><i class="fas fa-first-aid"></i></div>
							<div class="info">
								<h4 class="title">Interfacility Transportation</h4>
								<p class="desc">When your loved one is in need of transport from one facility to another. Count on our family of skilled emergency medical providers to provide a safe and comforatble transport for them.</p>
							</div>
						</div>
					</div>
					<!-- end col-4 -->
					<!-- begin col-4 -->
					<div class="col-md-4 col-sm-12">
						<div class="service">
							<div class="icon" data-animation="true" data-animation-type="bounceIn"><i class="fas fa-ambulance"></i></div>
							<div class="info">
								<h4 class="title">Basic Life Support Service</h4>
								<p class="desc">Our team of companies offer BLS ambulances for a variety of different scenarios such as non-emergency transportation and public events.</p>
							</div>
						</div>
					</div>
					<!-- end col-4 -->
				</div>
				<!-- end row -->
				<!-- begin row -->
				<div class="row">
					<!-- begin col-4 -->
					<div class="col-md-4 col-sm-12">
						<div class="service">
							<div class="icon" data-animation="true" data-animation-type="bounceIn"><i class="fad fa-monitor-heart-rate"></i></div>
							<div class="info">
								<h4 class="title">Advanced Life Support Service</h4>
								<p class="desc">Our team of companies offer ALS ambulances for a variety of different scenarios such as non-emergency transportation and public events.</p>
							</div>
						</div>
					</div>
					<!-- end col-4 -->
					<!-- begin col-4 -->
					<div class="col-md-4 col-sm-12">
						<div class="service">
							<div class="icon" data-animation="true" data-animation-type="bounceIn"><i class="fas fa-heartbeat"></i></div>
							<div class="info">
								<h4 class="title">Mobile Intensive Care</h4>
								<p class="desc">Our team of companies offer ACLS ambulances for a variety of different scenarios such as non-emergency transportation and public events.</p>
							</div>
						</div>
					</div>
					<!-- end col-4 -->
					<!-- begin col-4 -->
					<div class="col-md-4 col-sm-12">
						<div class="service">
							<div class="icon" data-animation="true" data-animation-type="bounceIn"><i class="fas fa-wheelchair"></i></div>
							<div class="info">
								<h4 class="title">Managed Transportation</h4>
								<p class="desc"></p>
							</div>
						</div>
					</div>
					<!-- end col-4 -->
				</div>
				<!-- end row -->

			</div>
			<!-- end container -->
		</div>
		<!-- end #about -->

		<!-- beign #action-box -->
		<div id="action-box" class="content has-bg" data-scrollview="true">
			<!-- begin content-bg -->
			<div class="content-bg" style="background-image: url(..//assets/img/bg/bg-action.jpg)"
				data-paroller-factor="0.5"
				data-paroller-factor-md="0.01"
				data-paroller-factor-xs="0.01">
			</div>
			<!-- end content-bg -->
			<!-- begin container -->
			<div class="container" data-animation="true" data-animation-type="fadeInRight">
				<!-- begin row -->
				<div class="row action-box">
					<!-- begin col-9 -->
					<div class="col-md-9 col-sm-9">
						<div class="icon-large text-primary">
							<i class="fa fa-binoculars"></i>
						</div>
						<h3>SCHEDULE A TRANSPORT NOW! Call 740-354-3200</h3>
						<p>
							Non-Emergency transport scheduling at your fingertips.
						</p>
					</div>
					<!-- end col-9 -->
					<!-- begin col-3 -->
					<div class="col-md-3 col-sm-3">
						<a href="#" class="btn btn-outline-white btn-theme btn-block">Coming Soon</a>
					</div>
					<!-- end col-3 -->
				</div>
				<!-- end row -->
			</div>
			<!-- end container -->
		</div>
		<!-- end #action-box -->



		<!-- begin #client -->
		<div id="client" class="content has-bg bg-green" data-scrollview="true">
			<!-- begin content-bg -->
			<div class="content-bg" style="background-image: url(/assets/img/bg/bg-client.jpg)"
				data-paroller-factor="0.5"
				data-paroller-factor-md="0.01"
				data-paroller-factor-xs="0.01">
			</div>
			<!-- end content-bg -->
			<!-- begin container -->
			<div class="container" data-animation="true" data-animation-type="fadeInUp">
				<h2 class="content-title">Our Client Testimonials</h2>
				<!-- begin carousel -->
				<div class="carousel testimonials slide" data-ride="carousel" id="testimonials">
					<!-- begin carousel-inner -->
					<div class="carousel-inner text-center">
						<!-- begin item -->
						<div class="carousel-item active">
							<blockquote>
								<i class="fa fa-quote-left"></i>
								Portsmouth Ambulance was their when my family was in need!!! Their crew treated us just like family.
								<i class="fa fa-quote-right"></i>
							</blockquote>
							<div class="name"> — <span class="text-primary"></span>, Patient</div>
						</div>
						<!-- end item -->
						<!-- begin item -->
						<div class="carousel-item">
							<blockquote>
								<i class="fa fa-quote-left"></i>
								Crews are professional and caring.
								<i class="fa fa-quote-right"></i>
							</blockquote>
							<div class="name"> — <span class="text-primary"></span> </div>
						</div>
						<!-- end item -->
						<!-- begin item -->
						<div class="carousel-item">
							<blockquote>
								<i class="fa fa-quote-left"></i>
								When minutes counted, they were made it to my home quick.
								<i class="fa fa-quote-right"></i>
							</blockquote>
							<div class="name"> — <span class="text-primary"></span></div>
						</div>
						<!-- end item -->
					</div>
					<!-- end carousel-inner -->
					<!-- begin carousel-indicators -->
					<ol class="carousel-indicators m-b-0">
						<li data-target="#testimonials" data-slide-to="0" class="active"></li>
						<li data-target="#testimonials" data-slide-to="1" class=""></li>
						<li data-target="#testimonials" data-slide-to="2" class=""></li>
					</ol>
					<!-- end carousel-indicators -->
				</div>
				<!-- end carousel -->
			</div>
			<!-- end containter -->
		</div>
		<!-- end #client -->


		<!-- begin #contact -->
		<div id="contact" class="content bg-silver-lighter" data-scrollview="true">
			<!-- begin container -->
			<div class="container">
				<h2 class="content-title">Contact Us</h2>
				<p class="content-desc">

				</p>
				<!-- begin row -->
				<div class="row">
					<!-- begin col-6 -->
					<div class="col-lg-6" data-animation="true" data-animation-type="fadeInLeft">
						<h3>If you have a transportation need contact us today .</h3>

						<p>
							<strong>Portsmouth Emergency Ambulance Service Inc</strong><br />
							2796 Gallia Street<br />
							Portsmouth, Ohio 45662<br />
							P: (740) 354-3122<br />
						</p>
						<p>
							<span class="phone"> (740) 351-2617</span><br />
							<a href="mailto:hr@peasi.com" class="text-primary">Human Resources</a>
						</p>
					</div>
					<!-- end col-6 -->
					<!-- begin col-6 -->
					<div class="col-lg-6 form-col" data-animation="true" data-animation-type="fadeInRight">
						<form class="form-horizontal">
							<div class="form-group row m-b-15">
								<label class="col-form-label col-md-3 text-md-right">Name <span class="text-primary">*</span></label>
								<div class="col-md-9">
									<input type="text" class="form-control" />
								</div>
							</div>
							<div class="form-group row m-b-15">
								<label class="col-form-label col-md-3 text-md-right">Email <span class="text-primary">*</span></label>
								<div class="col-md-9">
									<input type="text" class="form-control" />
								</div>
							</div>
							<div class="form-group row m-b-15">
								<label class="col-form-label col-md-3 text-md-right">Message <span class="text-primary">*</span></label>
								<div class="col-md-9">
									<textarea class="form-control" rows="10"></textarea>
								</div>
							</div>
							<div class="form-group row m-b-15">
								<label class="col-form-label col-md-3 text-md-right"></label>
								<div class="col-md-9 text-left">
									<button type="submit" class="btn btn-theme btn-primary btn-block" disabled>Send Message (Currently Offiline Sorry.)</button>
								</div>
							</div>
						</form>
					</div>
					<!-- end col-6 -->
				</div>
				<!-- end row -->
			</div>
			<!-- end container -->
		</div>
		<!-- end #contact -->

		<!-- begin #footer -->
		<div id="footer" class="footer">
			<div class="container">
				<div class="footer-brand">
					<div class="footer-brand-logo"></div>
					<span class="text-blue">EMS</span><span class="text-yellow">Complete</span>
				</div>
				<p>
					&copy; Copyright Medidex Solutions 2019 <br />
					Building Electronic Solutions for EMS everyday <a href="#"></a>
				</p>
				<p class="social-list">
					<a href="#"><i class="fab fa-facebook-f fa-fw"></i></a>
					<a href="#"><i class="fab fa-instagram fa-fw"></i></a>
					<a href="#"><i class="fab fa-twitter fa-fw"></i></a>
					<a href="#"><i class="fab fa-google-plus-g fa-fw"></i></a>
					<a href="#"><i class="fab fa-dribbble fa-fw"></i></a>
				</p>
			</div>
		</div>
		<!-- end #footer -->

		<!-- begin theme-panel -->
		<div class="theme-panel">
			<a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
			<div class="theme-panel-content">
				<ul class="theme-list clearfix">
					<li><a href="javascript:;" class="bg-red" data-theme="red" data-theme-file="/assets/css/one-page-parallax/theme/red.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red" data-original-title="" title="">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-pink" data-theme="pink" data-theme-file="/assets/css/one-page-parallax/theme/pink.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Pink" data-original-title="" title="">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-orange" data-theme="orange" data-theme-file="/assets/css/one-page-parallax/theme/orange.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange" data-original-title="" title="">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-yellow" data-theme="yellow" data-theme-file="/assets/css/one-page-parallax/theme/yellow.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Yellow" data-original-title="" title="">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-lime" data-theme="lime" data-theme-file="/assets/css/one-page-parallax/theme/lime.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Lime" data-original-title="" title="">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-green" data-theme="green" data-theme-file="/assets/css/one-page-parallax/theme/green.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Green" data-original-title="" title="">&nbsp;</a></li>
					<li class="active"><a href="javascript:;" class="bg-teal" data-theme-file="/assets/css/one-page-parallax/theme/teal.min.css" data-theme="default" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default" data-original-title="" title="">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-aqua" data-theme="aqua" data-theme-file="/assets/css/one-page-parallax/theme/aqua.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Aqua" data-original-title="" title="">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-blue" data-theme="blue" data-theme-file="/assets/css/one-page-parallax/theme/blue.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Blue" data-original-title="" title="">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-purple" data-theme="purple" data-theme-file="/assets/css/one-page-parallax/theme/purple.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple" data-original-title="" title="">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-indigo" data-theme="indigo" data-theme-file="/assets/css/one-page-parallax/theme/indigo.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Indigo" data-original-title="" title="">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-black" data-theme="black" data-theme-file="/assets/css/one-page-parallax/theme/black.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black" data-original-title="" title="">&nbsp;</a></li>
				</ul>
			</div>
		</div>
		<!-- end theme-panel -->
	</div>
	<!-- end #page-container -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/assets/js/one-page-parallax/app.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</body>
</html>
