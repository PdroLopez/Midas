<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
	<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
		<ul class="menu-nav">
			@if(Session::get('collection') != null)
   				@foreach (Session::get('collection') as $coleccion)
        			<li class="menu-item menu-item-submenu menu-item-rel menu-item-active" data-menu-toggle="click" aria-haspopup="true">									
        				<a href="{{ asset('private/usar-modulo/'.$coleccion->modulos_id) }}" class="menu-link">
							<span class="menu-text">{{$coleccion->modulos->nombre}}</span>
								<i class="menu-arrow"></i>
						</a>
					</li>
       			@endforeach                     
            @endif
		</ul>
	</div>
</div>

@include('layouts.backend.notifications')