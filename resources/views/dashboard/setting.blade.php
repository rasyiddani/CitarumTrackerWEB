@extends('layout.index')
@section('content')
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <h5>Nilai Batasan</h5>
                    <hr>
                    <form action="{{ url('/settings/limits') }}" method="POST">
                        @include('components.alerts.success')
                        @include('components.alerts.error')
                        @csrf
                        <div class="mb-3">
                            <label for="value" class="form-label">Batas</label>
                            <input type="value" name="value" class="form-control number" id="value"
                                value="{{ $limits->value }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="over" class="form-label">Status Over</label>
                            <input type="over" name="over" class="form-control number" id="over"
                                value="{{ $limits->over }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="under" class="form-label">Status Under</label>
                            <input type="under" name="under" class="form-control number" id="under"
                                value="{{ $limits->under }}" required>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary float-end">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    @include('components.scripts.dashboard.setting')
@endpush
