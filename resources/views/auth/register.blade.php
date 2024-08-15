@extends('layouts.app')

@section('content')
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('{{ asset('img/bg-register.jpg') }}'); background-size:cover">

            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <img src="{{ asset('img/logos/logo-sai.png') }}" alt="Logo POLINEMA" class="img-fluid" width="150px">
                        <h1 class="text-white">Selamat Datang!</h1>
                        <p class="text-lead text-white">Silahkan untuk pegawai <i>register account</i> terlebih
                            dahulu.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-md-n11 justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center">
                            <h5><i>Register Account</i></h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register.perform') }}">
                                @csrf
                                <div class="flex flex-col mb-3">
                                    <input type="text" name="nik" class="form-control" placeholder="NIK"
                                        aria-label="NIK" value="{{ old('nik') }}">
                                    @error('nik')
                                        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <input type="text" name="nama" class="form-control" placeholder="Full Name"
                                        aria-label="Nama" value="{{ old('nama') }}">
                                    @error('nama')
                                        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <input type="text" name="username" class="form-control" placeholder="Username"
                                        aria-label="Name" value="{{ old('username') }}">
                                    @error('username')
                                        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email"
                                        aria-label="Email" value="{{ old('email') }}">
                                    @error('email')
                                        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password"
                                            aria-label="Password" id="password">
                                        <span class="input-group-text" id="show-password-toggle"><i class="fa fa-eye"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    @error('password')
                                        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror

                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-info w-100 my-3 mb-2">Sign up</button>
                                </div>
                                <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{ route('login') }}"
                                        class="text-dark font-weight-bolder">Sign in</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
