{{-- Admin Sidebar — Light Modern --}}
<aside class="admin-sidebar" id="adminSidebar">

    {{-- Brand --}}
    <div class="sidebar-brand">
        <div class="brand-logo-wrap" style="background:transparent; padding:0;">
            <img src="{{ asset('images/logo-unsur.png') }}" alt="Logo" style="width:48px;height:48px;object-fit:contain; border-radius:4px;">
        </div>
        <div class="brand-text">
            <div class="brand-name">FT UNSUR</div>
            <div class="brand-sub">Admin Panel</div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu Utama</div>

        <div class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <div class="nav-icon"><i class="fas fa-th-large"></i></div>
                <span class="nav-label">Dashboard</span>
            </a>
        </div>

        <div class="nav-section-label">Kelola Konten</div>

        <div class="nav-item">
            <a href="{{ route('admin.profil-fakultas.edit') }}" class="nav-link {{ request()->routeIs('admin.profil-fakultas*') ? 'active' : '' }}">
                <div class="nav-icon"><i class="fas fa-university"></i></div>
                <span class="nav-label">Profil Fakultas</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.program-studi.index') }}" class="nav-link {{ request()->routeIs('admin.program-studi*') ? 'active' : '' }}">
                <div class="nav-icon"><i class="fas fa-graduation-cap"></i></div>
                <span class="nav-label">Program Studi</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.fasilitas.index') }}" class="nav-link {{ request()->routeIs('admin.fasilitas*') ? 'active' : '' }}">
                <div class="nav-icon"><i class="fas fa-building"></i></div>
                <span class="nav-label">Fasilitas</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.prestasi.index') }}" class="nav-link {{ request()->routeIs('admin.prestasi*') ? 'active' : '' }}">
                <div class="nav-icon"><i class="fas fa-trophy"></i></div>
                <span class="nav-label">Prestasi</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.galeri.index') }}" class="nav-link {{ request()->routeIs('admin.galeri*') ? 'active' : '' }}">
                <div class="nav-icon"><i class="fas fa-images"></i></div>
                <span class="nav-label">Galeri</span>
            </a>
        </div>

        <div class="nav-section-label">PMB</div>

        <div class="nav-item">
            <a href="{{ route('admin.informasi-pmb.index') }}" class="nav-link {{ request()->routeIs('admin.informasi-pmb*') ? 'active' : '' }}">
                <div class="nav-icon"><i class="fas fa-info-circle"></i></div>
                <span class="nav-label">Informasi PMB</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.biaya.index') }}" class="nav-link {{ request()->routeIs('admin.biaya*') ? 'active' : '' }}">
                <div class="nav-icon"><i class="fas fa-money-bill-wave"></i></div>
                <span class="nav-label">Biaya Pendidikan</span>
            </a>
        </div>

        <div class="nav-section-label">Pengaturan</div>

        <div class="nav-item">
            <a href="{{ route('admin.kontak.index') }}" class="nav-link {{ request()->routeIs('admin.kontak*') ? 'active' : '' }}">
                <div class="nav-icon"><i class="fas fa-address-book"></i></div>
                <span class="nav-label">Kontak</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.media.index') }}" class="nav-link {{ request()->routeIs('admin.media*') ? 'active' : '' }}">
                <div class="nav-icon"><i class="fas fa-photo-video"></i></div>
                <span class="nav-label">Media Manager</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                <div class="nav-icon"><i class="fas fa-cog"></i></div>
                <span class="nav-label">Pengaturan</span>
            </a>
        </div>
    </nav>

    {{-- Sidebar Footer --}}
    <div class="sidebar-footer">
        <form method="POST" action="{{ route('admin.logout') }}" id="logout-form">
            @csrf
        </form>
        <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class="nav-icon"><i class="fas fa-sign-out-alt"></i></div>
            <span class="nav-label">Keluar</span>
        </a>
    </div>
</aside>
