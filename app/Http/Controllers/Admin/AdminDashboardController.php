<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SaasProduct;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\SaasApprovedNotification;
use App\Notifications\SaasRejectedNotification;
use App\Models\User;
use App\Models\VisitorLog;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Dashboard menampilkan statistik ringkas
        $stats = [
            'pending' => SaasProduct::where('status', 'pending')->count(),
            'approved' => SaasProduct::where('status', 'approved')->count(),
            'total' => SaasProduct::count(),
        ];
        
        // List 5 pending terbaru
        $recentPending = SaasProduct::where('status', 'pending')->latest()->take(5)->get();

        $chartLabels = [];
        $chartValues = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $chartLabels[] = $date->format('d M');
            $chartValues[] = VisitorLog::whereDate('date', $date)->count();
        }

        $chartData = [
            'labels' => $chartLabels,
            'values' => $chartValues,
            'labelName' => 'Pengunjung'
        ];

        return view('admin.dashboard', compact('stats', 'recentPending', 'chartData'));
    }

    // 1. HALAMAN LIST SAAS
    public function saasIndex()
    {
        $apps = SaasProduct::latest()->get();
        return view('admin.saas.index', compact('apps'));
    }

    // 2. [BARU] HALAMAN DETAIL SAAS (UNTUK REVIEW)
    public function saasShow($id)
    {
        $app = SaasProduct::with('user')->findOrFail($id);
        return view('admin.saas.show', compact('app'));
    }

    // 3. APPROVE
    public function approveSaas($id)
    {
        $app = SaasProduct::findOrFail($id);
        $app->update(['status' => 'approved']);
        
        if($app->user) {
            $app->user->notify(new SaasApprovedNotification($app->name));
        }

        return redirect()->route('admin.saas.index')->with('success', 'Aplikasi berhasil disetujui.');
    }

    // 4. REJECT
    public function rejectSaas(Request $request, $id)
    {
        $request->validate(['reason' => 'required|string|min:5']);

        $app = SaasProduct::findOrFail($id);
        $app->update(['status' => 'rejected']);

        if($app->user) {
            $app->user->notify(new SaasRejectedNotification($app->name, $request->reason));
        }

        return redirect()->route('admin.saas.index')->with('success', 'Aplikasi ditolak.');
    }

    // 5. [FIXED] HALAMAN KELOLA ADMIN
    public function adminIndex()
    {
        $admins = Admin::all();
        return view('admin.manage-admins', compact('admins'));
    }

    // Fitur Tambah Admin Baru
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:admins,username',
            'password' => 'required|string|min:6',
        ]);

        Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password), // Password di-hash
            'role' => 'admin',
        ]);

        return back()->with('success', 'Admin baru berhasil ditambahkan.');
    }
    
    // Hapus Admin
    public function deleteAdmin($id)
    {
        if (auth()->guard('admin')->id() == $id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }
        Admin::destroy($id);
        return back()->with('success', 'Akun admin dihapus.');
    }

    // 1. LIST REQUEST PARTNER
    public function partnerIndex()
    {
        // Ambil user yang status partnernya pending
        $partners = User::where('partner_status', 'pending')->latest()->get();
        return view('admin.partners.index', compact('partners'));
    }

    // 2. DETAIL REQUEST PARTNER
    public function partnerShow($id)
    {
        $partner = User::findOrFail($id);
        return view('admin.partners.show', compact('partner'));
    }

    // 3. APPROVE PARTNER
    public function approvePartner($id)
    {
        $user = User::findOrFail($id);
        
        $user->update([
            'role' => 'partner', // Upgrade role jadi partner
            'partner_status' => 'approved'
        ]);

        // Kirim Notifikasi (Pakai class notifikasi yang ada tapi ganti pesan)
        $user->notify(new SaasApprovedNotification('Akun Partner FutureCloud')); 

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil disetujui!');
    }

    // 4. REJECT PARTNER
    public function rejectPartner(Request $request, $id)
    {
        $request->validate(['reason' => 'required|string|min:5']);

        $user = User::findOrFail($id);
        
        $user->update([
            'partner_status' => 'rejected' // Role tetap user biasa
        ]);

        // Kirim Notifikasi Reject
        $user->notify(new SaasRejectedNotification('Pendaftaran Partner', $request->reason));

        return redirect()->route('admin.partners.index')->with('success', 'Permintaan partner ditolak.');
    }

    public function monitoring(Request $request)
    {
        $filter = $request->query('filter', 'today');
        $query = VisitorLog::query();
        $now = Carbon::now();
        
        $chartLabels = [];
        $chartValues = [];

        if ($filter == 'today') {
            $query->whereDate('date', $now->toDateString());
            $totalVisitors = $query->count();
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::today()->subDays($i);
                $chartLabels[] = $date->format('d M');
                $chartValues[] = VisitorLog::whereDate('date', $date)->count();
            }
        } elseif ($filter == 'week') {
            $query->whereBetween('date', [$now->copy()->startOfWeek()->toDateString(), $now->copy()->endOfWeek()->toDateString()]);
            $totalVisitors = $query->count();
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::today()->subDays($i);
                $chartLabels[] = $date->format('d M');
                $chartValues[] = VisitorLog::whereDate('date', $date)->count();
            }
        } elseif ($filter == 'month') {
            $query->whereMonth('date', $now->month)->whereYear('date', $now->year);
            $totalVisitors = $query->count();
            for ($i = 1; $i <= $now->daysInMonth; $i++) {
                $date = Carbon::createFromDate($now->year, $now->month, $i);
                $chartLabels[] = ($i % 5 == 0 || $i == 1) ? $date->format('d M') : '';
                $chartValues[] = VisitorLog::whereDate('date', $date)->count();
            }
        } elseif ($filter == 'year') {
            $query->whereYear('date', $now->year);
            $totalVisitors = $query->count();
            for ($i = 1; $i <= 12; $i++) {
                $chartLabels[] = Carbon::create()->month($i)->format('M');
                $chartValues[] = VisitorLog::whereMonth('date', $i)->whereYear('date', $now->year)->count();
            }
        } elseif ($filter == 'custom' && $request->has('start_date') && $request->has('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('date', [$startDate->toDateString(), $endDate->toDateString()]);
            $totalVisitors = $query->count();
            
            $days = $startDate->diffInDays($endDate);
            if ($days <= 31) {
                for ($i = 0; $i <= $days; $i++) {
                    $date = $startDate->copy()->addDays($i);
                    $chartLabels[] = $date->format('d M');
                    $chartValues[] = VisitorLog::whereDate('date', $date)->count();
                }
            } else {
                $months = $startDate->diffInMonths($endDate);
                for ($i = 0; $i <= $months; $i++) {
                    $date = $startDate->copy()->addMonths($i);
                    $chartLabels[] = $date->format('M Y');
                    $chartValues[] = VisitorLog::whereMonth('date', $date->month)->whereYear('date', $date->year)->count();
                }
            }
        }

        $chartData = [
            'labels' => $chartLabels,
            'values' => $chartValues,
            'labelName' => 'Total Pengunjung'
        ];

        $visitorLogs = $query->latest('updated_at')->paginate(15);

        return view('admin.monitoring', compact('filter', 'totalVisitors', 'chartData', 'visitorLogs'));
    }
}