<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Mini Market</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

  <div class="container py-3 d-flex justify-content-between align-items-center">
    <h2 class="h4 m-0">Mini Market</h2>
    <a href="{{ route('cart.index') }}" class="btn btn-outline-primary">
      Cart ({{ \App\Models\CartItem::sum('quantity') }})
    </a>
  </div>

  <div class="container py-4">

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @yield('content')

  </div>
</body>
</html>
