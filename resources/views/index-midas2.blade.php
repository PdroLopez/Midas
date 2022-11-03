<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>Midas Chile</title>	

		<meta name="keywords" content="HTML5 Template" />
		<meta name="description" content="Porto - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Favicon -->
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="img/apple-touch-icon.png">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light%7CPlayfair+Display:400" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('HTML/vendor/bootstrap/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('HTML/vendor/fontawesome-free/css/all.min.css') }}">
		<link rel="stylesheet" href="{{ asset('HTML/vendor/animate/animate.min.css') }}">
		<link rel="stylesheet" href="{{ asset('HTML/vendor/simple-line-icons/css/simple-line-icons.min.css') }}">
		<link rel="stylesheet" href="{{ asset('HTML/vendor/owl.carousel/assets/owl.carousel.min.css') }}">
		<link rel="stylesheet" href="{{ asset('HTML/vendor/owl.carousel/assets/owl.theme.default.min.css') }}">
		<link rel="stylesheet" href="{{ asset('HTML/vendor/magnific-popup/magnific-popup.min.css') }}">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('HTML/css/theme.css') }}">
		<link rel="stylesheet" href="{{ asset('HTML/css/theme-elements.css') }}">
		<link rel="stylesheet" href="{{ asset('HTML/css/theme-blog.css') }}">
		<link rel="stylesheet" href="{{ asset('HTML/css/theme-shop.css') }}">

		<!-- Current Page CSS -->
		<link rel="stylesheet" href="{{ asset('HTML/vendor/rs-plugin/css/settings.css') }}">
		<link rel="stylesheet" href="{{ asset('HTML/vendor/rs-plugin/css/layers.css') }}">
		<link rel="stylesheet" href="{{ asset('HTML/vendor/rs-plugin/css/navigation.css') }}">
		
		<!-- Demo CSS -->


		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ asset('HTML/css/skins/default.css') }}"> 

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ asset('HTML/css/custom.css') }}">

		<!-- Head Libs -->
		<script src="{{ asset('HTML/vendor/modernizr/modernizr.min.js') }}"></script>

	</head>
	<style type="text/css">
		#header .header-nav.header-nav-links nav > ul:not(:hover) > li > a.active {
		    color: #8fca00;
		}
		#header .header-nav.header-nav-links nav > ul li:hover > a {
		    color: #8fca00;
		}
		html .testimonial-quotes-primary blockquote:before, html .testimonial-quotes-primary blockquote:after {
		    color: #8fca00 !important;
		}
		.owl-carousel .owl-dots .owl-dot.active span, .owl-carousel .owl-dots .owl-dot:hover span {
		    background-color: #8fca00;
		}
		html .bg-color-primary, html .bg-primary {
		    background-color: #8fca00 !important;
		}
		.thumb-info .thumb-info-type, .thumb-info .thumb-info-action-icon, .thumb-info-social-icons a, .thumbnail .zoom, .img-thumbnail .zoom, .thumb-info-ribbon {
		    background-color: #8fca00;
		}
		html .btn-primary {
		    background-color: #8fca00;
		    border-color: #8fca00 #8fca00 #8fca00;
		    color: #FFF;
		}
		html .btn-primary:hover, html .btn-primary.hover {
		    background-color: #8fca00;
		    border-color: #8fca00 #8fca00 #8fca00;
		    color: #FFF;
		}
		#header .header-btn-collapse-nav {
		    background: #8fca00;
		}
		#header .header-nav-main.header-nav-main-mobile-dark nav > ul > li > a.active {
		    background: #8fca00;
		}
		.bounce-loader .bounce1, .bounce-loader .bounce2, .bounce-loader .bounce3 {
		    -webkit-animation: 2s ease-in-out 1s normal both infinite bouncedelay;
		    animation: 2s ease-in-out 1s normal both infinite bouncedelay;
		    background-color: white;
		    border-radius: 100%;
		    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0);
		    display: inline-block;
		    height: 18px;
		    width: 18px;
		    min-width: 10px;
		}
	</style>
	<body class="loading-overlay-showing" data-plugin-page-transition data-loading-overlay data-plugin-options="{'hideDelay': 500}">
		<div class="loading-overlay">
			<div class="bounce-loader">
				{{-- <div class="bounce1"></div> --}}
				<div class="bounce2">
					<img src="{{ asset('img/midas1.png') }}" style="margin-top: -30px;margin-left: -30px; width: 100%">
				</div>
				{{-- <div class="bounce3"></div> --}}
			</div>
		</div>
	<body class="one-page" data-target="#header" data-spy="scroll" data-offset="100">

		<div class="body">

			<header id="header" class="header-transparent header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': true, 'stickyStartAt': 30, 'stickyHeaderContainerHeight': 70}">
				<div class="header-body border-top-0 bg-dark box-shadow-none">
					<div class="header-container container">
						<div class="header-row">
							<div class="header-column">
								<div class="header-row">
									<div class="header-logo">
										<a href="index.html">
											<img class="svg" alt="Porto" width="100" src="{{ asset('img/logomidas.svg') }}">
										</a>
									</div>
								</div>
							</div>
							<div class="header-column justify-content-end">
								<div class="header-row">
									<div class="header-nav header-nav-links header-nav-dropdowns-dark header-nav-light-text order-2 order-lg-1">
										<div class="header-nav-main header-nav-main-mobile-dark header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-effect-2 header-nav-main-sub-effect-1">
											<nav class="collapse">
												<ul class="nav nav-pills" id="mainNav">
													<li class="dropdown">
														<a data-hash class="dropdown-item dropdown-toggle active" href="#home">
															Inicio
														</a>
														{{-- 
														<ul class="dropdown-menu">
															<li><a class="dropdown-item" href="index-classic.html">Default Home</a></li>
															<li><a class="dropdown-item" href="index-one-page.html">One Page Website</a></li>
														</ul>
														 --}}
													</li>
													<li>
														<a class="dropdown-item" data-hash data-hash-offset="68" href="#nosotros">Nosotros</a>
													</li>
													<li>
														<a class="dropdown-item" data-hash data-hash-offset="68" href="#servicios">Servicios</a>
													</li>
													<li>
														<a class="dropdown-item" data-hash data-hash-offset="68" href="#noticias">Noticias</a>
													</li>
													<li>
														<a class="dropdown-item" data-hash data-hash-offset="68" href="#contact">Contacto</a>
													</li>
												</ul>
											</nav>
										</div>
										<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
											<i class="fas fa-bars"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>

			<div role="main" class="main" id="home">
				<div class="slider-container rev_slider_wrapper" style="height: 100vh;">
					<div id="revolutionSlider" class="slider rev_slider" data-version="5.4.8" data-plugin-revolution-slider data-plugin-options="{'sliderLayout': 'fullscreen', 'delay': 9000, 'gridwidth': 1140, 'gridheight': 800, 'responsiveLevels': [4096,1200,992,500]}">
						<ul>
							<li class="slide-overlay" data-transition="fade">
								<img src="{{ asset('HTML/img/slides/slide-bg-2.jpg') }}"  
									alt=""
									data-bgposition="center center" 
									data-bgfit="cover" 
									data-bgrepeat="no-repeat" 
									class="rev-slidebg">
				
								<div class="tp-caption font-weight-extra-bold text-color-light negative-ls-1"
									data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:1.5;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
									data-x="center"
									data-y="center"
									data-fontsize="['50','50','50','90']"
									data-lineheight="['55','55','55','95']">Midas Chile</div>
				
								<div class="tp-caption font-weight-light ws-normal text-center"
									data-frames='[{"from":"opacity:0;","speed":300,"to":"o:1;","delay":2000,"split":"chars","splitdelay":0.05,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
									data-x="center"
									data-y="center" data-voffset="['60','60','60','105']"
									data-width="['530','530','530','1100']"
									data-fontsize="['18','18','18','40']"
									data-lineheight="['26','26','26','45']"
									style="color: #b5b5b5;">Reciclamos futuro con energías limpias.</div>
								
							</li>
							<li class="slide-overlay slide-overlay-dark" data-transition="fade">
								<img src="{{ asset('HTML/img/slides/slide-bg-6.jpg') }}"  
									alt=""
									data-bgposition="center center" 
									data-bgfit="cover" 
									data-bgrepeat="no-repeat" 
									class="rev-slidebg">
				
								<div class="tp-caption"
									data-x="center" data-hoffset="['-145','-145','-145','-320']"
									data-y="center" data-voffset="['-80','-80','-80','-130']"
									data-start="1000"
									data-transform_in="x:[-300%];opacity:0;s:500;"
									data-transform_idle="opacity:0.2;s:500;"><img src="{{ asset('HTML/img/slides/slide-title-border.png') }}" alt=""></div>
				
								<div class="tp-caption text-color-light font-weight-normal"
									data-x="center"
									data-y="center" data-voffset="['-80','-80','-80','-130']"
									data-start="700"
									data-fontsize="['16','16','16','40']"
									data-lineheight="['25','25','25','45']"
									data-transform_in="y:[-50%];opacity:0;s:500;">Nuestros Clientes confían en</div>
				
								<div class="tp-caption"
									data-x="center" data-hoffset="['145','145','145','320']"
									data-y="center" data-voffset="['-80','-80','-80','-130']"
									data-start="1000"
									data-transform_in="x:[300%];opacity:0;s:500;"
									data-transform_idle="opacity:0.2;s:500;"><img src="{{ asset('HTML/img/slides/slide-title-border.png') }}" alt=""></div>
				
								<div class="tp-caption font-weight-extra-bold text-color-light"
									data-frames='[{"delay":1300,"speed":1000,"frame":"0","from":"opacity:0;x:-50%;","to":"opacity:0.7;x:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
									data-x="center" data-hoffset="['-155','-155','-155','-255']"
									data-y="center"
									data-fontsize="['145','145','145','250']"
									data-lineheight="['150','150','150','260']">M</div>
				
								<div class="tp-caption font-weight-extra-bold text-color-light"
									data-frames='[{"delay":1500,"speed":1000,"frame":"0","from":"opacity:0;x:-50%;","to":"opacity:0.7;x:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
									data-x="center" data-hoffset="['-80','-80','-80','-130']"
									data-y="center"
									data-fontsize="['145','145','145','250']"
									data-lineheight="['150','150','150','260']">I</div>
				
								<div class="tp-caption font-weight-extra-bold text-color-light"
									data-frames='[{"delay":1700,"speed":1000,"frame":"0","from":"opacity:0;x:-50%;","to":"opacity:0.7;x:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
									data-x="center"
									data-y="center"
									data-fontsize="['145','145','145','250']"
									data-lineheight="['150','150','150','260']">D</div>
				
								<div class="tp-caption font-weight-extra-bold text-color-light"
									data-frames='[{"delay":1900,"speed":1000,"frame":"0","from":"opacity:0;x:-50%;","to":"opacity:0.7;x:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
									data-x="center" data-hoffset="['65','65','65','115']"
									data-y="center"
									data-fontsize="['145','145','145','250']"
									data-lineheight="['150','150','150','260']">A</div>
				
								<div class="tp-caption font-weight-extra-bold text-color-light"
									data-frames='[{"delay":2100,"speed":1000,"frame":"0","from":"opacity:0;x:-50%;","to":"opacity:0.7;x:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
									data-x="center" data-hoffset="['139','139','139','240']"
									data-y="center"
									data-fontsize="['145','145','145','250']"
									data-lineheight="['150','150','150','260']">S</div>
				
								<div class="tp-caption font-weight-light text-color-light"
									data-frames='[{"from":"opacity:0;","speed":300,"to":"o:1;","delay":2300,"split":"chars","splitdelay":0.05,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
									data-x="center"
									data-y="center" data-voffset="['85','85','85','140']"
									data-fontsize="['18','18','18','40']"
									data-lineheight="['26','26','26','45']">Hoy la historia la escribimos nosotros.</div>
								
							</li>
							<li class="slide-overlay" data-transition="fade">
								<img src="{{ asset('HTML/img/blank.gif') }}"  
									alt=""
									data-bgposition="center center" 
									data-bgfit="cover" 
									data-bgrepeat="no-repeat" 
									class="rev-slidebg">
				
								<div class="rs-background-video-layer" 
									data-forcerewind="on" 
									data-volume="mute" 
									data-videowidth="100%" 
									data-videoheight="100%" 
									data-videomp4="video/memory-of-a-woman.mp4" 
									data-videopreload="preload" 
									data-videoloop="loop" 
									data-forceCover="1" 
									data-aspectratio="16:9" 
									data-autoplay="true" 
									data-autoplayonlyfirsttime="false" 
									data-nextslideatend="false">
								</div>
				
								<div class="tp-caption font-weight-extra-bold text-color-light negative-ls-1"
									data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:1.5;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
									data-x="center"
									data-y="center"
									data-fontsize="['50','50','50','90']"
									data-lineheight="['55','55','55','95']" style="z-index: 5;">Video Corporativo</div>
				
								<div class="tp-caption font-weight-light ws-normal text-center"
									data-frames='[{"from":"opacity:0;","speed":300,"to":"o:1;","delay":2000,"split":"chars","splitdelay":0.05,"ease":"Power2.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
									data-x="center"
									data-y="center" data-voffset="['60','60','60','105']"
									data-width="['530','530','530','1100']"
									data-fontsize="['18','18','18','40']"
									data-lineheight="['26','26','26','45']"
									style="color: #b5b5b5; z-index: 5;">Más de <strong class="text-color-light">2,000</strong> clientes confían en nosotros.</div>
				
								<div class="tp-dottedoverlay tp-opacity-overlay"></div>
							</li>
						</ul>
					</div>
				</div>
				<section id="nosotros" class="section section-background section-height-4 overlay overlay-show overlay-op-9 border-0 m-0" style="background-image: url('{{ asset('HTML/img/bg-one-page-1-1.jpg') }}'); background-size: cover; background-position: center;">
					<div class="container">
						<div class="row">
							<div class="col text-center">
								<h2 class="font-weight-bold text-color-light mb-2">Hoy la historia la escribimos nosotros</h2>
								<p class="text-color-light opacity-7">Primera empresa de reciclaje de residuos en el mundo, que realiza su operación con energía renovable 100% compensada con paneles solares.</p>
								<p>Porque nos ocupamos de nuestro futuro y el de tus hijos, Midas lanza campaña de entrega de Puntos de reciclaje en colegios.</p>
								<p>La iniciativa, auto financiada por Midas Chile, busca fomentar el hábito de reciclar en los establecimientos educacionales como forma de llegar cada vez a más familias que se comprometan con el cuidado del medio ambiente y así acortar la brecha ambiental que existe actualmente en nuestro país. Mediante un concurso de Instagram Midas  esta entregando 10 puntos de reciclaje a los colegios que cumplan los requisitos básicos del concurso, servicio que incluye la logística de retiro y tratamiento de residuos. En estos puntos los alumnos de colegios públicos o privados ganadores, podrán reciclar envases, embalajes y residuos electrónicos. En Agosto ya se asignaron 10 puntos y para septiembre se están sorteando 10 adicionales, esperamos pronto extender esta iniciativa desde la Región Metropolitana a todo el país.</p>
							</div>
						</div>
						<div class="row text-center py-3 my-4">
							<div class="owl-carousel owl-theme carousel-center-active-item carousel-center-active-item-style-2 mb-0" data-plugin-options="{'responsive': {'0': {'items': 2}, '476': {'items': 3}, '768': {'items': 3}, '992': {'items': 4}, '1200': {'items': 4}}, 'autoplay': true, 'autoplayTimeout': 3000, 'dots': false}">
								<div>
									<img class="img-fluid" style="width: 100px;height: 100px;" src="{{ asset('img/Icono-1.png') }}" alt="">
								</div>
								<div>
									<img class="img-fluid" style="width: 100px;height: 100px;" src="{{ asset('img/Icono-2.png') }}" alt="">
								</div>
								<div>
									<img class="img-fluid" style="width: 200px;height: 100px;" src="{{ asset('img/Icono-3.png') }}" alt="">
								</div>
								<div>
									<img class="img-fluid" style="width: 100px;height: 100px;" src="{{ asset('img/Icono-4.png') }}" alt="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								
								<div class="owl-carousel owl-theme nav-bottom rounded-nav mb-0" data-plugin-options="{'items': 1, 'loop': true, 'autoHeight': true}">
									<div>
										<div class="testimonial testimonial-style-2 testimonial-light testimonial-with-quotes testimonial-quotes-primary mb-0">
											<blockquote>
												<p class="text-5 line-height-5 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget risus porta, tincidunt turpis at, interdum tortor. Suspendisse potenti.</p>
											</blockquote>
											<div class="testimonial-author">
												<p><strong class="font-weight-extra-bold text-2">Cliente</strong></p>
											</div>
										</div>
									</div>
									<div>
										<div class="testimonial testimonial-style-2 testimonial-light testimonial-with-quotes testimonial-quotes-primary mb-0">
											<blockquote>
												<p class="text-5 line-height-5 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget risus porta, tincidunt turpis at, interdum tortor. Suspendisse potenti.</p>
											</blockquote>
											<div class="testimonial-author">
												<p><strong class="font-weight-extra-bold text-2">Cliente</strong></p>
											</div>
										</div>
									</div>
								</div>
				
							</div>
						</div>
					</div>
				</section>
				<section id="servicios" class="section section-height-3 bg-primary border-0 m-0 appear-animation" data-appear-animation="fadeIn">
					<div class="container my-3">
						<div class="row mb-5">
							<div class="col text-center appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
								<h2 class="font-weight-bold text-color-light mb-2">Servicios</h2>
							</div>
						</div>
						<div class="row mb-lg-4">
							<div class="col-lg-4 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="300">
								<div class="feature-box feature-box-style-2">
									<div class="feature-box-icon">
										<i class="icons icon-layers text-color-light"></i>
									</div>
									<div class="feature-box-info">
										<h4 class="font-weight-bold text-color-light text-4 mb-2">Destrucción Certificada de Productos</h4>
										<p class="text-color-light opacity-7">Lorem ipsum dolor sit amet, consectetur adipiscing <span class="alternative-font text-color-light">metus.</span> elit. Quisque rutrum pellentesque imperdiet.</p>
									</div>
								</div>
							</div>
							<div class="col-lg-4 appear-animation" data-appear-animation="fadeInUpShorter">
								<div class="feature-box feature-box-style-2">
									<div class="feature-box-icon">
										<i class="icons icon-layers text-color-light"></i>
									</div>
									<div class="feature-box-info">
										<h4 class="font-weight-bold text-color-light text-4 mb-2">Reciclaje de Residuos</h4>
										<p class="text-color-light opacity-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.</p>
									</div>
								</div>
							</div>
							<div class="col-lg-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="300">
								<div class="feature-box feature-box-style-2">
									<div class="feature-box-icon">
										<i class="icons icon-layers text-color-light"></i>
									</div>
									<div class="feature-box-info">
										<h4 class="font-weight-bold text-color-light text-4 mb-2">Almacenamiento y transporte de residuos</h4>
										<p class="text-color-light opacity-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.</p>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="300">
								<div class="feature-box feature-box-style-2">
									<div class="feature-box-icon">
										<i class="icons icon-layers text-color-light"></i>
									</div>
									<div class="feature-box-info">
										<h4 class="font-weight-bold text-color-light text-4 mb-2">Asesoría en sustentabilidad</h4>
										<p class="text-color-light opacity-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.</p>
									</div>
								</div>
							</div>
							<div class="col-lg-4 appear-animation" data-appear-animation="fadeInUpShorter">
								<div class="feature-box feature-box-style-2">
									<div class="feature-box-icon">
										<i class="icons icon-layers text-color-light"></i>
									</div>
									<div class="feature-box-info">
										<h4 class="font-weight-bold text-color-light text-4 mb-2">Disposición Puntos de Reciclaje en colegios y empresas</h4>
										<p class="text-color-light opacity-7">Lorem ipsum dolor sit amet, consectetur adipiscing <span class="alternative-font text-color-light">metus.</span> elit. Quisque rutrum pellentesque imperdiet.</p>
									</div>
								</div>
							</div>
							<div class="col-lg-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="300">
								<div class="feature-box feature-box-style-2">
									<div class="feature-box-icon">
										<i class="icons icon-layers text-color-light"></i>
									</div>
									<div class="feature-box-info">
										<h4 class="font-weight-bold text-color-light text-4 mb-2">Operación sustentable</h4>
										<p class="text-color-light opacity-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				
				<div id="noticias" class="container">
					<div class="row justify-content-center pt-5 mt-5">
						<div class="col-lg-9 text-center">
							<div class="appear-animation" data-appear-animation="fadeInUpShorter">
								<h2 class="font-weight-bold mb-5">Noticias</h2>
							</div>
						</div>
					</div>
					<div class="row pb-5 mb-5">
						<div class="col">
							
							<div class="appear-animation popup-gallery-ajax" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
								<div class="owl-carousel owl-theme mb-0" data-plugin-options="{'items': 4, 'margin': 35, 'loop': false}">
									<div class="portfolio-item">
										<a href="#" data-ajax-on-modal>
											<span class="thumb-info thumb-info-lighten">
												<span class="thumb-info-wrapper">
													<img src="{{ asset('HTML/img/projects/project.jpg') }}" class="img-fluid border-radius-0" alt="">
													<span class="thumb-info-title">
														<span class="thumb-info-inner">Colegios Ganadores de Puntos de reciclaje</span>
														<span class="thumb-info-type">Noticia</span>
													</span>
													<span class="thumb-info-action">
														<span class="thumb-info-action-icon bg-dark opacity-8"><i class="fas fa-plus"></i></span>
													</span>
												</span>
											</span>
										</a>
									</div>

									<div class="portfolio-item">
										<a href="#" data-ajax-on-modal>
											<span class="thumb-info thumb-info-lighten">
												<span class="thumb-info-wrapper">
													<img src="{{ asset('HTML/img/projects/project-2.jpg') }}" class="img-fluid border-radius-0" alt="">
													<span class="thumb-info-title">
														<span class="thumb-info-inner">Colegios Ganadores de Puntos de reciclaje</span>
														<span class="thumb-info-type">Noticia</span>
													</span>
													<span class="thumb-info-action">
														<span class="thumb-info-action-icon bg-dark opacity-8"><i class="fas fa-plus"></i></span>
													</span>
												</span>
											</span>
										</a>
									</div>

									<div class="portfolio-item">
										<a href="#" data-ajax-on-modal>
											<span class="thumb-info thumb-info-lighten">
												<span class="thumb-info-wrapper">
													<img src="{{ asset('HTML/img/projects/project-2.jpg') }}" class="img-fluid border-radius-0" alt="">
													<span class="thumb-info-title">
														<span class="thumb-info-inner">Colegios Ganadores de Puntos de reciclaje</span>
														<span class="thumb-info-type">Noticia</span>
													</span>
													<span class="thumb-info-action">
														<span class="thumb-info-action-icon bg-dark opacity-8"><i class="fas fa-plus"></i></span>
													</span>
												</span>
											</span>
										</a>
									</div>

									<div class="portfolio-item">
										<a href="#" data-ajax-on-modal>
											<span class="thumb-info thumb-info-lighten">
												<span class="thumb-info-wrapper">
													<img src="{{ asset('HTML/img/projects/project-27.jpg') }}" class="img-fluid border-radius-0" alt="">
													<span class="thumb-info-title">
														<span class="thumb-info-inner">Colegios Ganadores de Puntos de reciclaje</span>
														<span class="thumb-info-type">Noticia</span>
													</span>
													<span class="thumb-info-action">
														<span class="thumb-info-action-icon bg-dark opacity-8"><i class="fas fa-plus"></i></span>
													</span>
												</span>
											</span>
										</a>
									</div>

									<div class="portfolio-item">
										<a href="ajax/portfolio-ajax-project-4.html" data-ajax-on-modal>
											<span class="thumb-info thumb-info-lighten">
												<span class="thumb-info-wrapper">
													<img src="{{ asset('HTML/img/projects/project-4.jpg') }}" class="img-fluid border-radius-0" alt="">
													<span class="thumb-info-title">
														<span class="thumb-info-inner">Colegios Ganadores de Puntos de reciclaje</span>
														<span class="thumb-info-type">Noticia</span>
													</span>
													<span class="thumb-info-action">
														<span class="thumb-info-action-icon bg-dark opacity-8"><i class="fas fa-plus"></i></span>
													</span>
												</span>
											</span>
										</a>
									</div>
								</div>
							</div>
				
						</div>
					</div>
				</div>
				
				{{-- 
				<div id="team" class="container pb-4">
					<div class="row pt-5 mt-5 mb-4">
						<div class="col text-center appear-animation" data-appear-animation="fadeInUpShorter">
							<h2 class="font-weight-bold mb-1">Team</h2>
							<p>LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT</p>
						</div>
					</div>
					<div class="row pb-5 mb-5 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
						<div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
							<span class="thumb-info thumb-info-hide-wrapper-bg thumb-info-no-zoom">
								<span class="thumb-info-wrapper">
									<a href="about-me.html">
										<img src="img/team/team-1.jpg" class="img-fluid" alt="">
									</a>
								</span>
								<span class="thumb-info-caption">
									<h3 class="font-weight-extra-bold text-color-dark text-4 line-height-1 mt-3 mb-0">John Doe</h3>
									<span class="text-2 mb-0">CEO</span>
									<span class="thumb-info-caption-text pt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ac ligula mi, non suscipitaccumsan</span>
									<span class="thumb-info-social-icons">
										<a target="_blank" href="http://www.facebook.com"><i class="fab fa-facebook-f"></i><span>Facebook</span></a>
										<a href="http://www.twitter.com"><i class="fab fa-twitter"></i><span>Twitter</span></a>
										<a href="http://www.linkedin.com"><i class="fab fa-linkedin-in"></i><span>Linkedin</span></a>
									</span>
								</span>
							</span>
						</div>
						<div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
							<span class="thumb-info thumb-info-hide-wrapper-bg thumb-info-no-zoom">
								<span class="thumb-info-wrapper">
									<a href="about-me.html">
										<img src="img/team/team-2.jpg" class="img-fluid" alt="">
									</a>
								</span>
								<span class="thumb-info-caption">
									<h3 class="font-weight-extra-bold text-color-dark text-4 line-height-1 mt-3 mb-0">Jessica Doe</h3>
									<span class="text-2 mb-0">DESIGNER</span>
									<span class="thumb-info-caption-text pt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ac ligula mi, non suscipitaccumsan</span>
									<span class="thumb-info-social-icons">
										<a target="_blank" href="http://www.facebook.com"><i class="fab fa-facebook-f"></i><span>Facebook</span></a>
										<a href="http://www.twitter.com"><i class="fab fa-twitter"></i><span>Twitter</span></a>
										<a href="http://www.linkedin.com"><i class="fab fa-linkedin-in"></i><span>Linkedin</span></a>
									</span>
								</span>
							</span>
						</div>
						<div class="col-sm-6 col-lg-3 mb-4 mb-sm-0">
							<span class="thumb-info thumb-info-hide-wrapper-bg thumb-info-no-zoom">
								<span class="thumb-info-wrapper">
									<a href="about-me.html">
										<img src="img/team/team-3.jpg" class="img-fluid" alt="">
									</a>
								</span>
								<span class="thumb-info-caption">
									<h3 class="font-weight-extra-bold text-color-dark text-4 line-height-1 mt-3 mb-0">Ricki Doe</h3>
									<span class="text-2 mb-0">DEVELOPER</span>
									<span class="thumb-info-caption-text pt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ac ligula mi, non suscipitaccumsan</span>
									<span class="thumb-info-social-icons">
										<a target="_blank" href="http://www.facebook.com"><i class="fab fa-facebook-f"></i><span>Facebook</span></a>
										<a href="http://www.twitter.com"><i class="fab fa-twitter"></i><span>Twitter</span></a>
										<a href="http://www.linkedin.com"><i class="fab fa-linkedin-in"></i><span>Linkedin</span></a>
									</span>
								</span>
							</span>
						</div>
						<div class="col-sm-6 col-lg-3">
							<span class="thumb-info thumb-info-hide-wrapper-bg thumb-info-no-zoom">
								<span class="thumb-info-wrapper">
									<a href="about-me.html">
										<img src="img/team/team-4.jpg" class="img-fluid" alt="">
									</a>
								</span>
								<span class="thumb-info-caption">
									<h3 class="font-weight-extra-bold text-color-dark text-4 line-height-1 mt-3 mb-0">Melinda Doe</h3>
									<span class="text-2 mb-0">SEO ANALYST</span>
									<span class="thumb-info-caption-text pt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ac ligula mi, non suscipitaccumsan</span>
									<span class="thumb-info-social-icons">
										<a target="_blank" href="http://www.facebook.com"><i class="fab fa-facebook-f"></i><span>Facebook</span></a>
										<a href="http://www.twitter.com"><i class="fab fa-twitter"></i><span>Twitter</span></a>
										<a href="http://www.linkedin.com"><i class="fab fa-linkedin-in"></i><span>Linkedin</span></a>
									</span>
								</span>
							</span>
						</div>
					</div>
				</div>
				 --}}
				<section id="contact" class="section bg-color-grey-scale-1 border-0 py-0 m-0">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-6">
								
								<!-- Google Maps - Settings on footer -->
								{{-- <div id="googlemaps" class="google-ma h-100 mb-0" style="min-height: 400px;"></div>--}}
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13335.083347195547!2d-70.73584493247903!3d-33.324806098461124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9662bf571469cf75%3A0xdf8f12892724bb91!2sMidas%20Chile!5e0!3m2!1ses-419!2scl!4v1601585845561!5m2!1ses-419!2scl" frameborder="0" style="border:0;width: 100% !important;min-height: 400px;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
				
							</div>
							<div class="col-md-6 p-5 my-5">
								
								<div class="px-4">
									<h2 class="font-weight-bold line-height-1 mb-2">Contáctanos</h2>
									<p class="text-3 mb-4"></p>
									<form class="contact-form form-style-2 pr-xl-5" action="php/contact-form.php" method="POST">
										<div class="contact-form-success alert alert-success d-none mt-4">
											<strong>Enviado!</strong> Tu mensaje ha sido enviado correctamente.
										</div>
				
										<div class="contact-form-error alert alert-danger d-none mt-4">
											<strong>Error!</strong> Lo siento, tuvimos un error al recibir tu mensaje.
											<span class="mail-error-message text-1 d-block"></span>
										</div>
										
										<div class="form-row">
											<div class="form-group col-xl-4">
												<input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" placeholder="Nombre" required>
											</div>
											<div class="form-group col-xl-8">
												<input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" placeholder="Email" required>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col">
												<input type="text" value="" data-msg-required="Please enter the subject." maxlength="100" class="form-control" name="subject" placeholder="Asunto" required>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col">
												<textarea maxlength="5000" data-msg-required="Please enter your message." rows="4" class="form-control" name="message" placeholder="Mensaje" required></textarea>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col">
												<input type="submit" value="Enviar" class="btn btn-primary btn-rounded font-weight-semibold px-5 btn-py-2 text-2" data-loading-text="Loading...">
											</div>
										</div>
									</form>
								</div>
				
							</div>
						</div>
					</div>
				</section>
				
				<section class="section bg-primary border-0 m-0">
					<div class="container">
						<div class="row justify-content-center text-center text-lg-left py-4">
							<div class="col-lg-auto appear-animation" data-appear-animation="fadeInRightShorter">
								<div class="feature-box feature-box-style-2 d-block d-lg-flex mb-4 mb-lg-0">
									<div class="feature-box-icon">
										<i class="icon-location-pin icons text-color-light"></i>
									</div>
									<div class="feature-box-info pl-1">
										<h5 class="font-weight-light text-color-light opacity-8 mb-0">Juan de la Fuente #834,</h5>
										<p class="text-color-light font-weight-semibold mb-0"> Lampa, Región Metropolitana, Chile</p>
									</div>
								</div>
							</div>
							<div class="col-lg-auto appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="200">
								<div class="feature-box feature-box-style-2 d-block d-lg-flex mb-4 mb-lg-0 px-xl-4 mx-lg-5">
									<div class="feature-box-icon">
										<i class="icon-call-out icons text-color-light"></i>
									</div>
									<div class="feature-box-info pl-1">
										<h5 class="font-weight-light text-color-light opacity-8 mb-0">Contacto</h5>
										<a href="tel:+8001234567" class="text-color-light font-weight-semibold text-decoration-none">+56 2 2747 1487 | +56 2 2738 6045</a>
									</div>
								</div>
							</div>
							<div class="col-lg-auto appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="400">
								<div class="feature-box feature-box-style-2 d-block d-lg-flex">
									<div class="feature-box-icon">
										<i class="icon-share icons text-color-light"></i>
									</div>
									<div class="feature-box-info pl-1">
										<h5 class="font-weight-light text-color-light opacity-8 mb-0">Suiguenos en</h5>
										<p class="mb-0">
											<span class="social-icons-facebook">
												<a href="https://www.facebook.com/MIDASCHILE/" target="_blank" class="text-color-light font-weight-semibold" title="Facebook">
													<i class="mr-1 fab fa-facebook-f"></i>
												</a>
											</span>
											<span class="social-icons-twitter pl-3">
												<a href="https://twitter.com/midaschile" target="_blank" class="text-color-light font-weight-semibold" title="Twitter">
													<i class="mr-1 fab fa-twitter"></i>
												</a>
											</span>
											<span class="social-icons-twitter pl-3">
												<a href="https://www.instagram.com/midaschile/" target="_blank" class="text-color-light font-weight-semibold" title="Twitter">
													<i class="fab fa-instagram"></i>
												</a>
											</span>
											<span class="social-icons-twitter pl-3">
												<a href="https://www.youtube.com/channel/UCfHKgr_oAZGikd2KDyS4jYg" target="_blank" class="text-color-light font-weight-semibold" title="Twitter">
													<i class="fab fa-youtube"></i>
												</a>
											</span>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			
			<footer id="footer" class="mt-0">
				<div class="footer-copyright">
					<div class="container py-2">
						<div class="row py-4">
							<div class="col d-flex align-items-center justify-content-center">
								<p>2019 © Copyright, Midas Chile. Todos los derechos reservados.</p>
							</div>
						</div>
					</div>
				</div>
			</footer>

		</div>

		<!-- Vendor -->
		<script src="{{ asset('HTML/vendor/jquery/jquery.min.js') }}"></script>
		<script src="{{ asset('HTML/vendor/jquery.appear/jquery.appear.min.js') }}"></script>
		<script src="{{ asset('HTML/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
		<script src="{{ asset('HTML/vendor/jquery.cookie/jquery.cookie.min.js') }}"></script>
		<script src="{{ asset('HTML/vendor/popper/umd/popper.min.js') }}"></script>
		<script src="{{ asset('HTML/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('HTML/vendor/common/common.min.js') }}"></script>
		<script src="{{ asset('HTML/vendor/jquery.validation/jquery.validate.min.js') }}"></script>
		<script src="{{ asset('HTML/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
		<script src="{{ asset('HTML/vendor/jquery.gmap/jquery.gmap.min.js') }}"></script>
		<script src="{{ asset('HTML/vendor/jquery.lazyload/jquery.lazyload.min.js') }}"></script>
		<script src="{{ asset('HTML/vendor/isotope/jquery.isotope.min.js') }}"></script>
		<script src="{{ asset('HTML/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
		<script src="{{ asset('HTML/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
		<script src="{{ asset('HTML/vendor/vide/jquery.vide.min.js') }}"></script>
		<script src="{{ asset('HTML/vendor/vivus/vivus.min.js') }}"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="{{ asset('HTML/js/theme.js') }}"></script>
		
		<!-- Current Page Vendor and Views -->
		<script src="{{ asset('HTML/vendor/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
		<script src="{{ asset('HTML/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
		<script src="{{ asset('HTML/js/views/view.contact.js') }}"></script>

		<!-- Theme Custom -->
		<script src="{{ asset('HTML/js/custom.js') }}"></script>
		
		<!-- Theme Initialization Files -->
		<script src="{{ asset('HTML/js/theme.init.js') }}"></script>

		<!-- Examples -->
		<script src="{{ asset('HTML/js/examples/examples.portfolio.js') }}"></script>

		<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
			ga('create', 'UA-12345678-1', 'auto');
			ga('send', 'pageview');
		</script>
		 -->

		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhpYHdYRY2U6V_VfyyNtkPHhywLjDkhfg"></script>
		<script>

			/*
			Map Settings

				Find the Latitude and Longitude of your address:
					- https://www.latlong.net/
					- http://www.findlatitudeandlongitude.com/find-address-from-latitude-and-longitude/

			*/

			// Map Markers
			var mapMarkers = [{
				address: "New York, NY 10017",
				html: "<strong>New York Office</strong><br>New York, NY 10017<br><br><a href='#' onclick='mapCenterAt({latitude: 40.75198, longitude: -73.96978, zoom: 16}, event)'>[+] zoom here</a>",
				icon: {
					image: "img/pin.png",
					iconsize: [26, 46],
					iconanchor: [12, 46]
				}
			}];

			// Map Initial Location
			var initLatitude = 40.75198;
			var initLongitude = -73.96978;

			// Map Extended Settings
			var mapSettings = {
				controls: {
					draggable: (($.browser.mobile) ? false : true),
					panControl: true,
					zoomControl: true,
					mapTypeControl: true,
					scaleControl: true,
					streetViewControl: true,
					overviewMapControl: true
				},
				scrollwheel: false,
				markers: mapMarkers,
				latitude: initLatitude,
				longitude: initLongitude,
				zoom: 5
			};

			var map = $('#googlemaps').gMap(mapSettings),
				mapRef = $('#googlemaps').data('gMap.reference');

			// Map text-center At
			var mapCenterAt = function(options, e) {
				e.preventDefault();
				$('#googlemaps').gMap("centerAt", options);
			}

			// Styles from https://snazzymaps.com/
			var styles = [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}];

			var styledMap = new google.maps.StyledMapType(styles, {
				name: 'Styled Map'
			});

			mapRef.mapTypes.set('map_style', styledMap);
			mapRef.setMapTypeId('map_style');

		</script>



	</body>
</html>
