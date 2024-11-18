<?php

namespace App\Http\Controllers\Dashboard;



use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request();

        $categories = Category::with('parent')
        // leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
        // ->select([
        //     'categories.*',
        //     'parents.name as parent_name'
        // ])
        // ->select('categories.*')
        // ->selectRaw('(SELECT COUNT(*) FROM products WHERE category_id = categories.id) as products_count')
        ->WithCount([
            'products' => function($query) {
                $query->where('status', '=', 'active');
            }])
        ->filter($request->query())
        ->orderby('categories.name')
        ->paginate();
        
        return view('dashboard.categories.index', compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        $cat = new Category();
        return view('dashboard.categories.create', compact("parents","cat"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $request->merge([
            'slug' => Str::slug($request->name),
        ]);

        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);

        $category = Category::create($data);
        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Category Created!.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $products = $category->products()->paginate(5);
        return view('dashboard.categories.show', [
            'category' => $category,
            'products' => $products
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $cat = Category::find($category->id);
        // dd($cat->id);
        $parents = Category::where('id', '<>', $cat->id)
            ->where(function ($query) use ($cat) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $cat->id);
            })->get();
        return view('dashboard.categories.edit', compact('cat', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $cat = Category::find($category->id);
        $old_image = $cat->image;

        $data = $request->except('image');
        $new_image = $this->uploadImage($request);
        if($new_image) {
            $data['image'] = $new_image;
        }

        $cat->update($data);

        if($old_image && $new_image) {
            Storage::disk('uploads')->delete($old_image);
        }

        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Category Updated!.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $cat = Category::findOrFail($category->id);
        $cat->delete();

        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Category Deleted!.');
    }

    protected function uploadImage($request)
    {
        if(!$request->hasFile('image')){
            return;
        }

        $file = $request->file('image');
        $path = $file->store('uploads', ['disk'=> 'public']);
        return $path;
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate(5);
        return view('dashboard.categories.trash', compact(['categories']));
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('dashboard.categories.trash')
            ->with('success', 'Category Restored!.');
    }

    public function forceDelete($id)
    {
        $categories = Category::findOrFail($id);
        $categories->forceDelete();
        if($categories->image) {
            Storage::disk('public')->delete($categories->image);
        }
        return redirect()->route('dashboard.categories.trash')
            ->with('success', 'Category Deleted Forever!.');
    }
}
