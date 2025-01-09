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
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="{{ url('/') }}"
                                    class="text-nowrap logo-img text-center d-block mb-5 w-100">
                                    <img src="{{ asset('/assets/dist/images/logos/dark-logo.svg') }}" width="180"
                                        alt="">
                                </a>
                                @include('components.alerts.error')
                                <form action="{{ url('/auth/login') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" id="username"
                                            aria-describedby="usernameHelp" value="{{ old('username') }}" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            required>
                                    </div>
                                    <button class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign
                                        In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layout.scripts')
</body>

</html>
