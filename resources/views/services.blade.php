@extends('layouts.landing')

@section('title', 'Comprehensive IT Solutions')

@section('styles')
    <style>
        /* CSS BARU UNTUK MEMBUAT GARIS BIRU DI ATAS CARD */
        .card-header-blue {
            position: relative;
            padding-top: 15px;
        }

        .card-header-blue::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 15px;
            background: linear-gradient(90deg, #E0F2FE 0%, #BFDBFE 50%, #E0F2FE 100%);
            background-color: #BFDBFE;
            border-radius: 1rem 1rem 0 0;
            clip-path: inset(0 0 -10px 0);
        }

        .card-content-wrapper {
            position: relative;
            z-index: 10;
            padding-top: 10px;
        }

        /* Menggunakan class group untuk mengontrol pergerakan panah */
        .btn-pelajari-lanjut .ri-arrow-right-line {
            transform: translateX(0);
            transition: transform 0.3s;
        }

        .btn-pelajari-lanjut:hover .ri-arrow-right-line {
            transform: translateX(4px);
            color: #2563eb;
        }

        /* Menyembunyikan Scrollbar default browser agar terlihat bersih, tapi tetap bisa di-scroll */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endsection

@section('content')

    {{-- Top Hero Section --}}
    <section class="w-full pt-32 pb-20 mb-10 md:pt-36 md:pb-32 md:mb-28 px-4 bg-gray-50 text-center">
        <div class="max-w-4xl mx-auto">

            <span
                class="inline-flex items-center gap-2 text-[13px] font-semibold text-blue-600 bg-blue-100 px-3.5 py-1.5 rounded-full mb-6 shadow-sm">
                Our Services
            </span>

            <h1 class="text-4xl md:text-5xl lg:text-[54px] font-extrabold mt-2 text-gray-900 leading-[1.15] tracking-tight">
                Comprehensive <br> <span class="text-blue-600">IT Solutions</span>
            </h1>

            <p class="mt-6 text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                From cloud infrastructure to custom development and strategic consulting, we provide everything you need for
                your digital transformation journey.
            </p>

        </div>
    </section>

    {{-- Services Grid / Slider --}}
    <section class="w-full pb-24 -mt-16 md:-mt-24 relative z-10">

        {{-- 
            CONTAINER UTAMA:
            1. Mobile (Default): 
               - flex: Agar berjejer ke samping.
               - overflow-x-auto: Agar bisa di-scroll ke samping.
               - snap-x snap-mandatory: Agar saat digeser berhenti pas di tengah card.
               - gap-4: Jarak antar card.
               - px-6: Padding container kiri kanan.
               - pb-10: Padding bawah agar bayangan card tidak terpotong overflow.
            
            2. Desktop (md:):
               - md:grid: Kembali ke mode grid.
               - md:grid-cols-3: 3 kolom.
               - md:overflow-visible: Scroll samping dimatikan.
        --}}
        <div
            class="max-w-7xl mx-auto 
                    flex flex-nowrap overflow-x-auto snap-x snap-mandatory gap-4 px-6 pb-10 scrollbar-hide
                    md:grid md:grid-cols-3 md:gap-8 md:overflow-visible md:px-4 md:pb-0">

            @php
                $cards = [
                    [
                        'icon' => 'ri-cloud-line',
                        'title' => 'Cloud Services',
                        'desc' => 'Complete cloud infrastructure for your hosting and application needs',
                        'link' => '/services/cloud-services',
                        'items' => [
                            [
                                'title' => 'Domain Registration',
                                'detail' =>
                                    'Register domain with various extensions (.com, .id, .net, etc) and free privacy protection',
                            ],
                            [
                                'title' => 'VPS Hosting',
                                'detail' =>
                                    'Virtual Private Server with ultra-fast SSD NVMe, full root access, and flexible scalability',
                            ],
                            [
                                'title' => 'cPanel Hosting',
                                'detail' => 'Web hosting with cPanel for easy website, email, and database management',
                            ],
                            [
                                'title' => 'SaaS Platform',
                                'detail' =>
                                    'Ready-to-use software-as-a-service solutions with API integration and automatic updates',
                            ],
                        ],
                    ],
                    [
                        'icon' => 'ri-code-s-slash-line',
                        'title' => 'Custom Development',
                        'desc' => 'Custom application development tailored to your specific business needs',
                        'link' => '/services/custom-development',
                        'items' => [
                            [
                                'title' => 'Mobile App Development',
                                'detail' => 'Native and hybrid mobile applications for iOS & Android with modern UI/UX',
                            ],
                            [
                                'title' => 'Web Application',
                                'detail' =>
                                    'Progressive web apps, admin dashboards, and custom information systems with cutting-edge technology',
                            ],
                            [
                                'title' => 'API Development',
                                'detail' => 'RESTful API and microservices for system integration and high scalability',
                            ],
                            [
                                'title' => 'UI/UX Design',
                                'detail' => 'Design system, prototyping, and user testing for optimal user experience',
                            ],
                        ],
                    ],
                    [
                        'icon' => 'ri-bar-chart-2-line',
                        'title' => 'Consulting & Strategy',
                        'desc' => 'Consulting services for digital transformation and human resource management',
                        'link' => '/services/consulting',
                        'items' => [
                            [
                                'title' => 'IT/IS Strategy Consulting',
                                'detail' =>
                                    'Digital transformation roadmap planning, IT infrastructure assessment, and technology stack selection',
                            ],
                            [
                                'title' => 'System Integration',
                                'detail' =>
                                    'Enterprise system integration consulting, migration strategy, and legacy system modernization',
                            ],
                            [
                                'title' => 'HC Management – KPI System',
                                'detail' =>
                                    'Key Performance Indicators system implementation for employee performance evaluation and monitoring',
                            ],
                            [
                                'title' => 'HC Management – OKR Framework',
                                'detail' =>
                                    'Objectives and Key Results implementation for organizational goal alignment and progress tracking',
                            ],
                        ],
                    ],
                ];
            @endphp

            @foreach ($cards as $card)
                {{-- 
                    ITEM CARD:
                    1. Mobile:
                       - flex-shrink-0: Agar ukuran card tidak mengecil mengikuti container.
                       - w-[85%]: Lebar card 85% layar agar card sebelah kanan terlihat sedikit (peeking).
                       - snap-center: Agar card berhenti di tengah layar saat digeser.
                    2. Desktop (md:):
                       - md:w-auto: Lebar otomatis mengikuti grid.
                --}}
                <div
                    class="flex-shrink-0 w-[85%] md:w-auto snap-center
                            group bg-white p-6 md:p-8 rounded-2xl shadow-md border border-gray-100 
                            hover:border-blue-300 hover:shadow-xl hover:shadow-blue-500/10 
                            transition-all duration-300 flex flex-col h-full card-header-blue">

                    <div class="card-content-wrapper flex flex-col flex-1">

                        <div class="flex items-center gap-4 mb-7">
                            <div
                                class="w-14 h-14 bg-blue-600 text-white rounded-xl flex items-center justify-center text-3xl shrink-0
                                        transition-transform duration-300 group-hover:scale-110">
                                <i class="{{ $card['icon'] }}"></i>
                            </div>

                            <div>
                                <h2 class="font-bold text-lg md:text-xl text-gray-900">{{ $card['title'] }}</h2>
                                <p class="text-gray-600 text-sm mt-1 leading-snug">{{ $card['desc'] }}</p>
                            </div>
                        </div>

                        <div class="space-y-6 text-gray-700 flex-1">
                            @foreach ($card['items'] as $item)
                                <div class="flex flex-col">
                                    <div class="flex items-start gap-2 mb-1">
                                        <i class="ri-checkbox-blank-circle-fill text-blue-500 text-[6px] mt-2 shrink-0"></i>
                                        <h4 class="font-bold text-sm leading-snug text-gray-900">{{ $item['title'] }}</h4>
                                    </div>
                                    <p class="text-sm text-gray-600 ms-5 leading-relaxed">{{ $item['detail'] }}</p>
                                </div>
                            @endforeach
                        </div>

                        {{-- BUTTON PELAJARI LEBIH LANJUT --}}
                        <a href="{{ url('/portfolio') }}"
                            class="btn-pelajari-lanjut group w-full mt-8 py-3 
            bg-white border border-gray-300 rounded-lg shadow-sm 
            text-gray-700 font-semibold text-center 
            hover:bg-blue-50 hover:border-blue-500 
            hover:text-blue-600 transition-all duration-300
            flex items-center justify-center relative">

                            Lihat Portfolio
                            <i
                                class="ri-arrow-right-line text-lg absolute right-4 transition-transform duration-300 text-gray-700 group-hover:text-blue-600"></i>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </section>

    {{-- CTA BOTTOM --}}
    <section class="w-full py-24 px-4 bg-gray-50">
        <div class="max-w-4xl mx-auto text-center">

            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight">
                Need Help Choosing the Right Service?
            </h2>

            <p class="text-gray-600 mt-4 max-w-xl mx-auto leading-relaxed">
                Our expert team is ready to help you find the perfect solution for your business needs.
            </p>

            <div class="flex gap-4 justify-center mt-10 flex-wrap">

                <a href="https://wa.me/6281289537549?text=Halo%20Tim%20Sales%20FutureCloud%2C%20saya%20tertarik%20dengan%20layanan%20Anda%20dan%20ingin%20berkonsultasi.%20Terima%20kasih."
                    target="_blank"
                    class="px-7 py-3 bg-blue-600 text-white rounded-lg shadow font-semibold hover:bg-blue-700 transition flex items-center gap-2">
                    <i class="ri-whatsapp-line text-lg"></i> Contact Sales
                </a>

            </div>

        </div>
    </section>

@endsection
