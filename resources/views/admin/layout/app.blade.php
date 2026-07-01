<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="adminHMD professional admin dashboard template">
  <title>Dashboard | adminHMD</title>

  <link rel="stylesheet" href=" {{ asset('admin_assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href=" {{ asset('admin_assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href=" {{ asset('admin_assets/css/style.css') }}">
</head>
<body>
  <div class="admin-shell">
    @include('admin.partials.sidebar')
    
    <div class="admin-main">
      @include('admin.partials.header')
      
      <main class="dashboard-content">
        @yield('content')
      </main>
      
      @include('admin.partials.footer')
    </div>
  </div>

  <script src="{{ asset('admin_assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin_assets/js/main.js') }}"></script>
</body>
</html>