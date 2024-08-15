<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header d-flex justify-content-center align-items-center">
        <a class="navbar-brand" target="_blank">
            <span class="ms-1 fw-bold fs-5"
                style="font-family: 'film noir', sans-serif;vertical-align: middle; ">Visualisasi Arsip</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if (auth()->user()->role_id == 1)
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/admin') ? 'active' : '' }}"
                        href="{{ route('dashboard_admin') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="ni ni-tv-2  text-sm opacity-10 {{ Request::is('dashboard/admin') ? 'text-white' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                    <style>
                        .nav-link.active {
                            color: aliceblue
                        }
                    </style>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/admin/archives') ? 'active' : '' }}"
                        href="{{ route('archives.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fa fa-file-archive-o text-sm opacity-10 {{ Request::is('dashboard/admin/archives') ? 'text-white' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Data Archives</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Master Data</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/admin/users') ? 'active' : '' }}"
                        href="{{ route('users.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fa fa-users text-sm opacity-10 {{ Request::is('dashboard/admin/users') ? 'text-white' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">User Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/admin/locations') ? 'active' : '' }}"
                        href="{{ route('locations.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fa fa-thumb-tack text-sm opacity-10 {{ Request::is('dashboard/admin/locations') ? 'text-white' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Data Locations</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/admin/categories') ? 'active' : '' }}"
                        href="{{ route('categories.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fa fa-bookmark-o text-sm opacity-10 {{ Request::is('dashboard/admin/categories') ? 'text-white' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Data Categories</span>
                    </a>
                </li>

                {{-- @else
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/operator') ? 'active' : '' }}"
                        href="{{ route('dashboard_operator') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="ni ni-tv-2  text-sm opacity-10 {{ Request::is('dashboard/operator') ? 'text-white' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                    <style>
                        .nav-link.active {
                            color: aliceblue
                        }
                    </style>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/operator/profile') ? 'active' : '' }}"
                        href="{{ route('profile.operator') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="ni ni-single-02 text-sm opacity-10 {{ Request::is('dashboard/operator/profile') ? 'text-white' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li> --}}
            @endif
        </ul>
    </div>
</aside>
{{-- <li class="nav-item">
    <a class="nav-link {{ str_contains(request()->url(), 'tables') == true ? 'active' : '' }}"
        href="{{ route('page', ['page' => 'tables']) }}">
        <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Tables</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ str_contains(request()->url(), 'billing') == true ? 'active' : '' }}"
        href="{{ route('page', ['page' => 'billing']) }}">
        <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Billing</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ Route::currentRouteName() == 'virtual-reality' ? 'active' : '' }}"
        href="{{ route('virtual-reality') }}">
        <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-app text-info text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Virtual Reality</span>
    </a>
</li> --}}
