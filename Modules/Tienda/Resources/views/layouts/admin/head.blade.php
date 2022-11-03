<head>
	<base href="">
    <meta charset="utf-8"/>
    <title>Tienda</title>
    {{--  @if(array_key_exists('title', $private))
			{{$private['title']}}
		@endif
    {{Auth::user()->name}}--}}
    <meta name="description" content="Updates and statistics"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>

	<link href="{{ asset('theme/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('theme/dist/assets/plugins/global/plugins.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('theme/dist/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('theme/dist/assets/css/style.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('theme/dist/assets/css/themes/layout/header/base/light.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('theme/dist/assets/css/themes/layout/header/menu/light.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('theme/dist/assets/css/themes/layout/brand/dark.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('theme/dist/assets/css/themes/layout/aside/dark.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link rel="shortcut icon" href="{{ asset('img/midas.ico') }}"/>
	<style type="text/css">
  	@if(array_key_exists('custom_css', $private))
      	{!!$private['custom_css']!!}
  	@endif
	</style>
	@yield('head')
</head>
