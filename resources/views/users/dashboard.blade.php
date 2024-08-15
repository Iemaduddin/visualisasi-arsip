@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.partials.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animate__animated animate__flipOutX" src="{{ asset('img/logos/shin.png') }}" alt="AdminLTELogo"
                width="200">
        </div>
        <div class="row">
            <div class="col-lg-4 mb-lg-0 mb-4">
                <div class="row">
                    <div class="col mb-3">
                        <div class="card">
                            <div class="card-body p-3">
                                <a href="{{ route('users.index') }}">
                                    <div class="row">
                                        <div class="col">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">User</p>
                                                {{-- <h5 class="counter font-weight-bolder" data-count="{{ $user->count() }}">
                                                    0
                                                </h5> --}}
                                                <h5 class="font-weight-bolder">
                                                    {{ $user->count() }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-7 text-end">
                                            <div class="icon icon-shape bg-gradient-info shadow-primary text-center">
                                                <i class="fa fa-user-tie text-lg opacity-10" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-1">
                    <div class="card p-3 h-100">
                        <div class="col-12 d-flex justify-content-start align-items-center">
                            <button class="btn btn-xs bg-gradient-info" onclick="downloadChartAll()">Export as
                                PNG</button>
                        </div>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chartAll" class="chart-canvas"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mb-lg-0 mb-4">
                <div class="card p-3 h-100">
                    <div class="col-12 d-flex justify-content-end align-items-center">
                        <button class="btn btn-xs bg-gradient-info" onclick="downloadChartT()">Export as PNG</button>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart h-100">
                            <canvas id="chartT" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-4">
                <div class="card p-3 h-100">
                    <div class="col-12 d-flex justify-content-start align-items-center">
                        <button class="btn btn-xs bg-gradient-info" onclick="downloadChartAll()">Export as PNG</button>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chartAllKolom" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card p-3 h-100">
                    <div class="col-12 d-flex justify-content-end align-items-center">
                        <button class="btn btn-xs bg-gradient-info" onclick="downloadChartT()">Export as PNG</button>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart h-100">
                            <canvas id="chartTKolom" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.partials.footer')
    </div>
@endsection
@push('js')
@endpush
