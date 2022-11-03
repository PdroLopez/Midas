<div id="kt_header" class="header header-fixed">
                        <!--begin::Container-->
<div class="container-fluid d-flex align-items-stretch justify-content-between">
    <!--begin::Header Menu Wrapper-->
    <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
        <!--begin::Header Menu-->
        <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">

        </div>
        <!--end::Header Menu-->
    </div>
    <!--end::Header Menu Wrapper-->
    <!--begin::Topbar-->
    <div class="topbar">
       
        <div class="topbar-item">
            <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hola,</span>
                <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ Auth::user()->name }}</span>
                <span class="symbol symbol-35 symbol-light-success">
                    <span class="symbol-label font-size-h5 font-weight-bold">{{ Auth::user()->name[0] }}</span>
                </span>
            </div>
        </div>
        <!--end::User-->
    </div>
    <!--end::Topbar-->
</div>
<!--end::Container-->
</div>
@if(Session::has('mensaje'))
    <div class="col-10 mt-5 mb-0 ml-auto mr-auto alert alert-custom alert-{{ Session::get('mensaje')['type'] }} fade show" role="alert" style="height: 60px;">
        <div class="alert-icon">{{-- <i class="flaticon-warning"></i> --}}</div>
        <div class="alert-text">{{ Session::get('mensaje')['content'] }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
@endif

<script type="text/javascript">
    setTimeout(function() {
        $('.alert-custom').fadeOut('fast');
    }, 5000);
</script>

