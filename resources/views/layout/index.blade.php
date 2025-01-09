<!DOCTYPE html>
<html lang="en">

@include('layout.head')

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('/assets/dist/images/logos/favicon.ico') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('/assets/dist/images/logos/favicon.ico') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('layout.sidebar')
        <!--  Main wrapper -->
        <div class="body-wrapper">
            @include('layout.header')
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    @include('layout.scripts')
</body>

</html>