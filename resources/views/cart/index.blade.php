@extends('layout')

@section('content')
  <h1 class="h3 mb-4">Shopping Cart</h1>

  @if($items->isEmpty())
    <div class="alert alert-info">Your cart is empty.</div>
    <a href="{{ route('products.index') }}" class="btn btn-primary">Go to Products</a>
  @else
    <form method="post" action="{{ route('cart.clear') }}" class="mb-3">
      @csrf
      <button class="btn btn-outline-danger">Clear Cart</button>
    </form>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($items as $item)
          <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ number_format($item->product->price,2) }} ₺</td>
            <td>
              <form action="{{ route('cart.update', $item) }}" method="post" class="d-flex">
                @csrf
                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm me-2" style="width:80px">
                <button class="btn btn-sm btn-primary">Update</button>
              </form>
            </td>
            <td>{{ number_format($item->product->price * $item->quantity,2) }} ₺</td>
            <td>
              <form action="{{ route('cart.remove', $item) }}" method="post">
                @csrf
                <button class="btn btn-sm btn-danger">Remove</button>
              </form>
            </td>
          </tr>
        @endforeach
        <tr>
          <td colspan="3" class="text-end fw-bold">Grand Total</td>
          <td colspan="2" class="fw-bold">{{ number_format($grandTotal,2) }} ₺</td>
        </tr>
      </tbody>
    </table>
  @endif
@endsection
