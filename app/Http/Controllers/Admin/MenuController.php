<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;
use App\Models\Menu;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::with('parent');

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        $items = $query->orderBy('type')->orderBy('parent_id')->orderBy('order')->paginate(15)->withQueryString();
        
        return view('admin.menus.index', compact('items'));
    }

    public function create()
    {
        $parents = Menu::whereNull('parent_id')->orderBy('title')->get();
        return view('admin.menus.create', compact('parents'));
    }

    public function store(MenuRequest $request)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        $menu = Menu::create($validated);
        
        ActivityLogger::log('created', 'Menu', 'Membuat menu: ' . $menu->title);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        $parents = Menu::whereNull('parent_id')->where('id', '!=', $menu->id)->orderBy('title')->get();
        return view('admin.menus.edit', ['item' => $menu, 'parents' => $parents]);
    }

    public function update(MenuRequest $request, Menu $menu)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        $menu->update($validated);
        
        ActivityLogger::log('updated', 'Menu', 'Memperbarui menu: ' . $menu->title);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        $title = $menu->title;
        $menu->delete(); 
        
        ActivityLogger::log('deleted', 'Menu', 'Menghapus menu: ' . $title);
        
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}
