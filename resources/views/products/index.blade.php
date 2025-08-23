@extends('layout')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Products</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">+ New Product</a>
  </div>

  <form method="get" action="{{ route('products.index') }}" class="row g-2 mb-3">
    <div class="col-md-3">
      <input type="text" name="q" class="form-control" value="{{ $q }}" placeholder="Search name or SKU">
    </div>
    <div class="col-md-2">
      <select name="category" class="form-select">
        <option value="">All categories</option>
        @foreach($categories as $c)
          <option value="{{ $c }}" @selected($category===$c)>{{ $c }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-2">
      <select name="sort" class="form-select">
        @foreach(['name'=>'Name','price'=>'Price','stock'=>'Stock','created_at'=>'Created'] as $k=>$label)
          <option value="{{ $k }}" @selected($sort===$k)>{{ $label }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-2">
      <select name="dir" class="form-select">
        <option value="asc"  @selected($dir==='asc')>Asc</option>
        <option value="desc" @selected($dir==='desc')>Desc</option>
      </select>
    </div>
    <div class="col-md-3 d-flex gap-2">
      <button class="btn btn-dark">Apply</button>
      <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-counterclockwise"></i> Reset
      </a>
    </div>
  </form>

  <div class="card shadow-sm">
    <div class="card-body p-0">
      <table class="table table-hover mb-0">
        <thead class="table-light">
          <tr>
            <th>
              <a href="{{ route('products.index', request()->except('page') + ['sort'=>'name','dir'=>$dir==='asc'?'desc':'asc']) }}" class="text-decoration-none">
                Name {!! $sort==='name' ? ($dir==='asc'?'↑':'↓') : '' !!}
              </a>
            </th>
            <th>SKU</th>
            <th>
              <a href="{{ route('products.index', request()->except('page') + ['sort'=>'price','dir'=>$dir==='asc'?'desc':'asc']) }}" class="text-decoration-none">
                Price {!! $sort==='price' ? ($dir==='asc'?'↑':'↓') : '' !!}
              </a>
            </th>
            <th>
              <a href="{{ route('products.index', request()->except('page') + ['sort'=>'stock','dir'=>$dir==='asc'?'desc':'asc']) }}" class="text-decoration-none">
                Stock {!! $sort==='stock' ? ($dir==='asc'?'↑':'↓') : '' !!}
              </a>
            </th>
            <th>Category</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($products as $p)
            <tr>
              <td>
                <a href="{{ route('products.show',$p) }}" class="fw-semibold">{{ $p->name }}</a>
              </td>
              <td>{{ $p->sku }}</td>
              <td class="fw-bold text-success">{{ number_format($p->price,2) }} ₺</td>
              <td>
                @php $low = $p->stock < 5; @endphp
                <span class="badge {{ $low ? 'bg-danger' : 'bg-success' }}">
                  {{ $p->stock }} {{ $low ? ' Low' : '' }}
                </span>
              </td>
              <td>
                @if($p->category)
                  <span class="badge bg-primary">{{ $p->category }}</span>
                @else
                  <span class="text-muted">—</span>
                @endif
              </td>
              <td class="text-end">
                <a href="{{ route('products.edit',$p) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                <form action="{{ route('products.destroy',$p) }}" method="post" class="d-inline">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center py-5">
                <div class="text-muted mb-2">No products found.</div>
                <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">+ Add your first product</a>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="mt-3">
    {{ $products->links() }}
  </div>
@endsection
