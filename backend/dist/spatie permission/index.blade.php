@extends('backend.layouts.index')
@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/pages/test.css') }}">
    <style>
        ul>li>a {
            text-decoration: none;
            color: black;
        }
    </style>
@endsection
@section('content')
    <h3>Spatie permission</h3>
    <ul>
        <li><a href="{{ route('admin.role.index') }}">roles . (role-has-permissions bu role uchun permission berish. roleni edit qilayotganda permission berish mumkin)</a></li>
        <li><a href="{{ route('admin.permission.index') }}">permission</a></li>
    </ul>
    <h3>Мурожаатлар</h3>
    <ul>
        <li><a href="{{ route('admin.help.list') }}">Янги келган мурожаатлар ({{$helpCount}}) та</a></li>
    </ul>
    <h3>Фойдаланувчининг ҳаракатлар тарихи</h3>
    <ul>
        <li><a href="{{ route('admin.action-log.index') }}">Фойдаланувчининг ҳаракатлар тарихи</a></li>
    </ul>
    <ul>
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    </ul>
    <h3>Фойдаланувчига тегишли қисм</h3>
    <ul>
        <li><a href="{{ route('admin.user.index') }}">Фойдаланувчилар рўйхати</a></li>
        <li><a href="{{ route('admin.position.index') }}">Фойдаланувчи лавозимини қўшиш</a></li>
        <li><a href="{{ route('admin.hr.index') }}">Филиал ходимлар рўйхати</a></li>
    </ul>
    <h3>Kurs</h3>
    <ul>
        <li><a href="{{ route('admin.course.index') }}">courses</a></li>
        <li><a href="{{ route('admin.course-category.index') }}">course kategoriyasi</a></li>
        <li><a href="{{ route('admin.course-instructor.index') }}">course instructor</a></li>

        {{-- <li><a href="{{ route('admin.course.index') }}">course</a></li> --}}
        {{-- <li><a href="{{ route('admin.course-curriculum-menu.index') }}">course curriculum menu</a></li> --}}
        {{-- <li><a href="{{ route('admin.course-enrollment.index') }}">course enrollment </a></li> --}}
        <li><a href="{{ route('admin.course-content.index') }}">Kurs content </a></li>
        {{-- <li><a href="{{ route('admin.course-content-sort.index') }}">course content nestable</a></li> --}}
        <li><a href="{{ route('admin.course.course-create') }}">course Yaratish</a></li>
        {{-- <li><a href="{{ route('admin.course.edit', 1) }}">course Edit qilish</a></li> --}}
    </ul>
    <h3>Edoopost</h3>
    <ul>
        <li><a href="{{ route('admin.post-category.index') }}">post kategoriyasi</a></li>
        <li><a href="{{ route('admin.post-category.create') }}">post kategoriyasini yaratish</a></li>
        <li><a href="{{ route('admin.post.index') }}">userlar tarafidan yaratilgan postlar</a></li>
        {{-- <li><a href="{{ route('admin.question.create') }}">savol yaratish</a></li> --}}
        <li><a href="{{ route('admin.question.index') }}">So'rovnoma yaratish</a></li>
    </ul>
    <h3>Kutubxona</h3>
    <ul>
        <li><a href="{{ route('admin.book-category.index') }}">Kitoblar kategoriyasi</a></li>
        <li><a href="{{ route('admin.book-category.create') }}">Yangi kategoriya qo'shish</a></li>
        <li><a href="{{ route('admin.book.index') }}">Barcha kitoblar</a></li>
        <li><a href="{{ route('admin.book.create') }}">Yangi kitob qo'shish</a></li>
    </ul>
    <h3>Meyoriy hujjatlar</h3>
    <ul>
        <li><a href="{{ route('admin.document-category.index') }}">Hujjatlar kategoriyasi</a></li>
        <li><a href="{{ route('admin.document.index') }}">Barcha mavjud hujjatlar</a></li>
    </ul>
    <h3>Video qo'llanmalar</h3>
    <ul>
        <li><a href="{{ route('admin.video-category.index') }}">Videolar kategoriyasi</a></li>
        <li><a href="{{ route('admin.video-category.create') }}">Yangi kategoriya qo'shish</a></li>
        <li><a href="{{ route('admin.video.index') }}">Barcha videolar</a></li>
        <li><a href="{{ route('admin.video.create') }}">Yangi videolar qo'shish</a></li>
    </ul>
    <h3>Test</h3>
    <ul>

        {{-- <li style="color:red;"><a href="{{ route('test.view', auth()->user()->uuid) }}">Test-player view</a></li> --}}
        <li style="color:red;"><a href="{{ route('admin.test-topic.index') }}">yangi test topiki qushish ->
                <strong>DB:</strong> test_topics</a></li>
        <li style="color:red;"><a href="{{ route('admin.test-questions.create') }}">yangi test savoli qushish - >
                <strong>DB:</strong> test_questions, test_options</a></li>
        <li style="color:red;"><a href="{{ route('admin.test-tag.index') }}">testga tag qo'shish -> <strong>DB:</strong>
                test_tags</a></li>
        <li><a href="{{ route('admin.test.create') }}">yangi test yaratish -> <strong>DB:</strong> test_names, test_tagged,
                test_settings</a></li>
        {{-- <li><a href="#">frontdan ishlatiladi -> <strong>DB:</strong> test_favorites, test_user_progress</a></li>
        <li><a href="#">foydalanuvchini enroll qilish -> <strong>DB:</strong> test_enrollment, test_user_progress</a> --}}
        </li>
    </ul>
    <h3>SCORM fayllar bilan ishlash</h3>
    <div>
        <div class="form-group">
            @if ($errors->has('zip'))
                <span class="text-danger">{{ $errors->first('zip') }}</span>
            @endif
        </div>
        <form action="/scorm-control/upload" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="zip" id="">
            <button type="submit">send</button>
        </form>
    </div>
    <h3>Kelajakdagi proyektlar:</h3>
    <ul>
        <li>Har bir xodimni qayerga kirdi, qaysi kursni tugatdi, qaysi kitobni uqidi otcheti olish</li>
        <li>xodim profiliga tanga (ball) sistemasini quyish, qancha ko'p kitob uqisa, kurs tugatsa, elektron tanga yig'ishi
        </li>
        <li>bush ish urinlari bazasini yaratish -> yellowpagega - xodimlar uzlari ochiq urinlarga qiziqish bildirishi yoki
            kimgadur junatishi mumkin</li>
        <li>Foydali qurollar qismida, kirill lotin, lotin kirill uzgartiruvchi, arizalardan namunalar ruyhati, kredit
            kalkulyatori vhk lar, valyuta konvertori
            quyiladi</li>
        <li>dashboard kurinishida qaysi filial aktiv, eng kop uqilgan post egalari reytingi dinamikasi vhk yasash</li>
        <li>HRlar uchun alohida xodim kiritishga ruhsat berish</li>
        <li>savolnoma yaratish, viloyatlar kesimida, lavozim kesimida olina bilinishi</li>
        <li> spa ga olib borish platformani keyinchalik (misol uchun vue js intertia js bilan)</li>
        <li>birinchi sertifikatli kursni excel kursidan, bank mahsulotlaridan boshlash</li>
        <li>manager uchun alohida profil yasash, misol uchun Najibudin Burievich kirsa dashboard statistikalari, filterlar
            kura olishi kerak. Ohirgi sertifikat olgan xodimlarni ruyhati, birinchi kim ketyabdi, qaysi viloyat, filial, etc
        </li>
        <li>codelarni refactor qilish kerak, single purpose qilib, nomlarini tushunsa buladigan qilib, commentlar yozib</li>
        <li>platformani ishlatish uchun yuriqnoma qilinishi kerak</li>
        <li>umumiy fayllar ulashish platformasi ham qilinishi mumkin, xodimlar misol uchun ichki tarmoq orqali tahlil.exe ni
            yuklab olishlari mumkin, etc, aslida shu tahlildan olingan malumotlarini platformaga quyish kerak, tahlildan
            kura web pageda tezroq va dostupno buladi hammaga</li>
        <li>adminga osonlashtirish uchun iloji boricha, qushishlar user blade fayllariga role:admin bilan yozilorishi kerak
        </li>
    </ul>
@endsection
@section('script')
@endsection
