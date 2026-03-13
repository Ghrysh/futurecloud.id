<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Controllers
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\DomainCheckController;
use App\Http\Controllers\SaasController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController; // TAMBAHAN PENTING

// Auth Controllers
use App\Http\Controllers\Auth\OtpVerificationController;
use App\Http\Controllers\Auth\SocialAuthController;

// Client Area
use App\Http\Controllers\ClientAreaController;

// Partner & Admin Controllers
use App\Http\Controllers\PartnerSaasController;
use App\Http\Controllers\Partner\PartnerDashboardController;
use App\Http\Controllers\Admin\AdminSaasController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\ChatbotAdminController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\PortfolioController;

// --- RUTE PUBLIK ---
Route::get('/', [WelcomeController::class, 'index'])->name('home');

Route::get('/portfolio', [App\Http\Controllers\PortfolioController::class, 'index'])->name('portfolio.index');

// --- RUTE OTP & AUTH (Guest) ---
Route::middleware('guest')->group(function () {
    Route::get('otp-verify', [OtpVerificationController::class, 'show'])->name('otp.verify');
    Route::post('otp-verify', [OtpVerificationController::class, 'verify'])->name('otp.verify.submit');
    Route::post('otp-resend', [OtpVerificationController::class, 'resend'])->name('otp.resend');
    Route::get('auth/{provider}', [SocialAuthController::class, 'redirect'])->name('social.redirect');
    Route::get('auth/{provider}/callback', [SocialAuthController::class, 'callback'])->name('social.callback');
});

// --- HALAMAN STATIS ---
Route::view('/services', 'services')->name('services');
Route::view('/solutions', 'solutions')->name('solutions');
Route::view('/about-us', 'about-us')->name('about-us');

// UPDATED: Menggunakan ProductController agar data DB muncul
Route::get('/catalog', [ProductController::class, 'catalog'])->name('catalog');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// --- CHATBOT ---
Route::post('/chatbot/send', [ChatbotController::class, 'processChat']);
Route::get('/chatbot/history', [ChatbotController::class, 'getHistory']);

// --- DOMAIN & HOSTING (UPDATED) ---
Route::post('/domain-check', [DomainCheckController::class, 'check'])->name('domain.check');
Route::post('/check-domain-availability', [DomainCheckController::class, 'check'])->name('domain.check.availability');

// UPDATED: Menggunakan ProductController
Route::get('/domain-registration', [ProductController::class, 'domainDetail'])->name('domain.registration.detail');
Route::get('/vps-hosting', [ProductController::class, 'vpsDetail'])->name('vps.detail');
Route::get('/cpanel-hosting', [ProductController::class, 'cpanelDetail'])->name('cpanel.detail');

// --- SAAS MARKETPLACE ---
Route::get('/saas-marketplace', [SaasController::class, 'index'])->name('saas.detail');
Route::get('/saas/{slug}', [SaasController::class, 'show'])->name('saas.show');
Route::post('/saas/{slug}/review', [SaasController::class, 'storeReview'])->name('saas.review.store')->middleware('auth');

// --- KONFIGURASI ORDER ---
Route::get('/order/domain', [ShopController::class, 'configDomain'])->name('order.config.domain');
Route::get('/order/vps', [ShopController::class, 'configVps'])->name('order.config.vps');
Route::get('/order/cpanel', [ShopController::class, 'configCpanel'])->name('order.config.cpanel');
Route::get('/order/saas', [ShopController::class, 'configSaas'])->name('order.config.saas');
Route::get('/pricing-plans', [BillingController::class, 'index'])->name('billing.index');

// --- CLIENT AREA & AUTH USER ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('auth/google/switch', [SocialAuthController::class, 'switchAccount'])->name('auth.google.switch');

    // Cart & Order
    Route::post('/cart/add', [ShopController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [ShopController::class, 'cart'])->name('cart.index');
    Route::delete('/cart/{id}', [ShopController::class, 'deleteCart'])->name('cart.delete');
    // 1. Jika user mengakses /checkout via URL/Refresh (GET) -> Lempar balik ke Keranjang
    Route::get('/checkout', function () {
        return redirect()->route('cart.index');
    });

    // 2. Jika user klik tombol Checkout dari Keranjang (POST) -> Proses
    Route::post('/checkout', [ShopController::class, 'checkout'])->name('cart.checkout');

    Route::post('/order/buy', [OrderController::class, 'store'])->name('order.store');

    // Notification
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-read', [NotificationController::class, 'markRead'])->name('notifications.read');

    // Partner Registration
    Route::get('/join-partner', function (Request $request) {
        if ($request->user()->role === 'partner') {
            return redirect()->route('partner.dashboard');
        }
        return view('partner.register-program');
    })->name('partner.register');
    Route::post('/join-partner', [PartnerDashboardController::class, 'joinStore'])->name('partner.join.store');
    Route::get('/partner-verification', [PartnerDashboardController::class, 'pending'])->name('partner.pending');

    Route::post('/order/buy', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');
    Route::get('/order/instruction/{id}', [OrderController::class, 'instruction'])->name('order.instruction');
});

