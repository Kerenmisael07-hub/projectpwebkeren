@extends('layouts.app')

@section('title', 'Setting Home')
@section('header', 'Setting Home')

@section('content')
    <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <div class="max-w-3xl">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-sky-700">Pengaturan halaman depan</p>
            <h2 class="mt-3 text-2xl font-bold text-slate-900">Edit teks utama home page dari sini</h2>
            <p class="mt-3 text-sm leading-7 text-slate-500">Bagian ini hanya untuk mengganti teks penting di home page tanpa buka file Blade. Kalau nanti tidak cocok, kamu bisa hapus menu ini.</p>
        </div>

        <form method="POST" action="{{ route('home-settings.update') }}" enctype="multipart/form-data" class="mt-8 grid gap-6 xl:grid-cols-2">
            @csrf
            @method('PUT')

            <div class="space-y-4 rounded-3xl bg-slate-50 p-5 ring-1 ring-slate-200 xl:col-span-2">
                <h3 class="text-lg font-bold text-slate-900">Hero Section</h3>
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Badge</label>
                        <input type="text" name="hero_badge" value="{{ old('hero_badge', $settings['hero_badge']) }}" class="w-full rounded-2xl border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Judul utama</label>
                        <input type="text" name="hero_title" value="{{ old('hero_title', $settings['hero_title']) }}" class="w-full rounded-2xl border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
                    </div>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Deskripsi</label>
                    <textarea name="hero_description" rows="4" class="w-full rounded-2xl border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">{{ old('hero_description', $settings['hero_description']) }}</textarea>
                </div>
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Tombol utama</label>
                        <input type="text" name="primary_cta_text" value="{{ old('primary_cta_text', $settings['primary_cta_text']) }}" class="w-full rounded-2xl border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Tombol kedua</label>
                        <input type="text" name="secondary_cta_text" value="{{ old('secondary_cta_text', $settings['secondary_cta_text']) }}" class="w-full rounded-2xl border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
                    </div>
                </div>
            </div>

            <div class="space-y-4 rounded-3xl bg-white p-5 ring-1 ring-slate-200 xl:col-span-2">
                <h3 class="text-lg font-bold text-slate-900">Kendaraan</h3>
                <p class="text-sm text-slate-500">Gambar kendaraan diatur dari form data kendaraan, bukan dari setting home.</p>
            </div>

            <div class="space-y-4 rounded-3xl bg-white p-5 ring-1 ring-slate-200">
                <h3 class="text-lg font-bold text-slate-900">Kontak & Footer</h3>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Badge kontak</label>
                    <input type="text" name="contact_badge" value="{{ old('contact_badge', $settings['contact_badge']) }}" class="w-full rounded-2xl border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Judul kontak</label>
                    <input type="text" name="contact_title" value="{{ old('contact_title', $settings['contact_title']) }}" class="w-full rounded-2xl border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Alamat</label>
                    <input type="text" name="contact_address" value="{{ old('contact_address', $settings['contact_address']) }}" class="w-full rounded-2xl border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">WhatsApp</label>
                    <input type="text" name="contact_whatsapp" value="{{ old('contact_whatsapp', $settings['contact_whatsapp']) }}" class="w-full rounded-2xl border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Jam operasional</label>
                    <input type="text" name="contact_hours" value="{{ old('contact_hours', $settings['contact_hours']) }}" class="w-full rounded-2xl border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Footer kiri</label>
                    <input type="text" name="footer_left" value="{{ old('footer_left', $settings['footer_left']) }}" class="w-full rounded-2xl border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Footer kanan</label>
                    <input type="text" name="footer_right" value="{{ old('footer_right', $settings['footer_right']) }}" class="w-full rounded-2xl border-slate-300 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500">
                </div>
            </div>

            <div class="xl:col-span-2 flex flex-wrap gap-3">
                <button class="rounded-2xl bg-sky-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-sky-500">Simpan Setting Home</button>
                <a href="{{ route('home') }}" class="rounded-2xl border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-sky-300 hover:bg-sky-50">Lihat Home</a>
            </div>
        </form>
    </div>

@endsection