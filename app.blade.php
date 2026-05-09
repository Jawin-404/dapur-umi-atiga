<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Dapur Umi Atiga') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --primary: #8B4513;
            --primary-dark: #6B3410;
            --primary-light: #A0522D;
            --secondary: #D2691E;
            --accent: #228B22;
            --bg: #FFF8F0;
            --card-bg: #FFFFFF;
            --text: #2D1810;
            --text-light: #6B5B4F;
            --border: #E8D5C4;
            --success: #228B22;
            --warning: #DAA520;
            --danger: #DC3545;
            --info: #17A2B8;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg);
            color: var(--text);
            line-height: 1.6;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 15px rgba(139, 69, 19, 0.3);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-brand span { color: #FFD700; }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .nav-links .btn-logout {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .cart-badge {
            position: relative;
        }

        .cart-badge::after {
            content: attr(data-count);
            position: absolute;
            top: -8px;
            right: -8px;
            background: #FFD700;
            color: var(--primary-dark);
            font-size: 0.7rem;
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 50%;
            min-width: 18px;
            text-align: center;
        }

        /* Main Content */
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        /* Cards */
        .card {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(139, 69, 19, 0.08);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid var(--border);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(139, 69, 19, 0.15);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            padding: 1rem 1.5rem;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .card-body { padding: 1.5rem; }

        /* Menu Grid */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .menu-card {
            background: var(--card-bg);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            border: 1px solid var(--border);
            transition: all 0.3s;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(139, 69, 19, 0.15);
        }

        .menu-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .menu-card-placeholder {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #f5e6d3, #e8d5c4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
        }

        .menu-info { padding: 1rem; }

        .menu-info h3 {
            margin-bottom: 0.5rem;
            color: var(--primary);
        }

        .menu-info p {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .menu-price {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--secondary);
        }

        .menu-stock {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .menu-stock.out { color: var(--danger); }

        /* Forms */
        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.1);
        }

        textarea.form-control { min-height: 100px; resize: vertical; }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%238B4513' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.5rem;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #5a2a0d 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success), #1a6b1a);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger), #a71d2a);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning), #b8860b);
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-sm { padding: 0.5rem 1rem; font-size: 0.875rem; }

        /* Alerts */
        .alert {
            padding: 1rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Status Badge */
        .badge {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-confirmed { background: #d4edda; color: #155724; }
        .badge-rejected { background: #f8d7da; color: #721c24; }
        .badge-preparing { background: #cce5ff; color: #004085; }
        .badge-delivering { background: #e2e3ff; color: #383d7e; }
        .badge-completed { background: #d4edda; color: #155724; }

        /* Tables */
        .table-container {
            overflow-x: auto;
            border-radius: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        table th {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            font-weight: 600;
        }

        table tr:hover { background: #fdf5ee; }

        /* Quantity Input */
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .quantity-control input {
            width: 60px;
            text-align: center;
            padding: 0.5rem;
            border: 2px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            text-align: center;
            padding: 4rem 2rem;
            border-radius: 0 0 50px 50px;
            margin-bottom: 2rem;
        }

        .hero h1 { font-size: 2.5rem; margin-bottom: 1rem; }
        .hero p { font-size: 1.2rem; opacity: 0.9; max-width: 600px; margin: 0 auto 2rem; }

        /* Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--card-bg);
            padding: 1.5rem;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid var(--border);
        }

        .stat-card h3 {
            font-size: 2rem;
            color: var(--primary);
        }

        .stat-card p { color: var(--text-light); }

        /* Footer */
        .footer {
            background: var(--primary-dark);
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 3rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar { flex-direction: column; gap: 1rem; }
            .nav-links { flex-wrap: wrap; justify-content: center; }
            .hero h1 { font-size: 1.8rem; }
            .menu-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('home') }}" class="navbar-brand">
            🍳 <span>Dapur</span> Umi Atiga
        </a>
        <div class="nav-links">
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('menus.index') }}">Menu</a>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                @else
                    <a href="{{ route('cart.index') }}" class="cart-badge" data-count="{{ count(session('cart', [])) }}">
                        🛒 Keranjang
                    </a>
                    <a href="{{ route('orders.index') }}">Pesanan Saya</a>
                @endif
                <a href="{{ route('profile.edit') }}">Profil</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout" style="background: none; border: none; color: white; cursor: pointer; padding: 0.5rem 1rem; border-radius: 8px;">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Masuk</a>
                <a href="{{ route('register') }}">Daftar</a>
            @endauth
        </div>
    </nav>

    <main>
        @if(session('success'))
            <div class="container">
                <div class="alert alert-success">
                    ✅ {{ session('success') }}
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="container">
                <div class="alert alert-error">
                    ❌ {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} Dapur Umi Atiga. Lauk rumahan berkualitas, antar ke rumah Anda.</p>
    </footer>
</body>
</html>