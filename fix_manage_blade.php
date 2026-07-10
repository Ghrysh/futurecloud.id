<?php

$file = __DIR__ . '/resources/views/dashboard/manage.blade.php';
$content = file_get_contents($file);

$search1 = <<<'EOT'
    $dcCode = strtoupper($config['datacenter'] ?? 'US');
    $dcName = match($dcCode) {
        'ID' => 'Indonesia (Jakarta)',
        'SG' => 'Singapore',
        'US' => 'USA (North America)',
        'UK' => 'United Kingdom',
        'EU' => 'Europe (Netherlands)',
        default => 'Global'
    };
    $flagUrl = "https://flagcdn.com/w20/" . strtolower($dcCode == 'UK' ? 'gb' : $dcCode) . ".png";
@endphp
EOT;

$replace1 = <<<'EOT'
    $dcCode = strtoupper($config['datacenter'] ?? 'US');
    $dcName = match($dcCode) {
        'ID' => 'Indonesia (Jakarta)',
        'SG' => 'Singapore',
        'US' => 'USA (North America)',
        'UK' => 'United Kingdom',
        'EU' => 'Europe (Netherlands)',
        default => 'Global'
    };
    $flagUrl = "https://flagcdn.com/w20/" . strtolower($dcCode == 'UK' ? 'gb' : $dcCode) . ".png";

    $isPlugin = $service->type == 'saas' && str_contains(strtolower($service->product_name), 'plugin');
    $licenseKey = $config['license_key'] ?? 'FC-LIC-' . str_pad($service->id, 4, '0', STR_PAD_LEFT) . '-' . strtoupper(\Illuminate\Support\Str::random(6));
    
    $isChatbot = str_contains(strtolower($service->product_name), 'chatbot');
    $cliCommand = $isChatbot ? 'chatbot' : 'monitoring';
    $cliShort = $isChatbot ? 'cb' : 'm';
@endphp
EOT;

$search2 = <<<'EOT'
                        <!-- Row: Domain -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-b border-gray-50 pb-4">
                            <div class="flex items-center gap-2 text-sm font-semibold text-gray-500">
                                Hosted Domain
                            </div>
                            <div class="sm:col-span-2 text-sm text-blue-600 font-medium">
                                <a href="http://{{ $domain }}" target="_blank" class="hover:underline">
                                    {{ $domain }}
                                </a>
                            </div>
                        </div>

                        <!-- Row: IP Address -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-b border-gray-50 pb-4">
                            <div class="flex items-center gap-2 text-sm font-semibold text-gray-500">
                                IP Address
                            </div>
                            <div class="sm:col-span-2 text-sm text-gray-800 font-mono">
                                {{ $ipAddress }}
                            </div>
                        </div>

                        <!-- Row: Server Location -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="flex items-center gap-2 text-sm font-semibold text-gray-500">
                                Server Location
                            </div>
                            <div class="sm:col-span-2 text-sm text-gray-800 flex items-center gap-2">
                                <img src="{{ $flagUrl }}" alt="{{ $dcCode }}" class="w-5 rounded-sm shadow-sm border border-gray-200">
                                <span>{{ $dcName }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Login Credentials Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ showPass: false }">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800">Informasi Login (Credentials)</h3>
                </div>
                <div class="p-6 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-lg bg-orange-100 flex items-center justify-center flex-shrink-0 text-orange-600">
                        <i class="ri-shield-keyh-line text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Username -->
                            <div>
                                <label class="text-xs text-gray-500 block mb-1">Username</label>
                                <div class="bg-gray-50 px-3 py-2 rounded text-sm font-mono text-gray-700 border border-gray-200 flex justify-between group relative">
                                    <span id="usernameText">{{ $username }}</span>
                                    <button class="text-gray-400 hover:text-blue-600" onclick="navigator.clipboard.writeText('{{ $username }}'); alert('Username disalin!')" title="Copy">
                                        <i class="ri-file-copy-line"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- Password -->
                            <div>
                                <label class="text-xs text-gray-500 block mb-1">Password</label>
                                <div class="bg-gray-50 px-3 py-2 rounded text-sm font-mono text-gray-700 border border-gray-200 flex justify-between items-center">
                                    <span x-show="!showPass" class="blur-sm select-none"></span>
                                    <span x-show="showPass" class="text-gray-900 font-medium">{{ $password }}</span>

                                    <div class="flex gap-2">
                                        <button @click="showPass = !showPass" class="text-gray-400 hover:text-blue-600" title="Show/Hide">
                                            <i class="ri-eye-line" x-show="!showPass"></i>
                                            <i class="ri-eye-off-line" x-show="showPass"></i>
                                        </button>
                                        <button class="text-gray-400 hover:text-blue-600" onclick="navigator.clipboard.writeText('{{ $password }}'); alert('Password disalin!')" title="Copy">
                                            <i class="ri-file-copy-line"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">* Klik ikon mata untuk melihat password. Gunakan kredensial ini untuk login ke cPanel/SSH.</p>
                    </div>
                </div>
            </div>
EOT;

