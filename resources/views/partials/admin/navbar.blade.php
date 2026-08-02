{{-- Admin Top Navbar — Light Modern --}}
<header class="admin-navbar">
    {{-- Left --}}
    <div class="navbar-left">
        <button type="button" class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
    </div>

    {{-- Right --}}
    <div class="navbar-right">
        {{-- Search --}}
        <form action="{{ route('admin.search') }}" method="GET" class="search-wrap d-none d-md-block">
            <i class="fas fa-search search-icon"></i>
            <input type="text" name="q" placeholder="Cari di seluruh CMS...">
        </form>

        {{-- Visit site --}}
        <a href="{{ route('home') }}" target="_blank" class="nav-action-btn" title="Lihat Website">
            <i class="fas fa-external-link-alt"></i>
        </a>

        {{-- Notifications --}}
        <div class="dropdown">
            <a class="nav-action-btn position-relative text-decoration-none" href="#" role="button"
               id="notifDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bell"></i>
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                          style="font-size:0.6rem;">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notifDropdown" style="width:300px;max-height:380px;overflow-y:auto;">
                <div style="padding:0.75rem 1rem;font-size:0.8rem;font-weight:700;color:#0F172A;border-bottom:1px solid #E2E8F0;display:flex;justify-content:space-between;align-items:center;">
                    <span>Notifikasi</span>
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <form action="{{ route('admin.notifications.markAllRead') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link btn-sm text-decoration-none p-0" style="font-size:0.75rem;color:#2563EB;font-weight:600;">Tandai dibaca</button>
                        </form>
                    @endif
                </div>
                @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                    <a href="{{ route('admin.notifications.markRead', $notification->id) }}" class="dropdown-item py-3">
                        <div style="font-weight:700;font-size:0.82rem;color:#0F172A;">{{ $notification->data['title'] ?? 'Info' }}</div>
                        <div style="font-size:0.75rem;color:#64748B;margin-top:2px;">{{ $notification->data['message'] ?? '' }}</div>
                        <div style="font-size:0.72rem;color:#94A3B8;margin-top:4px;">{{ $notification->created_at->diffForHumans() }}</div>
                    </a>
                @empty
                    <div style="text-align:center;padding:1.5rem;color:#94A3B8;font-size:0.83rem;">Belum ada notifikasi.</div>
                @endforelse
            </div>
        </div>

        {{-- Profile --}}
        <div class="dropdown">
            <a href="#" class="admin-profile" data-bs-toggle="dropdown" aria-expanded="false">
                @if(auth()->user()->avatar)
                    <img src="{{ asset('storage/'.auth()->user()->avatar) }}" alt="Avatar"
                         class="rounded object-fit-cover" width="34" height="34" style="border-radius:8px;">
                @else
                    <div class="avatar-circle">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
                <div class="d-none d-md-block">
                    <div class="profile-name">{{ auth()->user()->name }}</div>
                    <div class="profile-role">{{ auth()->user()->role ?? 'Administrator' }}</div>
                </div>
                <i class="fas fa-chevron-down d-none d-md-inline" style="font-size:0.65rem;color:#94A3B8;"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" style="min-width:190px;">
                <li>
                    <a class="dropdown-item" href="{{ route('admin.profile.index') }}">
                        <i class="fas fa-user-circle me-2" style="color:#64748B;width:16px;"></i> Profil Saya
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.settings.index') }}">
                        <i class="fas fa-cog me-2" style="color:#64748B;width:16px;"></i> Pengaturan
                    </a>
                </li>
                <li><hr class="dropdown-divider my-1" style="border-color:#E2E8F0;"></li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt me-2" style="width:16px;"></i> Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
