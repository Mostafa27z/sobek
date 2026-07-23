<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - سوبك ترافيل</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    
    <!-- jQuery & Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        :root{
            --primary:#0077B6;
            --primary-dark:#005F8E;
            --primary-deeper:#004777;
            --secondary:#00B4D8;
            --accent:#27AE60;
            --sky-light:#E0F4FD;
            --sky-mid:#90E0EF;
            --dark:#0D0D0D;
            --light:#F0FAFF;
            --gray:#6B7280;
            --border:#BEE3F8;
            --success:#27AE60;
            --danger:#E74C3C;
            --shadow:0 10px 40px rgba(0,119,182,.08);
        }
        body{
            font-family:'Segoe UI',Tahoma,Arial,sans-serif;
            background-color:var(--light);
            color:var(--dark);
            display:flex;
            min-height:100vh;
        }
        
        /* Sidebar */
        aside {
            width: 260px;
            background: var(--primary);
            color: #fff;
            padding: 24px 0;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }
        .aside-header {
            padding: 0 24px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }
        .aside-header h2 {
            font-size: 20px;
            font-weight: 800;
            color: #fff;
        }
        .aside-header p {
            font-size: 11px;
            color: var(--secondary);
            margin-top: 4px;
        }
        .aside-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
        }
        .aside-menu a {
            display: block;
            padding: 12px 24px;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s ease;
            border-right: 4px solid transparent;
        }
        .aside-menu a:hover, .aside-menu a.active {
            background: rgba(255,255,255,0.08);
            color: #fff;
            border-right-color: var(--secondary);
        }
        
        /* Main Workspace */
        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }
        header.top-header {
            background: #fff;
            padding: 16px 30px;
            box-shadow: var(--shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .user-name {
            font-size: 14px;
            font-weight: 700;
            color: var(--primary);
        }
        .logout-btn {
            background: none;
            border: none;
            color: var(--danger);
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            text-decoration: underline;
        }
        
        .content-container {
            padding: 30px;
            flex: 1;
        }
        
        .card {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow);
            margin-bottom: 24px;
            border: 1px solid var(--border);
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border);
            padding-bottom: 12px;
        }
        .card-title {
            font-size: 18px;
            font-weight: 800;
            color: var(--primary);
        }
        
        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 12px 16px;
            text-align: right;
            border-bottom: 1px solid var(--border);
            font-size: 13px;
        }
        th {
            background: var(--light);
            color: var(--primary);
            font-weight: 700;
        }
        tr:hover td {
            background: rgba(0,119,182,0.02);
        }
        
        /* Alerts */
        .alert {
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 700;
        }
        .alert-success { background: #D1FAE5; color: #047857; border: 1px solid #A7F3D0; }
        .alert-danger { background: #FEE2E2; color: #991B1B; border: 1px solid #FCA5A5; }
        
        /* Buttons */
        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            text-align: center;
        }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-secondary { background: var(--secondary); color: #fff; }
        .btn-secondary:hover { background: var(--primary-dark); }
        .btn-accent { background: var(--accent); color: #fff; }
        .btn-accent:hover { background: #219653; }
        .btn-danger { background: var(--danger); color: #fff; }
        .btn-danger:hover { background: #c0392b; }
        .btn-sm { padding: 4px 10px; font-size: 11px; }

        /* Form elements */
        .form-group {
            margin-bottom: 18px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: 700;
            color: var(--primary);
        }
        input[type="text"], input[type="number"], input[type="date"], select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-family: inherit;
            font-size: 13px;
            background: #fff;
            color: var(--dark);
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0,119,182,0.1);
        }
        
        /* Select2 Custom Styles */
        .select2-container--default .select2-selection--single {
            border: 1px solid var(--border) !important;
            border-radius: 6px !important;
            height: 40px !important;
            padding: 5px 12px !important;
            background-color: #fff !important;
            transition: all 0.2s ease;
        }
        .select2-container--default.select2-container--open .select2-selection--single,
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px rgba(0, 119, 182, 0.15) !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: var(--dark) !important;
            line-height: 28px !important;
            padding-right: 4px !important;
            padding-left: 20px !important;
            font-size: 13px;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            display: block !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px !important;
            left: 8px !important;
            right: auto !important;
        }
        .select2-dropdown {
            border: 1px solid var(--border) !important;
            border-radius: 8px !important;
            box-shadow: 0 10px 25px rgba(0, 119, 182, 0.12) !important;
            z-index: 9999 !important;
            overflow: hidden;
            background: #fff !important;
        }
        .select2-search--dropdown {
            padding: 8px !important;
            background: #f8fafc;
            border-bottom: 1px solid var(--border);
        }
        .select2-search--dropdown .select2-search__field {
            border: 1px solid var(--border) !important;
            border-radius: 6px !important;
            padding: 6px 10px !important;
            font-size: 13px !important;
            outline: none !important;
        }
        .select2-search--dropdown .select2-search__field:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 2px rgba(0, 119, 182, 0.15) !important;
        }
        .select2-results__option {
            padding: 10px 14px !important;
            font-size: 13px !important;
            line-height: 1.5 !important;
            border-bottom: 1px dashed #f0f4f8;
            color: #334155 !important;
        }
        .select2-results__option:last-child {
            border-bottom: none;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: var(--primary) !important;
            color: #fff !important;
        }
        .select2-container--default .select2-results__option[aria-selected="true"] {
            background-color: var(--sky-light) !important;
            color: var(--primary-dark) !important;
            font-weight: bold;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
        }
        .checkbox-group input {
            width: 18px; height: 18px;
        }
        
        /* Badges */
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 700;
        }
        .badge-success { background: #D1FAE5; color: #047857; }
        .badge-warning { background: #FEF3C7; color: #92400E; }
        .badge-danger { background: #FEE2E2; color: #991B1B; }

        /* Pagination style */
        .pagination-container {
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
        .pagination-container nav {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            width: 100%;
        }
        .pagination-container nav > div:first-child {
            display: none !important; /* Hide mobile-only duplicate links */
        }
        .pagination-container nav > div:last-child {
            display: flex !important;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            width: 100%;
        }
        .pagination-container nav div span.relative {
            display: inline-flex;
            gap: 8px;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 8px;
        }
        /* Style all paginator links and active/inactive spans as neat buttons */
        .pagination-container a,
        .pagination-container span.relative > span,
        .pagination-container span.relative > a,
        .pagination-container [aria-current="page"] > span,
        .pagination-container [aria-current="page"] span,
        .pagination-container [aria-disabled="true"] > span,
        .pagination-container [aria-disabled="true"] span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            height: 38px;
            padding: 0 14px;
            font-size: 13px;
            font-weight: 700;
            color: var(--primary);
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .pagination-container a:hover,
        .pagination-container span.relative > a:hover {
            background: var(--light);
            border-color: var(--primary);
            color: var(--primary-dark);
            text-decoration: none;
        }
        /* Active Page Style */
        .pagination-container [aria-current="page"] > span,
        .pagination-container [aria-current="page"] span,
        .pagination-container span.bg-blue-50 {
            background: var(--primary) !important;
            color: #fff !important;
            border-color: var(--primary) !important;
            cursor: default;
        }
        /* Disabled Arrow Style */
        .pagination-container [aria-disabled="true"] > span,
        .pagination-container [aria-disabled="true"] span,
        .pagination-container .cursor-not-allowed {
            color: var(--gray) !important;
            background: #f9fafb !important;
            border-color: #e5e7eb !important;
            opacity: 0.6;
            cursor: not-allowed;
        }
        .pagination-container svg {
            width: 16px;
            height: 16px;
            display: inline-block;
            vertical-align: middle;
        }
        .pagination-container p {
            font-size: 13px;
            color: var(--gray);
            font-weight: 600;
            margin: 0;
        }

        /* Responsive form grid */
        .form-grid-2 {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }
        .form-grid-3 {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }
        .select2-container {
            width: 100% !important;
            max-width: 100% !important;
        }

        /* Mobile Responsive admin drawer & form grids */
        @media (max-width: 768px) {
            body { flex-direction: column; }
            aside { width: 100%; padding: 16px 0; }
            .aside-header { padding: 0 16px 12px; margin-bottom: 10px; }
            .aside-menu { flex-direction: row; flex-wrap: wrap; padding: 0 16px; gap: 8px; }
            .aside-menu a { padding: 8px 12px; border-right: none; border-bottom: 2px solid transparent; }
            .aside-menu a:hover, .aside-menu a.active { border-bottom-color: var(--secondary); border-right-color: transparent; }
            .content-container { padding: 15px; }
            table { display: block; overflow-x: auto; white-space: nowrap; }
            .form-grid-2, .form-grid-3 { grid-template-columns: 1fr; }
        }
    </style>
    @yield('styles')
</head>
<body>

<!-- SIDEBAR -->
<aside>
    <div class="aside-header">
        <h2>لوحة التحكم</h2>
        <p>سوبك ترافيل - SOBEK TRAVEL</p>
    </div>
    <ul class="aside-menu">
        <li><a href="{{ route('admin.tickets.index') }}" class="{{ Request::routeIs('admin.tickets.*') ? 'active' : '' }}">إدارة التذاكر</a></li>
        <li><a href="{{ route('admin.cities.index') }}" class="{{ Request::routeIs('admin.cities.*') ? 'active' : '' }}">إدارة المدن</a></li>
        <li><a href="{{ route('admin.inquiries.index') }}" class="{{ Request::routeIs('admin.inquiries.*') ? 'active' : '' }}">طلبات الحجز</a></li>
        <li><a href="{{ route('landing') }}" target="_blank">الموقع العام</a></li>
    </ul>
</aside>

<!-- MAIN CONTAINER -->
<main>
    <header class="top-header">
        <div class="user-profile">
            <span class="user-name">مرحباً، {{ Auth::user()->name ?? 'الأدمن' }}</span>
        </div>
        <div>
            <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">تسجيل الخروج</button>
            </form>
        </div>
    </header>

    <div class="content-container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="list-style: none;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</main>

<script>
    // Confirm deletes helper
    function confirmDelete(message) {
        return confirm(message || 'هل أنت متأكد من رغبتك في حذف هذا العنصر؟');
    }
</script>
@yield('scripts')
</body>
</html>
