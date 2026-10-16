<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request){
        $categories = Category::latest()->get();
        
        $search = $request->query('q');
        $categories = Category::query()
            ->when($search, function ($query, $search){
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(5)
            ->WithQueryString();
        return view('categories.index',
        compact('categories', 'search'));
    }

    public function create(){
        return view('categories.create');
    }

    public function store(Request $request){
    $validated = $request->validate([
        'name' => 'required|string|max:100',
        'description' => 'nullable|string|max:500'
    ]);

    Category::create($validated);

    return redirect()
        ->route('categories.index')
        ->with('success', 'Kategori berhasil disimpan');
        

    }

    public function show(string $category){
        $item = Category::findOrFail($category);

        return view('categories.show', [
            'category' => $item,
        ]);
    }

    public function edit(string $category){
        $item = Category::findOrFail($category);

        return view('categories.edit', [
            'category' => $item,
        ]);
    }

    public function update(Request $request, string $category){
        $category = Category::findorFail($category);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description'=>'nullable|string|max:500'
        ]);

        $category->update($validated);

        return redirect()
        ->route('categories.index')
        ->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(string $category){

        $category = Category::findorFail($category);
        $category->delete();

        return redirect()
        ->route('categories.index')
        ->with('success', 'Kategori berhasil dihapus');
    }

}


