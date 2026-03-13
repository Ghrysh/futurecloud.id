@extends('layouts.landing')

@section('title', 'About Us - Building the Future of Cloud Technology')

@section('styles')
<style>
    /* Utility Scrollbar Hide */
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

    {{-- 1. Hero Section --}}
    <section class="w-full pt-32 pb-20 mb-10 md:pt-36 md:pb-32 md:mb-28 px-4 bg-gray-50 text-center">
        <div class="max-w-4xl mx-auto">
            
            <span class="inline-flex items-center gap-2 text-[10px] md:text-[13px] font-semibold text-blue-600 bg-blue-100 px-3 py-1.5 rounded-full mb-6 shadow-sm">
                About Us
            </span>
            
            <h1 class="text-3xl md:text-5xl lg:text-[54px] font-extrabold mt-2 text-gray-900 leading-[1.15] tracking-tight">
                Building the Future of <br><span class="text-blue-600">Cloud Technology</span>
            </h1>
            <p class="mt-6 text-sm md:text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed px-2">
                PT Berkah Teknologi Terdepan (FutureCloud.id) is Indonesia's leading provider of next-generation cloud infrastructure, custom development, and strategic IT consulting services.
            </p>
        </div>
    </section>

    {{-- 2. Mission & Vision (Horizontal Scroll Mobile) --}}
    <section class="w-full pb-16 px-0 md:px-4 -mt-16 md:-mt-24 relative z-10">
        
        <!-- 
            CONTAINER: 
            Mobile: Flex Horizontal Scroll (85% width per card)
            Desktop: Grid 2 Columns 
        -->
        <div class="max-w-7xl mx-auto 
                    flex flex-nowrap overflow-x-auto snap-x snap-mandatory gap-4 px-6 pb-8 scrollbar-hide
                    md:grid md:grid-cols-2 md:gap-8 md:px-4 md:pb-0 md:overflow-visible">

            {{-- Mission Card --}}
            <div class="flex-shrink-0 w-[85%] md:w-auto snap-center
                        bg-white p-6 md:p-8 rounded-2xl shadow-xl border border-gray-100 flex flex-col md:flex-row items-start gap-4 h-full">
                <div class="w-12 h-12 md:w-16 md:h-16 shrink-0 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-xl md:text-2xl border-2 border-blue-200">
                    <i class="ri-target-line"></i>
                </div>
                <div>
                    <h2 class="font-bold text-lg md:text-2xl text-gray-900 mt-1">Our Mission</h2>
                    <p class="text-gray-600 text-sm md:text-base mt-2 leading-relaxed">
                        To empower businesses with cutting-edge cloud technology and innovative solutions that drive digital transformation, enhance operational efficiency, and accelerate growth.
                    </p>
                </div>
            </div>

            {{-- Vision Card --}}
            <div class="flex-shrink-0 w-[85%] md:w-auto snap-center
                        bg-white p-6 md:p-8 rounded-2xl shadow-xl border border-gray-100 flex flex-col md:flex-row items-start gap-4 h-full">
                <div class="w-12 h-12 md:w-16 md:h-16 shrink-0 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-xl md:text-2xl border-2 border-blue-200">
                    <i class="ri-eye-line"></i>
                </div>
                <div>
                    <h2 class="font-bold text-lg md:text-2xl text-gray-900 mt-1">Our Vision</h2>
                    <p class="text-gray-600 text-sm md:text-base mt-2 leading-relaxed">
                        To be Southeast Asia's most trusted technology partner, recognized for delivering exceptional cloud solutions, fostering innovation, and creating lasting value.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. Stats Section --}}
    <section class="w-full py-12 md:py-20 px-4">
        <div class="max-w-5xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 text-center">
            
            <div class="border-r border-gray-200 md:border-none p-2">
                <h3 class="text-3xl md:text-4xl font-extrabold text-blue-600">500+</h3>
                <p class="text-gray-700 mt-1 text-xs md:text-base font-medium">Projects Delivered</p>
            </div>
            <div class="md:border-r md:border-gray-200 p-2"> {{-- Border logic adjusted --}}
                <h3 class="text-3xl md:text-4xl font-extrabold text-blue-600">98%</h3>
                <p class="text-gray-700 mt-1 text-xs md:text-base font-medium">Client Satisfaction</p>
            </div>
            <div class="border-r border-gray-200 md:border-none p-2">
                <h3 class="text-3xl md:text-4xl font-extrabold text-blue-600">50+</h3>
                <p class="text-gray-700 mt-1 text-xs md:text-base font-medium">Expert Team</p>
            </div>
            <div class="p-2">
                <h3 class="text-3xl md:text-4xl font-extrabold text-blue-600">24/7</h3>
                <p class="text-gray-700 mt-1 text-xs md:text-base font-medium">Support Available</p>
            </div>
        </div>
    </section>

    {{-- 4. Core Values (Grid 2 Kolom Mobile) --}}
    <section class="w-full py-16 md:py-20 px-4 bg-white border-t border-b border-gray-100">
        <h2 class="text-center text-2xl md:text-3xl font-bold text-gray-900 mb-2">Our Core Values</h2>
        <p class="text-center text-sm md:text-base text-gray-600 mb-10 md:mb-12">The principles that guide everything we do</p>

        <!-- Grid: 2 Kolom Mobile, 4 Kolom Desktop -->
        <div class="max-w-7xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-8">
            
            @php
                $values = [
                    ['icon' => 'ri-compasses-line', 'title' => 'Innovation', 'detail' => 'Pushing boundaries to deliver cutting-edge solutions.'],
                    ['icon' => 'ri-shield-line', 'title' => 'Security', 'detail' => 'Enterprise-grade protection is our top priority.'],
                    ['icon' => 'ri-group-line', 'title' => 'Success', 'detail' => 'Dedicated support to ensure your business goals.'],
                    ['icon' => 'ri-medal-line', 'title' => 'Excellence', 'detail' => 'Highest standards in code quality and service.'],
                ];
            @endphp

            @foreach ($values as $value)
                <div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border text-center transition-all duration-300 hover:shadow-lg hover:border-blue-500">
                    <div class="w-10 h-10 md:w-12 md:h-12 mx-auto bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-lg md:text-xl mb-3 md:mb-4 border border-blue-200">
                        <i class="{{ $value['icon'] }}"></i>
                    </div>
                    <h3 class="font-bold text-sm md:text-lg text-gray-900">{{ $value['title'] }}</h3>
                    <p class="text-gray-600 text-[10px] md:text-sm mt-2 leading-snug">{{ $value['detail'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 5. Our Journey (Timeline Responsive) --}}
    <section class="w-full py-16 md:py-20 px-4 bg-gray-50">
        <h2 class="text-center text-2xl md:text-3xl font-bold text-gray-900 mb-2">Our Journey</h2>
        <p class="text-center text-sm md:text-base text-gray-600 mb-10 md:mb-12">Key milestones in our continuous evolution</p>

        @php
            $milestones = [
                ['year' => 2018, 'title' => 'Founded', 'detail' => 'Established with a vision to revolutionize cloud in Indonesia'],
                ['year' => 2019, 'title' => 'Partnership', 'detail' => 'Secured partnerships with leading global cloud providers'],
                ['year' => 2021, 'title' => 'ISO Certified', 'detail' => 'Achieved ISO 27001 for information security management'],
                ['year' => 2023, 'title' => 'Expansion', 'detail' => 'Expanded operations across Southeast Asia (5 countries)'],
                ['year' => 2024, 'title' => 'AI Lab', 'detail' => 'Launched dedicated R&D division focusing on AI solutions'],
            ];
        @endphp

        <div class="max-w-4xl mx-auto relative px-0 md:px-4">
            {{-- Timeline Line: Left di Mobile, Center di Desktop --}}
            <div class="absolute left-6 md:left-1/2 md:-translate-x-1/2 top-0 h-full w-0.5 bg-gray-200"></div>

            @foreach ($milestones as $index => $milestone)
                @php
                    $isLeft = $index % 2 == 0;
                @endphp
                {{-- 
                    Container Milestone:
                    Mobile: Selalu flex-row biasa (kiri ke kanan)
                    Desktop: Alternating flex-row-reverse jika item kiri
                --}}
                <div class="flex flex-row md:{{ $isLeft ? 'flex-row' : 'flex-row-reverse' }} mb-8 md:mb-12 relative items-start md:items-center">
                    
                    {{-- Spacer untuk Desktop agar layout imbang --}}
                    <div class="hidden md:block w-1/2"></div>

                    {{-- Circle Point: Absolute left di Mobile, Relative Center di Desktop --}}
                    <div class="absolute left-6 md:left-1/2 -translate-x-1/2 w-8 h-8 md:w-12 md:h-12 bg-blue-600 rounded-full flex items-center justify-center text-white text-[10px] md:text-sm font-bold shadow-lg z-10 border-4 border-gray-50">
                        {{ $milestone['year'] }}
                    </div>
                    
                    {{-- Card Content --}}
                    {{-- Mobile: pl-12 (memberi ruang untuk garis di kiri). Desktop: menyesuaikan sisi --}}
                    <div class="w-full md:w-1/2 pl-12 md:pl-0 {{ $isLeft ? 'md:pr-12 md:text-right' : 'md:pl-12 md:text-left' }}">
                        <div class="bg-white p-4 md:p-5 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-all">
                            <h3 class="font-bold text-sm md:text-lg text-gray-900 mb-1">{{ $milestone['title'] }}</h3>
                            <p class="text-gray-600 text-xs md:text-sm leading-snug">{{ $milestone['detail'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 6. Visit Our Office --}}
    <section class="w-full py-16 md:py-20 px-4 bg-white">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white p-6 md:p-10 rounded-2xl shadow-xl border border-gray-100 text-center">

                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Visit Our Office</h2>
                <p class="text-sm md:text-base text-gray-600 mb-8 md:mb-10">We would love to meet you in person</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 text-left">
                    
                    {{-- Left --}}
                    <div>
                        <h3 class="font-bold text-base md:text-lg text-gray-900 mb-2">PT Berkah Teknologi Terdepan</h3>
                        <address class="text-gray-600 text-xs md:text-sm not-italic leading-relaxed">
                            Gedung Jaya Lomba 5 unit A.6<br>
                            JL. M H Thamrin No.12<br>
                            Jakarta Pusat 10340, Indonesia
                        </address>
                    </div>

                    {{-- Right --}}
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <i class="ri-phone-line text-lg md:text-xl text-blue-600"></i>
                            <div>
                                <p class="font-bold text-sm md:text-base text-gray-900">Phone</p>
                                <p class="text-gray-600 text-xs md:text-sm">(+62) 815-2022-225</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <i class="ri-mail-line text-lg md:text-xl text-blue-600"></i>
                            <div>
                                <p class="font-bold text-sm md:text-base text-gray-900">Email</p>
                                <p class="text-gray-600 text-xs md:text-sm">info@futurecloud.id</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection