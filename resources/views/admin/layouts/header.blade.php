<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="{{ route('admin.index') }}">React T-Shirts</a>

    <ul class="navbar-nav flex-row d-md-none">
        {{-- Mobile Menu Toggles --}}
        <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i> {{-- Use Font Awesome icon --}}
            </button>
        </li>
    </ul>

    {{-- Optional: Add search or other header items here --}}
    {{-- Example Search:
    <div id="navbarSearch" class="navbar-search w-100 collapse">
      <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
    </div> --}}
</header> 