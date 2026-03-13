<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroSetting;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function index()
    {
        $hero = HeroSetting::firstOrNew();
        
        // Setup default jika kosong
        if (empty($hero->background_images)) {
            $hero->background_images = ['assets/bg.jpg'];
            $hero->save();
        }

        return view('admin.hero.index', compact('hero'));
    }

    public function updateText(Request $request)
    {
        $request->validate([
            'tagline' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string',
        ]);

        $hero = HeroSetting::firstOrCreate([]);
        $hero->update([
            'tagline' => $request->tagline,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
        ]);

        return back()->with('success', 'Konten teks berhasil diperbarui!');
    }

    public function addImage(Request $request)
    {
        // Validasi File Gambar (Max 5MB)
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $hero = HeroSetting::firstOrCreate([]);
        $currentImages = $hero->background_images ?? [];

        if (empty($currentImages)) {
            $currentImages = ['assets/bg.jpg'];
        }

        if ($request->hasFile('image')) {
            // Upload file ke storage/app/public/hero
            $path = $request->file('image')->store('hero', 'public');

            // Tambahkan ke database
            $currentImages[] = $path;
            
            $hero->background_images = $currentImages;
            $hero->save();

            return back()->with('success', 'Gambar berhasil diupload!');
        }

        return back()->with('error', 'Gagal mengupload gambar.');
    }

    public function destroyImage(Request $request)
    {
        $imagePath = $request->image_path;
        
        if ($imagePath === 'assets/bg.jpg') {
            return back()->with('error', 'Gambar Default System tidak boleh dihapus.');
        }

        $hero = HeroSetting::first();
        
        if (!$hero || empty($hero->background_images)) {
            return back()->with('error', 'Data tidak ditemukan.');
        }

        $currentImages = $hero->background_images;
        $key = array_search($imagePath, $currentImages);

        if ($key !== false) {
            // Hapus file dari storage jika bukan aset bawaan
            if (!str_starts_with($imagePath, 'assets/')) {
                if(Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
            
            unset($currentImages[$key]);
            
            // Re-index array
            $hero->background_images = array_values($currentImages);
            $hero->save();
            
            return back()->with('success', 'Gambar berhasil dihapus.');
        }

        return back()->with('error', 'Gambar tidak ditemukan.');
    }

    public function reorderImage(Request $request)
    {
        $imagePath = $request->image_path;
        $direction = $request->direction;

        $hero = HeroSetting::first();
        $images = $hero->background_images;
        
        $index = array_search($imagePath, $images);

        if ($index === false) return back();

        // Swap Logic
        if ($direction === 'up' && $index > 0) {
            $temp = $images[$index - 1];
            $images[$index - 1] = $images[$index];
            $images[$index] = $temp;
        } elseif ($direction === 'down' && $index < count($images) - 1) {
            $temp = $images[$index + 1];
            $images[$index + 1] = $images[$index];
            $images[$index] = $temp;
        }

        $hero->background_images = $images;
        $hero->save();

        return back()->with('success', 'Urutan slider diperbarui.');
    }
}