$replace2 = <<<'EOT'
                        @if($isPlugin)
                            <!-- Plugin License Key -->
                            <div class="grid grid-cols-1 gap-4 border-b border-gray-50 pb-4">
                                <div class="text-sm font-semibold text-gray-500 mb-2">Kode Lisensi Anda</div>
                                <div class="bg-blue-50 px-4 py-3 rounded-lg border border-blue-100 flex justify-between items-center group relative">
                                    <span class="text-lg font-mono text-blue-700 font-bold tracking-wider">{{ $licenseKey }}</span>
                                    <button class="text-blue-500 hover:text-blue-700 font-medium text-sm flex items-center gap-1" onclick="navigator.clipboard.writeText('{{ $licenseKey }}'); alert('Lisensi disalin!')" title="Copy License">
                                        <i class="ri-file-copy-line"></i> Salin
                                    </button>
                                </div>
                            </div>
                        @else
                            <!-- Row: Domain -->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-b border-gray-50 pb-4">
                                <div class="flex items-center gap-2 text-sm font-semibold text-gray-500">
                                    Hosted Domain
                                </div>
                                <div class="sm:col-span-2 text-sm text-blue-600 font-medium">
                                    <a href="http://{{ $domain }}" target="_blank" class="hover:underline">
                                        {{ $domain }}
                                    </a>
                                </div>
                            </div>

                            <!-- Row: IP Address -->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 border-b border-gray-50 pb-4">
                                <div class="flex items-center gap-2 text-sm font-semibold text-gray-500">
                                    IP Address
                                </div>
                                <div class="sm:col-span-2 text-sm text-gray-800 font-mono">
                                    {{ $ipAddress }}
                                </div>
                            </div>

                            <!-- Row: Server Location -->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div class="flex items-center gap-2 text-sm font-semibold text-gray-500">
                                    Server Location
                                </div>
                                <div class="sm:col-span-2 text-sm text-gray-800 flex items-center gap-2">
                                    <img src="{{ $flagUrl }}" alt="{{ $dcCode }}" class="w-5 rounded-sm shadow-sm border border-gray-200">
                                    <span>{{ $dcName }}</span>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            @if($isPlugin)
            <!-- Plugin Installation Instructions Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800">Panduan Instalasi Plugin</h3>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 mb-4">Ikuti langkah-langkah berikut untuk mengintegrasikan plugin ini ke dalam project Anda via terminal:</p>
                    
                    <div class="space-y-4">
                        <div>
                            <h4 class="text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">1. Install Plugin</h4>
                            <div class="bg-gray-900 text-gray-200 p-3 rounded-lg font-mono text-sm">
                                <p class="text-gray-400"># Gunakan flag key untuk instalasi langsung</p>
                                futurecloud -{{ $cliCommand }} install --key {{ $licenseKey }}<br>
                                <p class="text-gray-400 mt-2"># Atau versi singkat</p>
                                fc -{{ $cliShort }} install --key {{ $licenseKey }}
                            </div>
                        </div>

                        <div>
                            <h4 class="text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">2. Isi Konfigurasi Dasar</h4>
                            <ul class="list-disc list-inside text-sm text-gray-600 space-y-1 ml-1">
                                <li><strong>Framework:</strong> Pilih framework yang Anda gunakan (Laravel, React, Vue, dll).</li>
                                <li><strong>Path:</strong> Masukkan path folder direktori project Anda.</li>
                            </ul>
                        </div>

                        <div>
                            <h4 class="text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">3. Perintah Bantuan Lainnya</h4>
                            <div class="bg-gray-50 border border-gray-200 p-3 rounded-lg font-mono text-xs text-gray-700 space-y-2">
                                <p><strong>Cek Versi:</strong> futurecloud -{{ $cliCommand }} --version <span class="text-gray-400">(atau fc -{{ $cliShort }} --version)</span></p>
                                <p><strong>Bantuan:</strong> futurecloud -{{ $cliCommand }} --help <span class="text-gray-400">(atau fc -{{ $cliShort }} --help)</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <!-- Login Credentials Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ showPass: false }">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800">Informasi Login (Credentials)</h3>
                </div>
                <div class="p-6 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-lg bg-orange-100 flex items-center justify-center flex-shrink-0 text-orange-600">
                        <i class="ri-shield-keyh-line text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Username -->
                            <div>
                                <label class="text-xs text-gray-500 block mb-1">Username</label>
                                <div class="bg-gray-50 px-3 py-2 rounded text-sm font-mono text-gray-700 border border-gray-200 flex justify-between group relative">
                                    <span id="usernameText">{{ $username }}</span>
                                    <button class="text-gray-400 hover:text-blue-600" onclick="navigator.clipboard.writeText('{{ $username }}'); alert('Username disalin!')" title="Copy">
                                        <i class="ri-file-copy-line"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- Password -->
                            <div>
                                <label class="text-xs text-gray-500 block mb-1">Password</label>
                                <div class="bg-gray-50 px-3 py-2 rounded text-sm font-mono text-gray-700 border border-gray-200 flex justify-between items-center">
                                    <span x-show="!showPass" class="blur-sm select-none"></span>
                                    <span x-show="showPass" class="text-gray-900 font-medium">{{ $password }}</span>

                                    <div class="flex gap-2">
                                        <button @click="showPass = !showPass" class="text-gray-400 hover:text-blue-600" title="Show/Hide">
                                            <i class="ri-eye-line" x-show="!showPass"></i>
                                            <i class="ri-eye-off-line" x-show="showPass"></i>
                                        </button>
                                        <button class="text-gray-400 hover:text-blue-600" onclick="navigator.clipboard.writeText('{{ $password }}'); alert('Password disalin!')" title="Copy">
                                            <i class="ri-file-copy-line"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">* Klik ikon mata untuk melihat password. Gunakan kredensial ini untuk login ke cPanel/SSH.</p>
                    </div>
                </div>
            </div>
            @endif
EOT;

$content = str_replace($search1, $replace1, $content);
$content = str_replace($search2, $replace2, $content);

file_put_contents($file, $content);

echo "manage.blade.php updated successfully.\n";
