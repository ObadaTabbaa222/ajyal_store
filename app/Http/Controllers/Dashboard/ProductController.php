<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request();
        $products = Product::with(['store', 'category'])
            ->filter($request->query())
            ->orderby('products.name')
            ->paginate();
        //SELECT * FROM products
        //SELECT * FROM stores WHERE id IN (..)
        //SELECT * FROM categories WHERE id IN (..)
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $parents = Category::all();
        $product = new Product();
        return view('dashboard.products.create', ['product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $request->merge([
            'slug' => Str::slug($request->name),
        ]);

        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);

        $product = Product::create($data);
        return redirect()->route('dashboard.products.index')
            ->with('success', 'Product Created!.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $tags = implode(',', $product->tags()->pluck('name')->toArray());
        return view('dashboard.products.edit', compact('product', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->except('tags'));
        $tags = explode(',', $request->tags);
        $saved_tags = Tag::all();
        $tags_ids = [];
        foreach ($tags as $t_name) {
            $slug = Str::slug($t_name);
            $tag = $saved_tags->where('slug', $slug)->first();
            if (!$tag) {
                $tag = Tag::create([
                    'name' => $t_name,
                    'slug' => $slug
                ]);
            }
            $tags_ids[] = $tag->id;
        }

        $product->tags()->sync($tags_ids);

        return redirect()->route('dashboard.products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $pro = Product::findOrFail($product->id);
        $pro->delete();

        return redirect()->route('dashboard.products.index')
            ->with('success', 'Product Deleted!.');
    }

    protected function uploadImage($request)
    {
        if (!$request->hasFile('image')) {
            return;
        }

        $file = $request->file('image');
        $path = $file->store('uploads', ['disk' => 'public']);
        return $path;
    }

}