// --- RUTE CLIENT AREA ---
Route::middleware('auth')->prefix('client-area')->name('client.')->group(function () {
    Route::get('/', [ClientAreaController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ClientAreaController::class, 'profile'])->name('profile');
    Route::get('/invoices', [ClientAreaController::class, 'invoices'])->name('invoices');
    Route::get('/services/{id}/manage', [ClientAreaController::class, 'manage'])->name('services.show');

    Route::get('/products', [ClientAreaController::class, 'showProduct'])->defaults('type', 'products')->name('products');
    Route::get('/domain', [ClientAreaController::class, 'showProduct'])->defaults('type', 'domain')->name('domain');
    Route::get('/hosting', [ClientAreaController::class, 'showProduct'])->defaults('type', 'hosting')->name('hosting');
    Route::get('/email', [ClientAreaController::class, 'showProduct'])->defaults('type', 'email')->name('email');
    Route::get('/vps', [ClientAreaController::class, 'showProduct'])->defaults('type', 'vps')->name('vps');
    Route::get('/saas', [ClientAreaController::class, 'showProduct'])->defaults('type', 'saas')->name('saas');
    Route::get('/ssl', [ClientAreaController::class, 'showProduct'])->defaults('type', 'ssl')->name('ssl');
    Route::get('/aws', [ClientAreaController::class, 'showProduct'])->defaults('type', 'aws')->name('aws');
    Route::get('/license', [ClientAreaController::class, 'showProduct'])->defaults('type', 'license')->name('license');
    Route::get('/others', [ClientAreaController::class, 'showProduct'])->defaults('type', 'others')->name('others');

    Route::get('/invoices/{id}/download', [ClientAreaController::class, 'downloadInvoice'])->name('invoices.download');
});

// --- PARTNER AREA ---
Route::middleware(['auth', 'partner'])->prefix('partner-area')->name('partner.')->group(function () {
    Route::get('/dashboard', [PartnerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/my-apps', [PartnerDashboardController::class, 'appsIndex'])->name('apps.index');
    Route::get('/app/{id}/edit', [PartnerDashboardController::class, 'edit'])->name('app.edit');
    Route::put('/app/{id}', [PartnerDashboardController::class, 'update'])->name('app.update');
    Route::delete('/app/{id}', [PartnerDashboardController::class, 'destroy'])->name('app.delete');
    Route::get('/company-profile', [PartnerDashboardController::class, 'companyProfile'])->name('company.index');
    Route::put('/company-profile', [PartnerDashboardController::class, 'updateCompanyProfile'])->name('company.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/partner/register-saas', [PartnerSaasController::class, 'create'])->name('partner.saas.create');
    Route::post('/partner/register-saas', [PartnerSaasController::class, 'store'])->name('partner.saas.store');
    Route::get('/partner/success', [PartnerSaasController::class, 'success'])->name('partner.saas.success');
});

// --- ADMIN ROUTES ---
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
});

