@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.partials.topnav', ['title' => 'Data Categories'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0 tab-pane fade show active text-sm p-4" id="admin" role="tabpanel"
                            aria-labelledby="admin-tab" style="width:100%">
                            <div class="d-flex justify-content-start mb-3 gap-2">
                                <div class="d-flex justify-content-start">
                                    <!-- Dropdown untuk Tambah Data -->
                                    <div class="btn-group gap-2">
                                        <button class="btn bg-gradient-success btn-sm rounded ps-3 pe-3" type="button"
                                            data-bs-toggle="modal" data-bs-target="#tambahCategory">
                                            <i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Tambah Data
                                        </button>
                                    </div>

                                    <style>
                                        .dropdown:hover .dropdown-menu {
                                            display: block;
                                        }
                                    </style>
                                </div>

                            </div>

                            @include('categories.modal.tambah_category')
                            <table class="hover row-border stripe table-responsive align-items-center mb-0" id="userTable"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-dark text-xs font-weight-bolder ">
                                            #
                                        </th>
                                        <th class="text-uppercase text-dark text-xs font-weight-bolder  ps-2">
                                            Nama Kategori
                                        </th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $loop->iteration }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{ $category->name }}</p>
                                            </td>
                                            <td class="align-middle text-end p-2">
                                                <div
                                                    class="d-flex px-3 ps-2 py-1 justify-content-center align-items-center gap-1">
                                                    <form action="{{ route('categories.destroy', $category->id) }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-outline-danger btn-xs confirm-delete"><i
                                                                class="fa fa-trash text-danger "></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-uppercase text-dark text-xs font-weight-bolder ">
                                            #
                                        </th>
                                        <th class="text-uppercase text-dark text-xs font-weight-bolder  ps-2">
                                            Nama-Kategori
                                        </th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">
                                            Action</th>
                                    </tr>
                                </tfoot>
                                <style>
                                    tfoot input {
                                        width: 100%;
                                        padding: 3px;
                                        box-sizing: border-box;
                                        font-family: sans-serif;
                                        font-weight: bold;
                                    }
                                </style>
                            </table>
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
