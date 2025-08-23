@extends('layout')

@section('content')
  <h1 class="h3 mb-4">Edit Product</h1>

  <form method="post" action="{{ route('products.update',$product) }}" class="card p-4 shadow-sm">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" value="{{ old('name',$product->name) }}" class="form-control">
      @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label class="form-label">SKU</label>
      <input type="text" name="sku" value="{{ old('sku',$product->sku) }}" class="form-control">
      @error('sku')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Price</label>
        <input type="number" step="0.01" name="price" value="{{ old('price',$product->price) }}" class="form-control">
        @error('price')<div class="text-danger small">{{ $message }}</div>@enderror
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" value="{{ old('stock',$product->stock) }}" class="form-control">
        @error('stock')<div class="text-danger small">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Category</label>
      <input type="text" name="category" value="{{ old('category',$product->category) }}" class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" rows="4" class="form-control">{{ old('description',$product->description) }}</textarea>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
  </form>
@endsection