Route::prefix('admin')->middleware('auth:admin')->name('admin.')->group(function () {
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/monitoring', [AdminDashboardController::class, 'monitoring'])->name('monitoring');

    // SAAS MANAGEMENT
    Route::get('/saas-management', [AdminSaasController::class, 'saasIndex'])->name('saas.index');
    Route::get('/saas/create', [AdminSaasController::class, 'create'])->name('saas.create'); // Baru
    Route::post('/saas', [AdminSaasController::class, 'store'])->name('saas.store'); // Baru
    Route::get('/saas/{id}/edit', [AdminSaasController::class, 'edit'])->name('saas.edit'); // Baru
    Route::put('/saas/{id}', [AdminSaasController::class, 'update'])->name('saas.update'); // Baru
    Route::delete('/saas/{id}', [AdminSaasController::class, 'destroy'])->name('saas.destroy'); // Baru

    // Review & Approval (Existing)
    Route::get('/saas/{id}', [AdminSaasController::class, 'saasShow'])->name('saas.show');
    Route::post('/saas/{id}/approve', [AdminSaasController::class, 'approveSaas'])->name('saas.approve');
    Route::post('/saas/{id}/reject', [AdminSaasController::class, 'rejectSaas'])->name('saas.reject');

    Route::get('/admins', [AdminDashboardController::class, 'adminIndex'])->name('admins.index');
    Route::post('/add-new', [AdminDashboardController::class, 'storeAdmin'])->name('store');
    Route::delete('/delete/{id}', [AdminDashboardController::class, 'deleteAdmin'])->name('delete');

    Route::get('/partners', [AdminDashboardController::class, 'partnerIndex'])->name('partners.index');
    Route::get('/partners/{id}', [AdminDashboardController::class, 'partnerShow'])->name('partners.show');
    Route::post('/partners/{id}/approve', [AdminDashboardController::class, 'approvePartner'])->name('partners.approve');
    Route::post('/partners/{id}/reject', [AdminDashboardController::class, 'rejectPartner'])->name('partners.reject');

    Route::get('/chatbot/responses', [ChatbotAdminController::class, 'index'])->name('chatbot.index');
    Route::post('/chatbot/responses', [ChatbotAdminController::class, 'store'])->name('chatbot.store');
    Route::put('/chatbot/responses/{id}', [ChatbotAdminController::class, 'update'])->name('chatbot.update');
    Route::delete('/chatbot/responses/{id}', [ChatbotAdminController::class, 'destroy'])->name('chatbot.destroy');
    Route::get('/chatbot/history', [ChatbotAdminController::class, 'history'])->name('chatbot.history');

    Route::patch('/chatbot/leads/{id}/status', [ChatbotAdminController::class, 'toggleLeadStatus'])->name('chatbot.lead.status');
    Route::get('/chatbot/leads/{id}/history', [ChatbotAdminController::class, 'getLeadHistory'])->name('chatbot.lead.history');

    Route::resource('products', AdminProductController::class);

    Route::post('/order-items/{id}/update-config', [AdminOrderController::class, 'updateItemConfig'])
        ->name('admin.order-items.update-config');

    Route::resource('portfolios', PortfolioController::class);

    Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
        Route::resource('portfolios', App\Http\Controllers\Admin\PortfolioController::class);
    });

    // MANAJEMEN ORDER
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');

    // KELOLA USER
    Route::resource('users', AdminUserController::class);
    // Route khusus untuk Ban/Unban
    Route::patch('/users/{id}/ban', [AdminUserController::class, 'toggleBan'])->name('users.ban');

    // Update Status & Config (Yang sudah kita buat sebelumnya)
    Route::patch('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::post('/order-items/{id}/update-config', [AdminOrderController::class, 'updateItemConfig'])->name('order-items.update-config');
    Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');

    Route::controller(HeroController::class)->prefix('hero')->name('hero.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/update-text', 'updateText')->name('update_text');
        Route::post('/add-image', 'addImage')->name('add_image');
        Route::delete('/delete-image', 'destroyImage')->name('delete_image');
        Route::patch('/reorder-image', 'reorderImage')->name('reorder_image');
    });
});

Route::get('/sys-ping/v1', function (\Illuminate\Http\Request $request) {
    if (!session()->has('tracked_session')) {
        session(['tracked_session' => true]);
        session()->save(); 
    }
    $sessionId = session()->getId(); 

    $ip = $request->header('X-Forwarded-For', $request->ip());
    if (strpos($ip, ',') !== false) {
        $ip = trim(explode(',', $ip)[0]);
    }

    $path = $request->query('path', '/');
    $date = now()->toDateString();

    $log = \App\Models\VisitorLog::firstOrCreate(
        ['session_id' => $sessionId, 'date' => $date],
        ['ip_address' => $ip, 'page_journey' => []]
    );

    // Bypass IP Docker internal
    if ($log->ip_address === '172.19.0.1' || $log->ip_address === '127.0.0.1') {
        $log->ip_address = $ip;
    }

    $journey = $log->page_journey ?? [];
    
    $lastVisit = end($journey);
    if (!$lastVisit || $lastVisit['path'] !== $path) {
        $journey[] = [
            'path' => $path, 
            'time' => now()->format('H:i')
        ];
        $log->page_journey = $journey;
        $log->save();
    }

    return response()->json(['success' => true]);
});

require __DIR__ . '/auth.php';
