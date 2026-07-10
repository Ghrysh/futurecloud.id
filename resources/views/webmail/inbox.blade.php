<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            overflow: hidden;
        }

        .bg-grid {
            background-image: linear-gradient(to right, #f1f5f9 1px, transparent 1px),
                linear-gradient(to bottom, #f1f5f9 1px, transparent 1px);
            background-size: 40px 40px;
        }

        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }
    </style>
</head>

<body class="h-full bg-grid relative">

    <form id="deleteEmailForm" method="POST" action="{{ secure_url(route('webmail.delete', [], false)) }}"
        class="hidden">
        @csrf
        <input type="hidden" name="uid" id="deleteUid">
        <input type="hidden" name="folder" value="{{ $currentFolder }}">
    </form>

    <div
        class="lg:hidden bg-white/80 backdrop-blur-md border-b border-slate-200 px-4 py-4 flex items-center justify-between sticky top-0 z-[60]">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 bg-blue-600 rounded-lg flex items-center justify-center">
                <i class="fa-solid fa-bolt text-white text-xs"></i>
            </div>
            <span class="font-bold text-slate-800 uppercase tracking-wider text-sm">FutureCloud</span>
        </div>
        <button id="menuBtn" class="p-2 text-slate-600 hover:text-blue-600 transition-colors">
            <i class="fa-solid fa-bars-staggered text-xl"></i>
        </button>
    </div>

    <div class="flex h-screen overflow-hidden relative">

        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-[70] w-72 bg-white border-r border-slate-200 transform -translate-x-full lg:translate-x-0 lg:static lg:inset-0 transition-transform duration-300 ease-in-out shadow-[10px_0_30px_-15px_rgba(0,0,0,0.05)]">
            <div class="h-full flex flex-col p-6">
                <div class="hidden lg:flex items-center gap-3 mb-10 px-2">
                    <div
                        class="w-9 h-9 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200">
                        <i class="fa-solid fa-bolt text-white text-lg"></i>
                    </div>
                    <span class="text-xl font-bold text-slate-800 tracking-tight">FutureCloud</span>
                </div>

                <nav class="space-y-1.5 flex-1 overflow-y-auto custom-scroll">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-4 mb-3">Kotak Surat</p>

                    @if (isset($folders) && count($folders) > 0)
                        @foreach ($folders as $f)
                            @php
                                $isActive = strtolower($currentFolder) === strtolower($f['full_name']);
                                $icon = 'fa-regular fa-folder';

                                if (strtolower($f['name']) === 'inbox') {
                                    $icon = 'fa-solid fa-inbox';
                                } elseif (preg_match('/sent/i', $f['name'])) {
                                    $icon = 'fa-regular fa-paper-plane';
                                } elseif (preg_match('/draft/i', $f['name'])) {
                                    $icon = 'fa-regular fa-file-lines';
                                } elseif (preg_match('/trash|bin/i', $f['name'])) {
                                    $icon = 'fa-regular fa-trash-can';
                                } elseif (preg_match('/spam|junk/i', $f['name'])) {
                                    $icon = 'fa-solid fa-circle-exclamation';
                                }
                            @endphp
                            <a href="{{ secure_url(route('webmail.email', ['folder' => $f['full_name']], false)) }}"
                                class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium transition-all group {{ $isActive ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                                <div class="flex items-center gap-3 truncate">
                                    <div class="w-5 text-center">
                                        <i
                                            class="{{ $icon }} text-sm transition-transform group-hover:scale-110 {{ $isActive ? 'text-white' : 'text-slate-500 group-hover:text-blue-600' }}"></i>
                                    </div>
                                    <span class="truncate capitalize">{{ $f['name'] }}</span>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <p class="text-xs text-slate-400 italic p-4">Gagal memuat folder.</p>
                    @endif
                </nav>

                <div class="pt-4 mt-4 border-t border-slate-100">
                    <form method="POST" action="{{ secure_url(route('webmail.logout', [], false)) }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-red-50 hover:text-red-500 transition-all font-semibold group">
                            <div class="w-5 text-center">
                                <i
                                    class="fa-solid fa-path-from-bracket text-sm transition-transform group-hover:-translate-x-1"></i>
                            </div>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <main class="flex-1 min-w-0 overflow-y-auto custom-scroll relative z-10">
            <div class="p-4 lg:p-10 min-h-full pb-20">
                <div class="max-w-6xl mx-auto px-4 py-6 pb-20">

                    <div
                        class="bg-white/80 backdrop-blur-lg p-6 rounded-[2rem] border border-slate-100 shadow-[0_20px_50px_rgba(148,163,184,0.05)] mb-6">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <h4 class="text-xl font-black text-slate-800 tracking-tight flex items-center gap-2">
                                    <i class="fa-regular fa-envelope text-blue-600"></i>
                                    {{ $account->email }}
                                </h4>
                                <p class="text-xs text-slate-500 flex items-center gap-2 mt-1">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 inline-block animate-pulse"></span>
                                    <span>Folder Aktif: <strong
                                            class="text-slate-700 capitalize">{{ $currentFolder }}</strong></span>
                                    <span class="text-slate-300">|</span>
                                    <span>{{ $status ?? 'Terhubung ke server mail VPS' }}</span>
                                </p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold bg-blue-50 text-blue-600 px-3 py-1.5 rounded-xl">
                                    {{ $messages->count() }} Berkas Pesan
                                </span>

                                <button type="button" onclick="refreshCurrentFolder(this)"
                                    class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-blue-600 hover:text-white text-slate-600 transition-all duration-200 flex items-center justify-center"
                                    title="Refresh Email">
                                    <i class="fa-solid fa-rotate-right text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 items-start">
                        <div
                            class="bg-white rounded-[2rem] border border-slate-100 shadow-[0_20px_50px_rgba(148,163,184,0.05)] overflow-hidden">
                            <div class="divide-y divide-slate-100">
                                @if (isset($messages) && $messages->count() > 0)
                                    @foreach ($messages->reverse() as $message)
                                        @php
                                            // Menggunakan fallback '??' untuk mencegah 'Undefined array key' seandainya data cache korup
                                            $fromName = $message['from_name'] ?? '(Unknown)';
                                            $fromMail = $message['from_mail'] ?? '-';
                                            $subject = $message['subject'] ?? '(Tanpa Subjek)';
                                            $date = $message['date'] ?? '-';
                                            $rawBody = $message['raw_body'] ?? 'Tidak ada isi pesan.';
                                            $uid = $message['uid'] ?? '';
                                            $toEmail = $message['to_mail'] ?? '-';
                                            $hasAttachments = $message['has_attachments'] ?? false;
                                            $attachmentsData = $message['attachments'] ?? [];
                                            $isSeen = $message['is_seen'] ?? true;
                                        @endphp

                                        <div
                                            class="p-5 hover:bg-slate-50/80 transition-colors flex flex-col md:flex-row md:items-center justify-between gap-4">
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <span
                                                        class="font-bold text-sm text-slate-900 truncate block max-w-[250px]">
                                                        {{ $fromName }}
                                                    </span>

                                                    {{-- Cek status sudah dibaca --}}
                                                    @if (!$message['is_seen'])
                                                        <span class="bg-blue-600 w-2 h-2 rounded-full shrink-0"
                                                            title="Belum dibaca"></span>
                                                    @endif

                                                    @if ($hasAttachments)
                                                        <i class="fa-solid fa-paperclip text-xs text-slate-400"
                                                            title="Memiliki lampiran file"></i>
                                                    @endif
                                                </div>

                                                <p class="text-[11px] text-slate-400 truncate mb-2">
                                                    {{ $fromMail }}
                                                </p>

                                                <h5 class="text-sm font-semibold text-slate-700 truncate">
                                                    {{ $subject }}
                                                </h5>

                                                <p class="text-xs text-slate-400 line-clamp-1 mt-1">
                                                    {{ Str::limit(strip_tags($rawBody), 150) }}
                                                </p>
                                            </div>

                                            <div
                                                class="flex items-center justify-between md:justify-end gap-3 shrink-0 border-t border-slate-50 md:border-none pt-3 md:pt-0">
                                                <span class="text-xs text-slate-400 font-medium mr-2">
                                                    {{ $date }}
                                                </span>

                                                <button type="button" onclick="confirmDelete('{{ $uid }}')"
                                                    class="w-9 h-9 flex items-center justify-center bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-xl transition-all"
                                                    title="Pindahkan ke Sampah">
                                                    <i class="fa-regular fa-trash-can text-sm"></i>
                                                </button>

                                                <!-- TOMBOL BARU: Teruskan (Forward) -->
                                                <button type="button" onclick="forwardEmail(this)"
                                                    data-subject="{{ $subject }}"
                                                    data-from="{{ $fromName }} <{{ $fromMail }}>"
                                                    data-date="{{ $date }}" data-to="{{ $toEmail }}"
                                                    data-body="{{ base64_encode($rawBody) }}"
                                                    data-attachments="{{ json_encode($attachmentsData) }}"
                                                    class="w-9 h-9 flex items-center justify-center bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white rounded-xl transition-all"
                                                    title="Teruskan Email">
                                                    <i class="fa-solid fa-share text-sm"></i>
                                                </button>

                                                <button type="button" onclick="openEmailModal(this)"
                                                    data-from="{{ $fromName }}"
                                                    data-subject="{{ $subject }}"
                                                    data-date="{{ $date }}"
                                                    data-body="{{ base64_encode($rawBody) }}"
                                                    data-attachments="{{ json_encode($attachmentsData) }}"
                                                    class="text-xs font-bold text-blue-600 hover:text-white px-4 py-2 bg-blue-50 hover:bg-blue-600 rounded-xl transition-all h-9">
                                                    Baca
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div
                                        class="py-16 flex flex-col items-center justify-center text-slate-400 text-center">
                                        <div
                                            class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-4">
                                            <i class="fa-regular fa-envelope-open text-2xl"></i>
                                        </div>
                                        <p class="text-sm font-medium text-slate-500">Tidak ada email di folder ini.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Modal Detail Email Masuk --}}
                <div id="emailModal" class="fixed inset-0 z-50 hidden animate-fade-in">
                    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeEmailModal()"></div>
                    <div
                        class="absolute inset-x-4 bottom-0 top-10 md:inset-auto md:top-1/2 md:left-1/2 md:-translate-x-1/2 md:-translate-y-1/2 md:w-full md:max-w-2xl bg-white rounded-t-[2rem] md:rounded-[2rem] shadow-2xl flex flex-col overflow-hidden border border-slate-100 max-h-[85vh]">

                        <div
                            class="p-6 border-b border-slate-100 flex items-start justify-between gap-4 bg-slate-50/50">
                            <div class="min-w-0">
                                <span id="modalDate"
                                    class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-1"></span>
                                <h3 id="modalSubject" class="text-base font-bold text-slate-800 leading-tight"></h3>
                                <p id="modalFrom" class="text-xs text-slate-500 mt-1 truncate"></p>
                            </div>
                            <button onclick="closeEmailModal()"
                                class="w-8 h-8 flex items-center justify-center bg-white rounded-full shadow-sm text-slate-400 hover:text-slate-600 transition-colors shrink-0">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>

                        <div class="p-6 overflow-y-auto flex-1 bg-white text-sm text-slate-600 leading-relaxed">
                            <iframe id="modalBodyIframe" class="w-full h-48 min-h-[250px] border-none mb-4"></iframe>

                            <div id="attachmentSection" class="hidden border-t border-slate-100 pt-4">
                                <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">
                                    <i class="fa-solid fa-paperclip mr-1"></i> Lampiran File
                                </h4>
                                <div id="attachmentList" class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-slate-50 border-t border-slate-100 flex justify-end">
                            <button onclick="closeEmailModal()"
                                class="text-xs font-bold text-slate-600 bg-white border border-slate-200 px-5 py-2.5 rounded-xl hover:bg-slate-50 transition-colors">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Modal Tulis Email Baru (Compose) --}}
                <div id="composeModal" class="fixed inset-0 z-60 hidden">
                    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="toggleComposeModal()">
                    </div>

                    <div id="modalBox"
                        class="absolute inset-x-4 bottom-0 top-10 md:inset-auto md:top-1/2 md:left-1/2 md:-translate-x-1/2 md:-translate-y-1/2 md:w-full md:max-w-4xl bg-white rounded-t-[2rem] md:rounded-[2rem] shadow-2xl flex flex-col overflow-hidden border border-slate-100 max-h-[85vh] transition-all duration-300">

                        <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                            <div class="flex items-center gap-2">
                                <i class="fa-regular fa-paper-plane text-blue-600"></i>
                                <h3 id="modalComposeTitle" class="text-base font-bold text-slate-800">Tulis Pesan Baru
                                </h3>
                            </div>

                            <div class="flex items-center gap-2">
                                <button type="button" onclick="toggleFullscreenCompose()" id="fullscreenToggleBtn"
                                    title="Ubah Ukuran"
                                    class="hidden md:flex w-8 h-8 items-center justify-center bg-white rounded-full shadow-sm text-slate-400 hover:text-slate-600 transition-colors">
                                    <i id="fullscreenIcon" class="fa-solid fa-expand text-xs"></i>
                                </button>

                                <button type="button" onclick="resetComposeForm(); toggleComposeModal();"
                                    title="Tutup"
                                    class="w-8 h-8 flex items-center justify-center bg-white rounded-full shadow-sm text-slate-400 hover:text-slate-600 transition-colors">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>

                        <form action="{{ secure_url(route('webmail.send', [], false)) }}" method="POST"
                            enctype="multipart/form-data" class="flex flex-col flex-1 overflow-hidden">
                            @csrf
                            <div class="p-6 space-y-4 overflow-y-auto flex-1 custom-scroll">

                                {{-- Input: Kepada --}}
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="block text-xs font-bold text-slate-500 uppercase">Kepada</label>
                                        <button type="button" onclick="toggleCcBccFields()"
                                            class="text-xs font-semibold text-blue-600 hover:text-blue-700 focus:outline-none transition-colors">
                                            Cc / Bcc
                                        </button>
                                    </div>
                                    <input type="email" name="to" required placeholder="email@tujuan.com"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:bg-white transition-all">
                                </div>

                                {{-- Input: Cc --}}
                                <div id="ccFieldWrapper" class="hidden animate-fade-in">
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Cc</label>
                                    <input type="email" name="cc" placeholder="cc@email.com"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:bg-white transition-all">
                                </div>

                                {{-- Input: Bcc --}}
                                <div id="bccFieldWrapper" class="hidden animate-fade-in">
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Bcc</label>
                                    <input type="email" name="bcc" placeholder="bcc@email.com"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:bg-white transition-all">
                                </div>

                                {{-- Input: Subjek --}}
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Subjek</label>
                                    <input type="text" name="subject" required placeholder="Masukkan subjek email"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:bg-white transition-all">
                                </div>

                                {{-- Input: Isi Pesan dengan Toolbar Font ala Gmail --}}
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Isi
                                        Pesan</label>

                                    <div
                                        class="border border-slate-200 rounded-xl overflow-hidden bg-slate-50 focus-within:border-blue-500 focus-within:bg-white transition-all">
                                        <div
                                            class="flex flex-wrap items-center gap-1.5 px-3 py-2 bg-slate-100/70 border-b border-slate-200 text-slate-600 text-xs">
                                            <select id="fontStyleSelect"
                                                onchange="applyTextFormatting('fontFamily', this.value)"
                                                class="bg-white border border-slate-200 rounded px-2 py-1 text-xs focus:outline-none cursor-pointer">
                                                <option value="ui-sans-serif, system-ui, sans-serif">Sans Serif
                                                </option>
                                                <option value="Georgia, Cambria, serif">Serif</option>
                                                <option value="SFMono-Regular, Menlo, Monaco, Consolas, monospace">
                                                    Monospace</option>
                                                <option value="'Courier New', Courier, monospace">Courier New</option>
                                                <option value="'Times New Roman', Times, serif">Times New Roman
                                                </option>
                                            </select>

                                            <select id="fontSizeSelect"
                                                onchange="applyTextFormatting('fontSize', this.value)"
                                                class="bg-white border border-slate-200 rounded px-2 py-1 text-xs focus:outline-none cursor-pointer">
                                                <option value="14px">Normal</option>
                                                <option value="12px">Kecil</option>
                                                <option value="18px">Besar</option>
                                                <option value="24px">Sangat Besar</option>
                                            </select>

                                            <div class="h-4 w-[1px] bg-slate-300 mx-1"></div>

                                            <button type="button"
                                                onclick="applyToggleFormatting('fontWeight', 'bold')"
                                                class="w-6 h-6 rounded hover:bg-slate-200 flex items-center justify-center font-bold"
                                                title="Tebal">B</button>
                                            <button type="button"
                                                onclick="applyToggleFormatting('fontStyle', 'italic')"
                                                class="w-6 h-6 rounded hover:bg-slate-200 flex items-center justify-center italic font-serif"
                                                title="Miring">I</button>
                                            <button type="button"
                                                onclick="applyToggleFormatting('textDecoration', 'underline')"
                                                class="w-6 h-6 rounded hover:bg-slate-200 flex items-center justify-center underline"
                                                title="Garis bawah">U</button>

                                            <div class="h-4 w-[1px] bg-slate-300 mx-1"></div>

                                            <button type="button" onclick="applyTextFormatting('textAlign', 'left')"
                                                class="w-6 h-6 rounded hover:bg-slate-200 flex items-center justify-center"
                                                title="Rata Kiri"><i
                                                    class="fa-solid fa-align-left text-[10px]"></i></button>
                                            <button type="button"
                                                onclick="applyTextFormatting('textAlign', 'center')"
                                                class="w-6 h-6 rounded hover:bg-slate-200 flex items-center justify-center"
                                                title="Rata Tengah"><i
                                                    class="fa-solid fa-align-center text-[10px]"></i></button>
                                            <button type="button" onclick="applyTextFormatting('textAlign', 'right')"
                                                class="w-6 h-6 rounded hover:bg-slate-200 flex items-center justify-center"
                                                title="Rata Kanan"><i
                                                    class="fa-solid fa-align-right text-[10px]"></i></button>

                                            <div class="h-4 w-[1px] bg-slate-300 mx-1"></div>

                                            <button type="button" onclick="clearTextFormatting()"
                                                class="w-6 h-6 rounded hover:bg-slate-200 flex items-center justify-center text-red-500"
                                                title="Hapus Format"><i
                                                    class="fa-solid fa-text-slash text-[10px]"></i></button>
                                        </div>

                                        <textarea id="composeBody" name="body" required rows="8" placeholder="Tulis sesuatu di sini..."
                                            class="w-full px-4 py-3 bg-transparent text-sm focus:outline-none transition-all resize-y min-h-[150px] custom-scroll"
                                            style="font-family: ui-sans-serif, system-ui, sans-serif; font-size: 14px;"></textarea>
                                    </div>
                                </div>

                                {{-- Upload Lampiran File --}}
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Lampiran File
                                        (Opsional)</label>
                                    <div
                                        class="relative w-full border border-dashed border-slate-300 rounded-xl bg-slate-50 p-4 text-center hover:bg-slate-100/50 transition-colors">
                                        <input type="file" name="attachments[]" id="fileAttachments" multiple
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                        <div class="flex flex-col items-center justify-center gap-1">
                                            <i class="fa-solid fa-cloud-arrow-up text-xl text-slate-400"></i>
                                            <p class="text-xs text-slate-600 font-medium">Klik atau drop berkas ke sini
                                            </p>
                                            <p class="text-[10px] text-slate-400">Bisa memilih lebih dari 1 file
                                                sekaligus</p>
                                        </div>
                                    </div>
                                    <div id="selectedFiles" class="mt-2 text-xs text-blue-600 space-y-1"></div>
                                </div>
                            </div>

                            <div class="p-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
                                <button type="button" onclick="toggleComposeModal()"
                                    class="text-xs font-bold text-slate-600 bg-white border border-slate-200 px-5 py-2.5 rounded-xl hover:bg-slate-50 transition-colors">Batal</button>
                                <button type="submit"
                                    class="text-xs font-bold text-white bg-blue-600 px-5 py-2.5 rounded-xl hover:bg-blue-700 shadow-md shadow-blue-100 transition-colors flex items-center gap-2">
                                    <i class="fa-solid fa-paper-plane text-[10px]"></i> Kirim
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <button id="floatingComposeBtn" onclick="toggleComposeModal()"
        class="fixed bottom-6 right-6 z-40 w-14 h-14 bg-blue-600 rounded-full flex items-center justify-center text-white shadow-xl hover:bg-blue-700 hover:scale-110 transition-all group focus:outline-none"
        title="Tulis Email Baru">
        <i class="fa-solid fa-pen text-lg group-hover:rotate-12 transition-transform"></i>
    </button>

    <div id="overlay"
        class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[65] hidden lg:hidden transition-opacity"></div>

    <script>
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            if (!overlay.classList.contains('hidden')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }

        menuBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('lg:translate-x-0');
                sidebar.classList.add('lg:translate-x-0');
                overlay.classList.add('hidden');
            }
        });
    </script>

    <script>
        // Fungsi baru untuk Toggle input Cc dan Bcc
        function toggleCcBccFields() {
            const ccWrapper = document.getElementById('ccFieldWrapper');
            const bccWrapper = document.getElementById('bccFieldWrapper');

            ccWrapper.classList.toggle('hidden');
            bccWrapper.classList.toggle('hidden');
        }

        document.getElementById('fileAttachments').addEventListener('change', function(e) {
            const output = document.getElementById('selectedFiles');
            output.innerHTML = '';
            if (this.files.length > 0) {
                Array.from(this.files).forEach(file => {
                    output.innerHTML += `<div class="flex items-center gap-1.5 bg-blue-50/50 border border-blue-100 px-3 py-1.5 rounded-lg text-slate-700 font-medium">
                        <i class="fa-solid fa-file text-[11px] text-blue-500"></i> ${file.name} <span class="text-[10px] text-slate-400">(${roundSize(file.size)})</span>
                    </div>`;
                });
            }
        });

        function roundSize(bytes) {
            if (bytes < 1024) return bytes + ' Bytes';
            else if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
            else return (bytes / 1048576).toFixed(1) + ' MB';
        }

        function confirmDelete(uid) {
            Swal.fire({
                title: 'Pindahkan ke Sampah?',
                text: "Email ini akan dipindahkan ke folder Trash server.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteUid').value = uid;
                    document.getElementById('deleteEmailForm').submit();
                }
            });
        }

        function openEmailModal(button) {
            const modal = document.getElementById('emailModal');
            const from = button.getAttribute('data-from');
            const subject = button.getAttribute('data-subject');
            const date = button.getAttribute('data-date');
            const body = atob(button.getAttribute('data-body'));
            const attachments = JSON.parse(button.getAttribute('data-attachments') || '[]');

            document.getElementById('modalFrom').innerText = `Dari: ${from}`;
            document.getElementById('modalSubject').innerText = subject;
            document.getElementById('modalDate').innerText = date;

            const iframe = document.getElementById('modalBodyIframe');
            const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
            iframeDoc.open();
            iframeDoc.write(
                '<style>' +
                'body { font-family: ui-sans-serif, system-ui, sans-serif; color: #334155; font-size: 14px; line-height: 1.5; padding: 4px; }' +
                'img { max-width: 100%; height: auto; }' +
                '</style>' +
                body
            );
            iframeDoc.close();

            const attachmentSection = document.getElementById('attachmentSection');
            const attachmentList = document.getElementById('attachmentList');
            attachmentList.innerHTML = '';

            if (attachments.length > 0) {
                attachmentSection.classList.remove('hidden');
                attachments.forEach(file => {
                    const downloadLink = `data:application/octet-stream;base64,${file.content}`;
                    attachmentList.innerHTML += `
                        <a href="${downloadLink}" download="${file.name}" class="flex items-center justify-between p-2.5 border border-slate-200 hover:border-blue-400 rounded-xl bg-slate-50/50 hover:bg-blue-50/20 group transition-all">
                            <div class="flex items-center gap-2 min-w-0">
                                <div class="w-8 h-8 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate-400 group-hover:text-blue-500 group-hover:border-blue-200 shrink-0">
                                    <i class="fa-regular fa-file"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs font-bold text-slate-700 truncate">${file.name}</p>
                                    <p class="text-[10px] text-slate-400">${file.size}</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-circle-arrow-down text-slate-400 group-hover:text-blue-500 text-sm px-2"></i>
                        </a>
                    `;
                });
            } else {
                attachmentSection.classList.add('hidden');
            }

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeEmailModal() {
            const modal = document.getElementById('emailModal');
            if (modal) modal.classList.add('hidden');
            document.body.style.overflow = '';
        }

        function toggleComposeModal() {
            const composeModal = document.getElementById('composeModal');
            const floatingBtn = document.getElementById('floatingComposeBtn'); // Tambahan
            if (!composeModal) return;

            composeModal.classList.toggle('hidden');

            if (!composeModal.classList.contains('hidden')) {
                document.body.style.overflow = 'hidden';
                if (floatingBtn) floatingBtn.classList.add('hidden'); // Sembunyikan tombol pensil saat nulis
            } else {
                document.body.style.overflow = '';
                if (floatingBtn) floatingBtn.classList.remove('hidden'); // Munculkan kembali saat modal tutup
                resetComposeForm();
                if (typeof restoreNormalComposeSize === 'function') restoreNormalComposeSize();
            }
        }

        function resetComposeForm() {
            const composeForm = document.querySelector('#composeModal form');
            if (composeForm) {
                composeForm.reset();

                const bodyTextarea = composeForm.querySelector('textarea[name="body"]');
                if (bodyTextarea) bodyTextarea.value = '';

                const output = document.getElementById('selectedFiles');
                if (output) output.innerHTML = '';

                const fileInput = document.getElementById('fileAttachments');
                if (fileInput) fileInput.value = '';

                const ccWrapper = document.getElementById('ccFieldWrapper');
                const bccWrapper = document.getElementById('bccFieldWrapper');
                if (ccWrapper) ccWrapper.classList.add('hidden');
                if (bccWrapper) bccWrapper.classList.add('hidden');
            }

            // Kembalikan judul ke default saat form di-reset/ditutup
            const modalTitle = document.getElementById('modalComposeTitle');
            if (modalTitle) {
                modalTitle.innerText = 'Tulis Pesan Baru';
            }
        }

        function forwardEmail(button) {

            const modalTitle = document.getElementById('modalComposeTitle');
            if (modalTitle) {
                modalTitle.innerText = 'Teruskan Pesan';
            }
            // 1. Ambil data teks & detail email asli
            const oldSubject = button.getAttribute('data-subject') || '';
            const oldFrom = button.getAttribute('data-from') || '';
            const oldDate = button.getAttribute('data-date') || '';
            const oldTo = button.getAttribute('data-to') || '';

            let oldBody = '';
            try {
                oldBody = decodeURIComponent(escape(atob(button.getAttribute('data-body'))));
            } catch (e) {
                oldBody = atob(button.getAttribute('data-body'));
            }

            // Parse HTML email agar menjadi teks bersih
            const parser = new DOMParser();
            const doc = parser.parseFromString(oldBody, 'text/html');
            oldBody = doc.body.innerText || doc.body.textContent || '';
            oldBody = oldBody.replace(/\r/g, '').replace(/\n{3,}/g, '\n\n').trim();

            // Set Subject Baru dengan Prefix Fwd:
            let newSubject = oldSubject;
            if (!newSubject.toLowerCase().startsWith('fwd:')) {
                newSubject = 'Fwd: ' + newSubject;
            }

            // Format header forward sesuai permintaan Anda
            const forwardHeader = `---------- Forwarded message ---------
Dari: ${oldFrom}
Date: ${oldDate}
Subject: ${oldSubject}
To: ${oldTo}

`;

            // Gabungkan Header dengan Isi Pesan Asli
            const newBody = forwardHeader + oldBody;

            // 2. Ambil form compose & manipulasi input teks
            const composeForm = document.querySelector('#composeModal form');

            if (composeForm) {
                composeForm.querySelector('input[name="subject"]').value = newSubject;
                composeForm.querySelector('textarea[name="body"]').value = newBody;
                composeForm.querySelector('input[name="to"]').value = '';

                // 3. LOGIKA LAMPIRAN FILE (FORWARD ATTACHMENTS)
                const attachmentsRaw = button.getAttribute('data-attachments');
                const fileInput = document.getElementById('fileAttachments');
                const output = document.getElementById('selectedFiles');

                const ccInput = composeForm.querySelector('input[name="cc"]');
                const bccInput = composeForm.querySelector('input[name="bcc"]');
                if (ccInput) ccInput.value = '';
                if (bccInput) bccInput.value = '';

                // Reset lampiran lama di form modal
                if (fileInput) fileInput.value = '';
                if (output) output.innerHTML = '';

                if (attachmentsRaw && fileInput) {
                    try {
                        const attachments = JSON.parse(attachmentsRaw);

                        if (attachments.length > 0) {
                            const dataTransfer = new DataTransfer();

                            attachments.forEach(file => {
                                const byteCharacters = atob(file.content);
                                const byteNumbers = new Array(byteCharacters.length);
                                for (let i = 0; i < byteCharacters.length; i++) {
                                    byteNumbers[i] = byteCharacters.charCodeAt(i);
                                }
                                const byteArray = new Uint8Array(byteNumbers);

                                const blob = new Blob([byteArray], {
                                    type: 'application/octet-stream'
                                });
                                const fileObject = new File([blob], file.name, {
                                    type: 'application/octet-stream'
                                });

                                dataTransfer.items.add(fileObject);
                            });

                            fileInput.files = dataTransfer.files;
                            fileInput.dispatchEvent(new Event('change'));
                        }
                    } catch (err) {
                        console.error("Gagal memproses file lampiran forward:", err);
                    }
                }

                // Fokus ke input tujuan email
                setTimeout(() => {
                    composeForm.querySelector('input[name="to"]').focus();
                }, 300);
            }

            // Tampilkan modal
            const composeModal = document.getElementById('composeModal');
            if (composeModal && composeModal.classList.contains('hidden')) {
                toggleComposeModal();
            }
        }
    </script>

    <script>
        // Fungsi baru untuk menerapkan format dasar inline pada textarea
        function applyTextFormatting(property, value) {
            const textarea = document.getElementById('composeBody');
            if (textarea) {
                textarea.style[property] = value;
            }
        }

        // Fungsi toggle untuk Bold, Italic, dan Underline pada komponen visual textarea
        function applyToggleFormatting(property, value) {
            const textarea = document.getElementById('composeBody');
            if (textarea) {
                const currentValue = textarea.style[property];
                textarea.style[property] = (currentValue === value) ? '' : value;
            }
        }

        // Fungsi membersihkan seluruh gaya kustomisasi font kembali ke bawaan sistem
        function clearTextFormatting() {
            const textarea = document.getElementById('composeBody');
            if (textarea) {
                textarea.style.fontFamily = 'ui-sans-serif, system-ui, sans-serif';
                textarea.style.fontSize = '14px';
                textarea.style.fontWeight = 'normal';
                textarea.style.fontStyle = 'normal';
                textarea.style.textDecoration = 'none';
                textarea.style.textAlign = 'left';

                document.getElementById('fontStyleSelect').value = 'ui-sans-serif, system-ui, sans-serif';
                document.getElementById('fontSizeSelect').value = '14px';
            }
        }

        // Modifikasi fungsi reset yang sudah ada untuk mengembalikan setelan format teks
        function resetComposeForm() {
            const composeForm = document.querySelector('#composeModal form');
            if (composeForm) {
                composeForm.reset();

                const bodyTextarea = document.getElementById('composeBody');
                if (bodyTextarea) {
                    bodyTextarea.value = '';
                    // Reset style ketika form dibersihkan
                    clearTextFormatting();
                }

                const output = document.getElementById('selectedFiles');
                if (output) output.innerHTML = '';

                const fileInput = document.getElementById('fileAttachments');
                if (fileInput) fileInput.value = '';

                const ccWrapper = document.getElementById('ccFieldWrapper');
                const bccWrapper = document.getElementById('bccFieldWrapper');
                if (ccWrapper) ccWrapper.classList.add('hidden');
                if (bccWrapper) bccWrapper.classList.add('hidden');
            }

            const modalTitle = document.getElementById('modalComposeTitle');
            if (modalTitle) {
                modalTitle.innerText = 'Tulis Pesan Baru';
            }
        }
    </script>

    <script>
        let isComposeFullscreen = false;

        function toggleFullscreenCompose() {
            const modalBox = document.getElementById('modalBox');
            const icon = document.getElementById('fullscreenIcon');
            if (!modalBox) return;

            if (!isComposeFullscreen) {
                // --- MASUK MODE FULLSCREEN (Simetris Atas, Bawah, Kanan, Kiri) ---
                modalBox.classList.remove(
                    'md:inset-auto', 'md:top-1/2', 'md:left-1/2',
                    'md:-translate-x-1/2', 'md:-translate-y-1/2', 'md:max-w-4xl'
                );

                // Menentukan gap/jarak aman yang diinginkan (contoh: 2rem atau 32px)
                const gap = '2rem';

                modalBox.style.position = 'absolute';
                modalBox.style.top = gap;
                modalBox.style.bottom = gap;
                modalBox.style.right = gap;
                modalBox.style.maxHeight = 'none';
                modalBox.style.width = 'auto';

                // Rumus dinamis: Lebar sidebar + gap awal
                modalBox.style.left = `calc(260px + ${gap})`;

                if (icon) {
                    icon.classList.remove('fa-expand');
                    icon.classList.add('fa-compress');
                }
                isComposeFullscreen = true;
            } else {
                // --- KEMBALI KE MODE NORMAL ---
                restoreNormalComposeSize();
            }
        }

        function restoreNormalComposeSize() {
            const modalBox = document.getElementById('modalBox');
            const icon = document.getElementById('fullscreenIcon');
            if (!modalBox) return;

            // Bersihkan semua style inline mode fullscreen
            modalBox.style.position = '';
            modalBox.style.top = '';
            modalBox.style.bottom = '';
            modalBox.style.right = '';
            modalBox.style.left = '';
            modalBox.style.maxHeight = '';
            modalBox.style.width = '';

            // Kembalikan class alignment bawaan Tailwind (Kembali ke tengah layar)
            modalBox.classList.add(
                'md:inset-auto', 'md:top-1/2', 'md:left-1/2',
                'md:-translate-x-1/2', 'md:-translate-y-1/2', 'md:max-w-4xl'
            );

            if (icon) {
                icon.classList.remove('fa-compress');
                icon.classList.add('fa-expand');
            }
            isComposeFullscreen = false;
        }
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#2563eb'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#2563eb'
            });
        </script>
    @endif

    <script>
async function refreshCurrentFolder(button) {

    const icon = button.querySelector('i');

    // simpan class asli
    const originalClass = icon.className;

    // set loading state
    button.disabled = true;
    icon.className = "fa-solid fa-spinner fa-spin text-xs";

    try {

        const response = await fetch("{{ secure_url(route('webmail.refresh-folder', [], false)) }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                folder: "{{ $currentFolder }}"
            })
        });

        const result = await response.json();

        if (result.success) {
            window.location.reload();
        }

    } catch (error) {
        console.error(error);
    } finally {

        // kalau belum reload, balikin icon
        icon.className = originalClass;
        button.disabled = false;
    }
}
</script>
</body>

</html>
