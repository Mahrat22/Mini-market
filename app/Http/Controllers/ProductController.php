<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $q        = $request->input('q');
        $category = $request->input('category');
        $sort     = $request->input('sort', 'name');
        $dir      = $request->input('dir', 'asc');

        $validSorts = ['name','price','stock','created_at'];
        if (!in_array($sort, $validSorts)) $sort = 'name';
        $dir = $dir === 'desc' ? 'desc' : 'asc';

        $products = Product::query()
            ->when($q, fn($query) =>
                $query->where(fn($x) =>
                    $x->where('name','like',"%$q%")
                      ->orWhere('sku','like',"%$q%")
                )
            )
            ->when($category, fn($query) => $query->where('category', $category))
            ->orderBy($sort, $dir)
            ->paginate(10)
            ->withQueryString();

        $categories = Product::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        return view('products.index', compact('products','q','category','categories','sort','dir'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required','string','max:255'],
            'sku'         => ['required','string','max:255','unique:products,sku'],
            'description' => ['nullable','string'],
            'price'       => ['required','numeric','min:0'],
            'stock'       => ['required','integer','min:0'],
            'category'    => ['nullable','string','max:255'],
        ]);

        Product::create($data);
        return redirect()->route('products.index')->with('ok','Product created.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => ['required','string','max:255'],
            'sku'         => ['required','string','max:255', Rule::unique('products','sku')->ignore($product->id)],
            'description' => ['nullable','string'],
            'price'       => ['required','numeric','min:0'],
            'stock'       => ['required','integer','min:0'],
            'category'    => ['nullable','string','max:255'],
        ]);

        $product->update($data);
        return redirect()->route('products.index')->with('ok','Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('ok','Product deleted.');
    }
}
