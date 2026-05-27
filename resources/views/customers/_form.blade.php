@csrf
<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Nama</label>
        <input type="text" name="nama" value="{{ old('nama', $customer->nama ?? '') }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
        <input type="email" name="email" value="{{ old('email', $customer->email ?? '') }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">No HP</label>
        <input type="text" name="no_hp" value="{{ old('no_hp', $customer->no_hp ?? '') }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
    </div>
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-semibold text-slate-700">Alamat</label>
        <textarea name="alamat" rows="4" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200">{{ old('alamat', $customer->alamat ?? '') }}</textarea>
    </div>
</div>

<div class="mt-6 flex items-center gap-3">
    <button class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">Simpan</button>
    <a href="{{ route('customers.index') }}" class="rounded-2xl bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700">Batal</a>
</div>
