<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">

    <title>@yield('title', 'Dashboard') — Admin FT UNSUR</title>

    {{-- Google Fonts: Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    {{-- Vite CSS --}}
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])

    {{-- Additional Styles --}}
    @stack('styles')
</head>
<body>
    <div class="admin-wrapper">
        {{-- Sidebar --}}
        @include('partials.admin.sidebar')

        {{-- Sidebar Overlay (Mobile) --}}
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        {{-- Main Content Area --}}
        <div class="admin-content" id="adminContent">
            {{-- Top Navbar --}}
            @include('partials.admin.navbar')

            {{-- Page Content --}}
            <div class="admin-main">
                {{-- Breadcrumb --}}
                @hasSection('breadcrumb')


                    <div class="admin-breadcrumb">
                        @yield('breadcrumb')
                    </div>
                @endif

                {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Main Content --}}
                @yield('content')
            </div>
        </div>
    </div>

    {{-- Additional Scripts --}}
    @stack('scripts')
    
    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if(document.querySelector('.tinymce-editor')) {
                tinymce.init({
                    selector: '.tinymce-editor',
                    height: 400,
                    menubar: false,
                    plugins: [
                        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                        'insertdatetime', 'media', 'table', 'help', 'wordcount'
                    ],
                    toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                    content_style: 'body { font-family:Poppins,Helvetica,Arial,sans-serif; font-size:16px }',
                    promotion: false,
                    branding: false
                });
            }
        });
    </script>
</body>
</html>
