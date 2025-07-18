@extends('layouts.app')

@section('content')
<div class="relative h-screen bg-center bg-cover" style="background-image: url('{{ asset('images/hero.jpg') }}')">
  <!-- تدرج فوق الصورة -->
  <div class="absolute inset-0 bg-gradient-to-b from-black/60 to-black/80"></div>

  <!-- المحتوى -->
  <div class="relative z-10 flex flex-col items-center justify-center h-full text-white px-6 text-center animate-fade-in">
    <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold mb-6 drop-shadow-lg">
      بيع وشراء الشقق بسهولة
    </h1>
    <p class="text-lg sm:text-xl md:text-2xl mb-10 max-w-2xl drop-shadow-md">
      ابحث عن منزلك المثالي أو اعرض عقارك على أكبر جمهور بسهولة وسرعة.
    </p>

    <div class="flex flex-wrap justify-center gap-4 mb-10">
      @guest
        <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-full shadow-md transition duration-300">
          تسجيل الدخول
        </a>
        <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-full shadow-md transition duration-300">
          إنشاء حساب
        </a>
        <a href="{{ route('listings.index') }}" class="bg-white text-gray-800 hover:bg-gray-200 px-6 py-3 rounded-full shadow-md transition duration-300">
          تصفح كزائر
        </a>
      @endguest

      @auth
        <a href="{{ route('dashboard') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-full shadow-md transition duration-300">
          لوحة التحكم
        </a>
      @endauth
    </div>

    <!-- زر تمرير للأسفل -->
    <a href="#next-section" class="mt-4 animate-bounce text-white hover:text-gray-300 transition duration-300">
      <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
      </svg>
    </a>
  </div>
</div>

<!-- قسم التالي -->
<div id="next-section" class="py-20 bg-gray-100 text-center">
  <h2 class="text-3xl font-semibold mb-6">لماذا نحن الأفضل؟</h2>
  <p class="text-lg max-w-2xl mx-auto">
    نحن نقدم منصة موثوقة وسهلة الاستخدام لتسهيل عملية بيع وشراء العقارات بكل أمان واحترافية.
  </p>
</div>
@endsection
