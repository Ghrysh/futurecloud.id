<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->paginate(10);
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required',
        ]);

        $imagePath = $request->file('image')->store('portfolios', 'public');

        Portfolio::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category' => $request->category,
            'url' => $request->url,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio berhasil ditambahkan');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if($portfolio->image) Storage::disk('public')->delete($portfolio->image);
            $data['image'] = $request->file('image')->store('portfolios', 'public');
        }

        $portfolio->update($data);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio berhasil diupdate');
    }

    public function destroy(Portfolio $portfolio)
    {
        if($portfolio->image) Storage::disk('public')->delete($portfolio->image);
        $portfolio->delete();
        return redirect()->back()->with('success', 'Portfolio dihapus');
    }
}