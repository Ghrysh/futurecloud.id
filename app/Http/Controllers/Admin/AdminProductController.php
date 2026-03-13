<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductFeature;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->input('type', 'domain');
        $search = $request->input('search');

        $query = Product::where('type', $type);

        if ($search) {
            $query->where(function($q) use ($search) {
                $term = strtolower($search);
                // Pencarian case-insensitive untuk SQLite/PostgreSQL/MySQL
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$term}%"])
                  ->orWhereRaw('LOWER(slug) LIKE ?', ["%{$term}%"])
                  ->orWhereRaw('LOWER(category) LIKE ?', ["%{$term}%"]);
            });
        }

        // Sorting default
        if($type == 'domain') {
            $query->orderBy('name', 'asc');
        } else {
            $query->orderBy('price', 'asc');
        }

        $products = $query->paginate(20)->withQueryString();

        // AJAX Response untuk Search/Pagination tanpa reload
        if ($request->ajax()) {
            return view('admin.products.partials.table', compact('products', 'type'))->render();
        }

        return view('admin.products.index', compact('products', 'type'));
    }

    public function create()
    {
        return view('admin.products.create-edit');
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'type' => 'required|in:domain,hosting,vps,saas',
            'category' => 'nullable|string',
            'cycle' => 'nullable|string|in:mo,yr', // Bisa null jika tidak dipilih
            'price' => 'required|numeric|min:0',
            
            // Validasi Input Array/JSON
            'discount_config' => 'nullable|array',
            'features' => 'nullable|array',
            'tag' => 'nullable|string',
            
            // Input Khusus Domain (Opsional)
            'renew_price' => 'nullable|numeric',
            'transfer_price' => 'nullable|numeric',
        ]);

        // 2. Simpan Produk
        $product = Product::create($request->except(['features', '_token', '_method']));

        // 3. Simpan Fitur
        if ($request->has('features')) {
            foreach ($request->features as $featureText) {
                if (!empty($featureText)) {
                    ProductFeature::create([
                        'product_id' => $product->id,
                        'feature_text' => $featureText
                    ]);
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil disimpan!',
            'redirect' => route('admin.products.index', ['type' => $request->type])
        ]);
    }

    public function edit($id)
    {
        // Load features agar muncul di form edit
        $product = Product::with('features')->findOrFail($id);
        return view('admin.products.create-edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // 1. Validasi Update (Perhatikan unique slug)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $id, // Ignore ID saat ini
            'type' => 'required|in:domain,hosting,vps,saas',
            'category' => 'nullable|string',
            'cycle' => 'nullable|string|in:mo,yr',
            'price' => 'required|numeric|min:0',
            
            'discount_config' => 'nullable|array',
            'features' => 'nullable|array',
            'tag' => 'nullable|string',
            
            'renew_price' => 'nullable|numeric',
            'transfer_price' => 'nullable|numeric',
        ]);

        // 2. Update Produk
        $product->update($request->except(['features', '_token', '_method']));

        // 3. Update Fitur (Hapus Semua Lama -> Insert Baru)
        $product->features()->delete();
        
        if ($request->has('features')) {
            foreach ($request->features as $featureText) {
                if (!empty($featureText)) {
                    ProductFeature::create([
                        'product_id' => $product->id,
                        'feature_text' => $featureText
                    ]);
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Perubahan berhasil disimpan!',
            'redirect' => route('admin.products.index', ['type' => $request->type])
        ]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Fitur akan terhapus otomatis jika di migration ada ->onDelete('cascade')
        // Jika tidak, hapus manual: $product->features()->delete();
        
        $product->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil dihapus.'
        ]);
    }
}