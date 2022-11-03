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
		<link rel="shortcut icon" href="" type="image/x-icon" />
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
		<link rel="stylesheet" href="{{ asset('HTML/css/skins/skin-corporate-9.css') }}"> 

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ asset('HTML/css/custom.css') }}">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">

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
		.featured-boxes-style-4 .featured-box.featured-box-primary .icon-featured {
		    border-color: #8fca00 !important;
		    color: #8fca00 !important;
		}
		html .text-color-primary, html .text-primary {
		    color: #8fca00 !important;
		}
		.owl-carousel .owl-dots .owl-dot.active span, .owl-carousel .owl-dots .owl-dot:hover span {
		    background-color: #8fca00;
		}
		#header .header-btn-collapse-nav {
		    background: #8fca00;
		}
		#header .header-nav-main:not(.header-nav-main-mobile-dark) nav > ul > li > a.active {
		    background: #8fca00;
		}
		#header .header-nav-main:not(.header-nav-main-mobile-dark) nav > ul > li > a {
		    color: #8fca00;
		}
		#header .header-nav-main:not(.header-nav-main-mobile-dark) nav > ul > li > a.active:focus, #header .header-nav-main:not(.header-nav-main-mobile-dark) nav > ul > li > a.active:hover {
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
				<img src="{{ asset('img/midas1.png') }}" width="100" style="margin-top: -30px;margin-left: -30px;">
			</div>
			{{-- <div class="bounce3"></div> --}}
		</div>
	</div>

	<div class="body">
		<header id="header" class="header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': true, 'stickyStartAt': 30, 'stickyHeaderContainerHeight': 70}">
			<div class="header-body border-top-0">
				<div class="header-container container-fluid px-lg-4">
					<div class="header-row">
						<div class="header-column header-column-border-right flex-grow-0">
							<div class="header-row pr-4">
								<div class="header-logo">
									<a href="index.html">
										<img alt="Porto" width="100" height="40" data-sticky-width="82" data-sticky-height="40" src="{{ asset('img/midas.png') }}">
									</a>
								</div>
							</div>
						</div>
						<div class="header-column">
							<div class="header-row">
								<div class="header-nav header-nav-links justify-content-center">
									<div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
										
									</div>
								</div>
							</div>
						</div>
						<div class="header-column header-column-border-left flex-grow-0 justify-content-center">
							<div class="header-row pl-4 justify-content-end">
									<img alt="Porto" width="100" height="40" data-sticky-width="82" data-sticky-height="40" src="{{ asset('adidas-logo-1.png') }}">
<!-- 								<button class="btn header-btn-collapse-nav ml-0 ml-sm-3" data-toggle="collapse" data-target=".header-nav-main nav">
									<i class="fas fa-bars"></i>
								</button> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div role="main" class="main">

			<div class="container py-4 my-5">
				<div class="row justify-content-center text-center mb-4 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">
					<div class="col-lg-8">
						<h2 class="font-weight-bold mb-3 mt-3">Ingrese los siguientes datos</h2>
						<div class="form-group">
			                <label>Nombre Completo</label>
			                <input name="nombre" type="text" class="form-control" placeholder="" required>
			              </div>
			              <div class="form-group">
			                <label>Celular(Ej:56977884455)</label>
			                <div class="input-group">
			                  <div class="input-group-btn">
			                    <button class="btn btn-default" >+ 56 9</button>
			                  </div>
			                  <input name="telefono" type="number" class="form-control" placeholder="87654321" required>
			                  {{-- min="8" max="8" --}}
			                </div>

			              </div>
			              <div class="form-group">
			                <label>Correo electrónico ( Opcional )</label>
			                <div class="input-group">
			                 
			                  <input name="correo" type="text" class="form-control" placeholder="ingrese su corre electrónico">


			                </div>

			              </div>
			              <div class="form-group">
			                <div id="pac-container">
			                  <label>Dirección</label>
			                <input name="direccion" id="pac-input" type="text" class="form-control" placeholder="" required>
			              </div>
			              </div>
			              <div class="form-group">
			                  <label>Block, Departamento o Detalle de Dirección</label>
			                  <input name="detalle" type="text" class="form-control" placeholder="">
			              </div>
						<div class="form-group">
			                  <label>Código Boleta</label>
			                  <input name="detalle" type="text" class="form-control" placeholder="">
			              </div>
						<a class="btn btn-outline btn-dark" style="font-size: 20px;text-align: center;width: 210px;height: 80px;" href="{{ asset('/') }}">GENERAR DESCUENTO</a>
					</div>
				</div>
			</div>
		</div>

		<footer id="footer" class="mt-0">
			<div class="container">
				<div class="row py-5">
					<div class="col text-center">
						<!--Facebook-->
						<a class="btn-floating btn-lg" href="https://www.facebook.com/MIDASCHILE/"><i class="fab fa-facebook-f"></i></a>
						<!--Twitter-->
						<a class="btn-floating btn-lg" href="https://twitter.com/midaschile"><i class="fab fa-twitter"></i></a>
						<!--Instagram-->
						<a class="btn-floating btn-lg" href="https://www.instagram.com/midaschile/"><i class="fab fa-instagram"></i></a>
						<!--Youtube-->
						<a class="btn-floating btn-lg" href="https://www.youtube.com/channel/UCfHKgr_oAZGikd2KDyS4jYg"><i class="fab fa-youtube"></i></a>
						<!--WhatsApp-->
						<a class="btn-floating btn-lg" href=""><i class="fab fa-whatsapp"></i></a>
					</div>
				</div>
			</div>
			<div class="footer-copyright footer-copyright-style-2">
				<div class="container py-2">
					<div class="row py-4">
						<div class="col-lg-8 text-center text-lg-left mb-2 mb-lg-0">
							<p>
								<span class="pr-0 pr-md-3 d-block d-md-inline-block"><i class="far fa-dot-circle text-color-primary top-1 p-relative"></i><span class="text-color-light opacity-7 pl-1">Juan de la Fuente #834, Lampa, Región Metropolitana, Chile</span></span>
								<span class="pr-0 pr-md-3 d-block d-md-inline-block"><i class="fab fa-whatsapp text-color-primary top-1 p-relative"></i><a href="tel:1234567890" class="text-color-light opacity-7 pl-1">+56 2 2747 1487 | +56 2 2738 6045</a></span>
								<span class="pr-0 pr-md-3 d-block d-md-inline-block"><i class="far fa-envelope text-color-primary top-1 p-relative"></i><a href="mailto:mail@example.com" class="text-color-light opacity-7 pl-1">contacto@midaschile.cl</a></span>
							</p>
						</div>
						<div class="col-lg-4 d-flex align-items-center justify-content-center justify-content-lg-end mb-4 mb-lg-0 pt-4 pt-lg-0">
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

	<!-- Theme Custom -->
	<script src="{{ asset('HTML/js/custom.js') }}"></script>
	
	<!-- Theme Initialization Files -->
	<script src="{{ asset('HTML/js/theme.init.js') }}"></script>

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

</body>
</html>
