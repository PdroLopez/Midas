<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <ul class="menu-nav">
            <li class="menu-item menu-item-active" aria-haspopup="true">
                <a href="{{ asset('private') }}" class="menu-link">
                    <span class="svg-icon menu-icon">
                        <i class=" fab fa-delicious "></i>
                    </span>
                    <span class="menu-text">Home</span>
                </a>
            </li>
            
            <li class="menu-section">
                <h4 class="menu-text">Navegación</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>

            {{--@foreach (Auth::user()->rol->nav_role as $nav_role)
                @if ($nav_role->modulos_id == Session::get('modulo')->id)
                    @if ($nav_role->nav->hijos->count() == 0)
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ asset($nav_role->nav->url) }}" class="menu-link">
                                <span class="svg-icon menu-icon">
                                    <i class=" fab fa-delicious "></i>
                                </span>
                                <span class="menu-text">{{$nav_role->nav->nombre}}</span>
                            </a>
                        </li>
                    @else
                        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                            <a href="javascript:;" class="menu-link menu-toggle">
                                <span class="svg-icon menu-icon">
                                    <i class=" fab fa-delicious "></i>
                                </span>
                                <span class="menu-text">{{$nav_role->nav->nombre}}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu">
                                <i class="menu-arrow"></i>
                                <ul class="menu-subnav">
                                    @foreach ($nav_role->nav->hijos as $hijos)
                                        <li class="kt-menu__item " aria-haspopup="true">
                                            <a href="{{ asset($nav_role->nav->url.'/'.$hijos->url) }}" class="kt-menu__link ">
                                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                                <span class="kt-menu__link-text">{{$hijos->nombre}}</span>
                                            </a>
                                        </li>

                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="{{ asset($nav_role->nav->url.'/'.$hijos->url) }}" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">{{$hijos->nombre}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @endif
                @endif

            @endforeach--}}
        </ul>
    </div>
</div>













