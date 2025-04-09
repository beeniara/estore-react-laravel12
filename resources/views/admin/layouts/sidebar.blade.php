<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
        aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">React T-Shirts</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.index') ? 'active' : '' }}" aria-current="page" href="{{ route('admin.index') }}">
                        <i class="fa-solid fa-gauge"></i> {{-- Font Awesome --}}
                        Dashboard
                    </a>
                </li>
                <li class="nav-item"> {{-- Colors Link --}}
                    <a class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.colors.*') ? 'active' : '' }}" href="{{ route('admin.colors.index') }}">
                        <i class="fa-solid fa-palette"></i> {{-- Font Awesome --}}
                        Colors
                    </a>
                </li>
                <li class="nav-item"> {{-- Sizes Link --}}
                    <a class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('admin.sizes.*') ? 'active' : '' }}" href="{{ route('admin.sizes.index') }}">
                        <i class="fa-solid fa-expand"></i> {{-- Font Awesome --}}
                        Sizes
                    </a>
                </li>
                {{-- Add other menu items here later --}}
                {{-- Example:
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="#">
                         <i class="fa-solid fa-box"></i>
                        Products
                    </a>
                </li>
                --}}
            </ul>

            <hr class="my-3">

            <ul class="nav flex-column mb-auto">
                 {{-- Add settings or profile links here later --}}
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="#" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i> {{-- Font Awesome --}}
                        Sign out
                    </a>
                    <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div> 