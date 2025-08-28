@extends('layout')

@section('content')
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-start mb-3">
        <h1 class="h4">{{ $product->name }}</h1>
        <div class="text-end">
          <a href="{{ route('products.edit',$product) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
          <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">Back</a>
        </div>
      </div>

      <dl class="row">
        <dt class="col-sm-3 text-muted">SKU</dt>
        <dd class="col-sm-9 fw-semibold">{{ $product->sku }}</dd>

        <dt class="col-sm-3 text-muted">Price</dt>
        <dd class="col-sm-9 fw-bold text-success">{{ number_format($product->price,2) }} ₺</dd>

        <dt class="col-sm-3 text-muted">Stock</dt>
        <dd class="col-sm-9">
          @php $low = $product->stock < 5; @endphp
          <span class="badge {{ $low ? 'bg-danger' : 'bg-success' }}">
            {{ $product->stock }} {{ $low ? ' Low' : '' }}
          </span>
        </dd>

        <dt class="col-sm-3 text-muted">Category</dt>
        <dd class="col-sm-9">
          @if($product->category)
            <span class="badge bg-primary">{{ $product->category }}</span>
          @else
            <span class="text-muted">—</span>
          @endif
        </dd>

        <dt class="col-sm-3 text-muted">Description</dt>
        <dd class="col-sm-9">{{ $product->description ?: '—' }}</dd>
      </dl>

      <form method="post" action="{{ route('cart.add', $product) }}">
        @csrf
        <button class="btn btn-success mt-3">Add to Cart</button>
      </form>
    </div>
  </div>
@endsection
