<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Authentication') - Admin Panel FT UNSUR</title>

    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])

    <style>
        body {
            background-color: #ffffff; /* White background */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .auth-card {
            width: 100%;
            max-width: 450px;
            border: 1px solid rgba(0, 212, 255, 0.4);
            border-radius: var(--bs-border-radius-lg);
            background: linear-gradient(135deg, #001253, #00d4ff); /* Electric blue gradient */
            box-shadow: 0 0 25px rgba(0, 212, 255, 0.5), inset 0 0 15px rgba(255, 255, 255, 0.2);
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }
        .auth-header {
            text-align: center;
            padding: 2rem 2rem 1rem;
            position: relative;
            z-index: 2;
        }
        .auth-logo {
            width: 80px;
            height: auto;
            margin-bottom: 1rem;
            filter: drop-shadow(0px 4px 6px rgba(0,0,0,0.3));
        }
        .auth-title {
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.4);
        }
        .auth-subtitle {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.875rem;
        }
        .auth-body {
            padding: 1.5rem 2rem 2rem;
            position: relative;
            z-index: 2;
        }
        
        /* Gear Animations */
        .gear {
            position: absolute;
            color: rgba(255, 255, 255, 0.15);
            animation: spin linear infinite;
            z-index: 1;
        }
        .gear-1 {
            font-size: 160px;
            top: -40px;
            right: -60px;
            animation-duration: 12s;
        }
        .gear-2 {
            font-size: 100px;
            bottom: -20px;
            left: -30px;
            animation-duration: 8s;
            animation-direction: reverse;
        }
        .gear-3 {
            font-size: 60px;
            top: 40px;
            right: 80px;
            animation-duration: 6s;
            animation-direction: reverse;
        }

        @keyframes spin {
            100% { transform: rotate(360deg); }
        }

        /* Form styling adjustments for dark background */
        .form-label {
            color: #ffffff;
            font-weight: 500;
        }
        .input-group-text {
            background-color: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff !important;
        }
        .input-group-text i {
            color: #ffffff !important;
        }
        .form-control {
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(0, 212, 255, 0.5);
            border-color: #00d4ff;
        }
        .form-check-label {
            color: rgba(255, 255, 255, 0.85) !important;
        }
        
        /* Button adjustments */
        .btn-primary {
            background-color: #0f172a;
            border-color: #0f172a;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #1e293b;
            border-color: #1e293b;
            box-shadow: 0 0 15px rgba(0, 212, 255, 0.8);
            transform: translateY(-2px);
        }
        
        .auth-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .auth-link:hover {
            color: #ffffff;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <main class="container">
        <div class="row justify-content-center">
            <div class="col-12 d-flex justify-content-center">
                @yield('content')
            </div>
        </div>
    </main>

</body>
</html>
