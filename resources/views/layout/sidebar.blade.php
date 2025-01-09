@php
$segment1 = request()->segment(1);
$segment2 = request()->segment(2);
$segment3 = request()->segment(3);
@endphp
<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ url('/') }}" class="text-nowrap logo-img">
                <img src="{{ asset('/assets/dist/images/logos/dark-logo.svg') }}" class="dark-logo" width="180"
                    alt="" />
                <img src="{{ asset('/assets/dist/images/logos/light-logo.svg') }}" class="light-logo" width="180"
                    alt="" />
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8 text-muted"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('/') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-aperture"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-layout-grid"></i>
                        </span>
                        <span class="hide-menu">Node</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ url('/node/1') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Node 1</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ url('/node/2') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Node 2</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ url('/node/3') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Node 3</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ url('/node/4') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Node 4</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('/settings') }}" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-settings"></i>
                        </span>
                        <span class="hide-menu">Settings</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="fixed-profile p-3 bg-light-secondary rounded sidebar-ad mt-3">
            <div class="hstack gap-3">
                <div class="john-img">
                    <img src="{{ asset('/assets/dist/images/profile/user-1.jpg') }}" class="rounded-circle" width="40"
                        height="40" alt="">
                </div>
                <div class="john-title">
                    <h6 class="mb-0 fs-4 fw-semibold">Admin</h6>
                    <span class="fs-2 text-dark">Admin</span>
                </div>
                <button class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="button"
                    aria-label="logout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
                    <i class="ti ti-power fs-6"></i>
                </button>
            </div>
        </div>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->