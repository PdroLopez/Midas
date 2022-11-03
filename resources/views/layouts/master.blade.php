<!DOCTYPE html>
<html lang="en">
	@include('layouts.head')
	<body id="kt_body" class="quick-panel-right demo-panel-right offcanvas-right header-fixed header-mobile-fixed aside-enabled aside-static page-loading">

		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-row flex-column-fluid page">
				@include('layouts.aside')
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					@include('layouts.header')
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						@yield('content')
					</div>
					@include('layouts.footer')
				</div>
			</div>
		</div>
		{{-- @include('layouts.user') --}}
		@include('layouts.js')
	</body>
</html>
