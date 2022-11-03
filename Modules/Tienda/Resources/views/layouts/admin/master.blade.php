<!DOCTYPE html>
<html lang="en">
	@include('tienda::layouts.admin.head')
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">


		@include('tienda::layouts.admin.mobile')

		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-row flex-column-fluid page">
				@include('tienda::layouts.admin.aside')
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					@include('tienda::layouts.admin.header')
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						@yield('tienda::content')
					</div>
					@include('tienda::layouts.admin.footer')
				</div>
			</div>
		</div>
		@include('tienda::layouts.admin.user')
		@include('tienda::layouts.admin.js')
	</body>
</html>
