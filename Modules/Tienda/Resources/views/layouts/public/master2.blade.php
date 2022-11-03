<!DOCTYPE html>
<html lang="en">
	@include('tienda::layouts.public.head2')
	<body id="kt_body" class="quick-panel-right demo-panel-right offcanvas-right header-fixed header-mobile-fixed aside-enabled aside-static page-loading">

		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-row flex-column-fluid page">
				@include('tienda::layouts.public.aside')
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					@include('tienda::layouts.public.header')
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        @include('layouts.backend.notifications')
						@yield('tienda::content')
					</div>
					@include('tienda::layouts.public.footer')
				</div>
			</div>
		</div>
		{{-- @include('tienda::layouts.public.user') --}}
		@include('tienda::layouts.public.js')
	</body>
</html>
