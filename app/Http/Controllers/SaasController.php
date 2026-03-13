<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaasProduct;
use App\Models\SaasReview;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SaasController extends Controller
{
    // HAPUS CONSTRUCTOR & ARRAY $this->apps LAMA

    public function index()
    {
        // Murni ambil dari Database
        $apps = SaasProduct::with('user')
            ->where('status', 'approved')
            ->latest()
            ->get()
            ->map(function ($app) {
                return (object) [
                    'name' => $app->name,
                    'slug' => $app->slug,
                    'category' => $app->category,
                    'description' => $app->tagline ?? Str::limit($app->description, 80),
                    'price' => $app->price,
                    // Rating dummy karena belum ada review real (bisa diupdate nanti)
                    'rating' => 5.0, 
                    'reviews_count' => SaasReview::where('saas_slug', $app->slug)->count(),
                    'subscribers' => 'New',
                    // Gunakan gambar asset lokal jika ada, atau placeholder
                    'thumbnail_url' => asset($app->thumbnail ?? 'assets/img/placeholder.jpg'),
                    
                    'partner_name' => 'FutureCloud Official',
                    'partner_verified' => true,
                ];
            });

        return view('saas-detail', compact('apps'));
    }

    public function show($slug)
    {
        $slug = strtolower($slug);
        
        $dbApp = \App\Models\SaasProduct::with('user')->where('slug', $slug)->where('status', 'approved')->firstOrFail();

        // --- LOGIKA PEMISAHAN DESKRIPSI & FITUR (FIXED) ---
        $rawLines = explode("\n", str_replace("\r", "", $dbApp->description));
        
        $cleanFeatures = [];
        $cleanDescriptionLines = [];

        foreach($rawLines as $line) {
            $trimmed = trim($line);

            // 1. Jika baris dimulai dengan strip (-), jadikan Fitur
            if (str_starts_with($trimmed, '-')) {
                $cleanFeatures[] = trim(substr($trimmed, 1));
            } 
            // 2. Jika baris berisi kata "Fitur Utama", abaikan (Hapus judulnya)
            elseif (stripos($trimmed, 'Fitur Utama') !== false) {
                continue; 
            }
            // 3. Sisanya adalah Deskripsi murni
            else {
                $cleanDescriptionLines[] = $line;
            }
        }

        // Gabungkan kembali baris deskripsi menjadi satu string
        $finalDescription = trim(implode("\n", $cleanDescriptionLines));
        // ----------------------------------------------------

        $app = (object) [
            'name' => $dbApp->name,
            'slug' => $dbApp->slug,
            'tag' => $dbApp->category,
            'short_desc' => $dbApp->tagline,
            
            // GUNAKAN DESKRIPSI YANG SUDAH DIBERSIHKAN
            'description' => $finalDescription,
            
            'rating' => 5.0, 
            'reviews_count' => SaasReview::where('saas_slug', $slug)->count(),
            'subscribers' => '100+',
            'img_hero' => $dbApp->thumbnail ?? 'assets/img/placeholder.jpg',
            'price' => $dbApp->price,
            
            // GUNAKAN ARRAY FITUR
            'features' => $cleanFeatures, 
            
            'reviews' => [],
            'plans' => json_decode(json_encode($dbApp->plans)),
            'partner_name' => $dbApp->user->company_name ?? $dbApp->user->name,
            'is_official' => ($dbApp->user->role === 'admin' || $dbApp->user->id === 1)
        ];

        $realReviews = SaasReview::with('user')->where('saas_slug', $slug)->latest()->get();

        return view('saas.show', compact('app', 'realReviews', 'slug'));
    }

    public function storeReview(Request $request, $slug)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        SaasReview::create([
            'user_id' => Auth::id(),
            'saas_slug' => $slug,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Ulasan berhasil dikirim!');
    }
}