<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Mini Market</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap JS (for modal, dropdowns, etc.) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
  <div class="container py-4">
    @if(session('ok'))
      <div class="alert alert-success">{{ session('ok') }}</div>
    @endif
    @yield('content')
  </div>
</body>
</html>
