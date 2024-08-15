<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item opacity-5 text-white text-sm"><i class="fa-regular fa-house"></i>
                </li>
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">
                    {{ auth()->user()->role->name }}</li>
                </li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">{{ $title }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2" id="navbar">
            <ul class="navbar-nav ms-md-auto d-flex align-items-center ">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                        <i class="fa-solid fa-user"></i>
                        <div class="d-sm-none d-lg-inline-block text-white ms-2">Hi,
                            {{ auth()->user()->nama }}
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        @if (auth()->user()->role_id == 2)
                            <li><a class="dropdown-item" href="{{ route('profile.operator') }}">
                                    <i class="fa-solid fa-user-pen"></i>&nbsp;&nbsp;&nbsp;Profile
                                </a></li>
                        @endif
                        <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <li><a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="dropdown-item">
                                    <i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;&nbsp;Log Out
                                </a>
                            </li>
                        </form>
                    </ul>
                </li>

                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
