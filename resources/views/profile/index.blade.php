@extends('layouts.app')

@section('title', 'Profile Admin')
@section('header', 'Profile Admin')

@section('content')
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200 lg:col-span-2">
            <h2 class="text-lg font-bold text-slate-900">Informasi Admin</h2>
            <p class="mt-1 text-sm text-slate-500">Perbarui data akun admin yang digunakan untuk login.</p>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-5">
                @csrf
                @method('PUT')

                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <label class="mb-3 block text-sm font-semibold text-slate-700">Foto Profile</label>

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                        <div id="profile-preview-wrapper">
                            @if($user->profile_photo)
                                <img id="profile-preview-image" src="{{ asset('storage/' . $user->profile_photo) }}" alt="Foto Admin" class="aspect-square h-32 w-32 rounded-3xl bg-white object-contain p-2 ring-4 ring-white shadow-sm">
                            @else
                                <div id="profile-preview-fallback" class="flex aspect-square h-32 w-32 items-center justify-center rounded-3xl bg-white text-2xl font-bold text-slate-700 ring-4 ring-white shadow-sm">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 space-y-3">
                            <input
                                type="file"
                                name="profile_photo"
                                id="profile_photo_input"
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
                            >
                            <label class="inline-flex items-center gap-2 text-sm text-slate-600">
                                <input type="checkbox" name="remove_photo" value="1" class="rounded border-slate-300 text-sky-600 focus:ring-sky-500">
                                Hapus foto profile saat ini
                            </label>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Admin</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
                    >
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Password Baru</label>
                        <input
                            type="password"
                            name="password"
                            placeholder="Kosongkan jika tidak diganti"
                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Konfirmasi Password</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            placeholder="Ulangi password baru"
                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200"
                        >
                    </div>
                </div>

                <button class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                    Simpan Perubahan
                </button>
            </form>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h3 class="text-base font-bold text-slate-900">Ringkasan Akun</h3>
            <dl class="mt-4 space-y-4 text-sm">
                <div>
                    <dt class="font-medium text-slate-500">Nama</dt>
                    <dd class="mt-1 font-semibold text-slate-800">{{ $user->name }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-slate-500">Email</dt>
                    <dd class="mt-1 font-semibold text-slate-800">{{ $user->email }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-slate-500">Role</dt>
                    <dd class="mt-1">
                        <span class="rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold text-sky-800">Admin</span>
                    </dd>
                </div>
                <div>
                    <dt class="font-medium text-slate-500">Foto Profile</dt>
                    <dd class="mt-1 text-slate-800">{{ $user->profile_photo ? 'Sudah diatur' : 'Belum ada foto' }}</dd>
                </div>
            </dl>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const photoInput = document.getElementById('profile_photo_input');
    const previewWrapper = document.getElementById('profile-preview-wrapper');

    if (photoInput && previewWrapper) {
        photoInput.addEventListener('change', function (event) {
            const [file] = event.target.files || [];

            if (!file) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {
                previewWrapper.innerHTML = `<img id="profile-preview-image" src="${e.target.result}" alt="Preview Foto Admin" class="aspect-square h-32 w-32 rounded-3xl bg-white object-contain p-2 ring-4 ring-white shadow-sm">`;
            };

            reader.readAsDataURL(file);
        });
    }
</script>
@endpush
