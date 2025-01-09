@extends('layout.index')

@push('style')
    @include('components.styles.plugins.dataTables')
    @include('components.styles.plugins.select2')

    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #d1d1d1;
            /* Background color */
            color: black;
            /* Text color */
            /* Border color */
        }

        /* Hover effect for selected items */
        .select2-container--default .select2-selection--multiple .select2-selection__choice:hover {
            background-color: #0056b3;
            color: #ffffff;
        }
    </style>
@endpush

@section('content')
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Revenue Updates</h5>
                            <p class="card-subtitle mb-0">Overview of Profit</p>
                        </div>
                        <div>
                            <select class="form-select form-control" id="nodeChart" multiple style="width: 200px;">
                                <option value="node1">Node 1</option>
                                <option value="node7">Node 7</option>
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div id="charts"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Row 2 -->
    <div class="row">
        <!-- Employee Salary -->
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="mb-3">
                        <select class="form-select" id="nodeFilter">
                            <option value="node1">Node 1</option>
                            <option value="node7">Node 7</option>
                        </select>
                    </div>
                    <table id="table" class="table border text-nowrap customize-table mb-0 align-middle w-100">
                        <thead class="text-dark fs-4">
                            <th>Time</th>
                            <th>Impedance</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('components.modals.dashboard.index')
@endsection

@push('script')
    @include('components.scripts.plugins.apexcharts')
    @include('components.scripts.plugins.dataTables')
    @include('components.scripts.plugins.select2')
    @include('components.scripts.dashboard.index')
@endpush
