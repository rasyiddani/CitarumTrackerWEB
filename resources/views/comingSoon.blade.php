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
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-lg-4">
                        <div class="text-center">
                            <img src="{{ asset('/assets/dist/images/backgrounds/maintenance.svg') }}" alt=""
                                class="img-fluid" width="500">
                            <h1 class="fw-semibold my-7 fs-9">Coming Soon</h1>
                            <a class="btn btn-primary" href="{{ url('/') }}" role="button">Go Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layout.scripts')
</body>

</html>