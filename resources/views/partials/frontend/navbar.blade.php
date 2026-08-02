{{-- Frontend Navbar --}}
<nav class="navbar navbar-expand-lg navbar-main fixed-top" id="mainNavbar">
    <div class="container">
        {{-- Brand --}}
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo-ft.jpeg') }}" alt="Logo FT UNSUR" style="width: 45px; height: 45px; object-fit: contain; margin-right: 10px; border-radius: 4px;">
            <span class="d-flex flex-column">
                <span style="font-weight: 700; line-height: 1;">FAKULTAS TEKNIK</span>
                <span class="brand-sub"> Universitas Suryakancana</span>
            </span>
        </a>

        {{-- Navigation Links removed to make Elvira the sole guide --}}
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                {{-- Empty --}}
            </ul>
        </div>
    </div>
</nav>
