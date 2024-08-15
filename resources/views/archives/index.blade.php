@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.partials.topnav', ['title' => 'Data Archives'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <div class="nav-tabs-boxed">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="archive-tab" data-bs-toggle="tab" href="#archive"
                                        role="tab" aria-controls="archive" aria-selected="true">Data Arsip</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="visualisasi-tab" data-bs-toggle="tab" href="#visualisasi"
                                        role="tab" aria-controls="visualisasi" aria-selected="false">Visualisasi
                                        Arsip</a>
                                </li>
                            </ul>
                            <style>
                                #myTab {
                                    .nav-item:hover .nav-link {
                                        border-bottom: 2px solid #1171ef;
                                        color: #11cdef;
                                    }

                                    .nav-item .active {
                                        color: #11cdef;
                                        border-bottom: 2px solid #1171ef;
                                        font-weight: bold;
                                    }
                                }
                            </style>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="tab-content" id="myTabContent">
                            {{-- rak --}}
                            @include('archives.data-arsip')
                            {{-- Visualisasi Rak --}}
                            @include('archives.visualisasi-arsip')
                        </div>
                        <style>
                            tfoot input {
                                width: 100%;
                                padding: 3px;
                                box-sizing: border-box;
                                font-family: sans-serif;
                                font-weight: bold;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.partials.footer')
@endsection
