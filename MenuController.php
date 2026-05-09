<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::with(['menus' => function($q) {
            $q->where('is_available', true)->where('stock', '>', 0);
        }])->get();

        return view('menus.index', compact('categories'));
    }

    // --- ADMIN ---
    public function adminIndex()
    {
        $menus = Menu::with('category')->latest()->paginate(10);
        $categories = Category::all();
        return view('admin.menus.index', compact('menus', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'is_available' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('menus', 'public');
        }

        Menu::create($validated);

        return back()->with('success', 'Menu berhasil ditambahkan!');
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'is_available' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($menu->image) {
                \Storage::disk('public')->delete($menu->image);
            }
            $validated['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($validated);

        return back()->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->image) {
            \Storage::disk('public')->delete($menu->image);
        }
        $menu->delete();
        return back()->with('success', 'Menu berhasil dihapus!');
    }
}