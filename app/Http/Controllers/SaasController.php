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
        $allApproved = SaasProduct::with('user')
            ->where('status', 'approved')
            ->latest()
            ->get();

        $mapProduct = function ($app) {
            return (object) [
                'name' => $app->name,
                'slug' => $app->slug,
                'category' => $app->category,
                'description' => $app->tagline ?? Str::limit($app->description, 80),
                'price' => $app->price,
                'rating' => 5.0, 
                'reviews_count' => SaasReview::where('saas_slug', $app->slug)->count(),
                'subscribers' => 'New',
                'thumbnail_url' => asset($app->thumbnail ?? 'assets/img/placeholder.jpg'),
                'partner_name' => 'FutureCloud Official',
                'partner_verified' => true,
                'cycle' => is_array($app->plans) && isset($app->plans['cycle']) ? $app->plans['cycle'] : 'monthly',
                'is_external_url_active' => is_array($app->plans) && isset($app->plans['is_external_url_active']) ? $app->plans['is_external_url_active'] == '1' : false,
                'external_url' => is_array($app->plans) && isset($app->plans['external_url']) ? $app->plans['external_url'] : null,
            ];
        };

        $apps = $allApproved->where('category', '!=', 'Plugin')->map($mapProduct)->values();
        $plugins = $allApproved->where('category', 'Plugin')->map($mapProduct)->values();

        return view('saas-detail', compact('apps', 'plugins'));
    }

    public function show($slug)
    {
        $slug = strtolower($slug);
        
        $dbApp = \App\Models\SaasProduct::with('user')->where('slug', $slug)->where('status', 'approved')->firstOrFail();

        // Cek redirect eksternal
        $isExternalUrlActive = is_array($dbApp->plans) && isset($dbApp->plans['is_external_url_active']) ? $dbApp->plans['is_external_url_active'] == '1' : false;
        $externalUrl = is_array($dbApp->plans) && isset($dbApp->plans['external_url']) ? $dbApp->plans['external_url'] : null;

        if ($isExternalUrlActive && $externalUrl) {
            return redirect()->away($externalUrl);
        }

        // --- LOGIKA PEMISAHAN DESKRIPSI & FITUR (FIXED) ---
        $rawLines = explode("\n", str_replace("\r", "", $dbApp->description));
        
        $cleanFeatures = [];
        $cleanDescriptionLines = [];

        foreach($rawLines as $line) {
            $trimmed = trim($line);

            // 1. Jika baris dimulai dengan strip (-), jadikan Fitur (hanya jika fitur dari DB kosong)
            if (str_starts_with($trimmed, '-')) {
                if (empty($dbApp->features) || !is_array($dbApp->features)) {
                    $cleanFeatures[] = trim(substr($trimmed, 1));
                }
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
        
        // Gunakan fitur dari DB jika ada, jika tidak gunakan hasil parsing
        $finalFeatures = (!empty($dbApp->features) && is_array($dbApp->features)) ? $dbApp->features : $cleanFeatures;
        // ----------------------------------------------------

        $app = (object) [
            'name' => $dbApp->name,
            'slug' => $dbApp->slug,
            'category' => $dbApp->category,
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
            'features' => $finalFeatures, 
            
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