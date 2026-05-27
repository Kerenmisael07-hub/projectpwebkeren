@csrf
<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Kendaraan</label>
        <input type="text" name="nama" value="{{ old('nama', $kendaraan->nama ?? '') }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Tipe</label>
        <select name="tipe" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
            <option value="motor" @selected(old('tipe', $kendaraan->tipe ?? '') === 'motor')>Motor</option>
            <option value="mobil" @selected(old('tipe', $kendaraan->tipe ?? '') === 'mobil')>Mobil</option>
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Harga per Hari</label>
        <input type="number" name="harga_per_hari" value="{{ old('harga_per_hari', $kendaraan->harga_per_hari ?? '') }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
        <select name="status" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
            <option value="tersedia" @selected(old('status', $kendaraan->status ?? 'tersedia') === 'tersedia')>Tersedia</option>
            <option value="disewa" @selected(old('status', $kendaraan->status ?? '') === 'disewa')>Disewa</option>
        </select>
    </div>
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-semibold text-slate-700">Keterangan</label>
        <textarea name="keterangan" rows="4" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200">{{ old('keterangan', $kendaraan->keterangan ?? '') }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-semibold text-slate-700">Gambar</label>
        <input type="file" name="gambar" class="w-full rounded-2xl border border-dashed border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
        <div class="mt-3 aspect-square overflow-hidden rounded-3xl border border-slate-200 bg-white p-4">
            @if(!empty($kendaraan?->gambar))
                <img id="gambar-preview" src="{{ asset('storage/' . $kendaraan->gambar) }}" alt="Preview kendaraan" class="h-full w-full rounded-2xl object-contain bg-white">
            @else
                <div id="gambar-placeholder" class="flex h-full w-full items-center justify-center rounded-2xl text-sm text-slate-400">Preview gambar kendaraan</div>
                <img id="gambar-preview" src="" alt="Preview kendaraan" class="hidden h-full w-full rounded-2xl object-contain bg-white">
            @endif
        </div>
    </div>
</div>

<div class="mt-6 flex items-center gap-3">
    <button class="inline-flex items-center gap-2 rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white hover:bg-slate-700">
        Simpan
    </button>
    <a href="{{ route('kendaraan.index') }}" class="rounded-2xl bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700">Batal</a>
</div>

@push('scripts')
    <script>
        (() => {
            const input = document.querySelector('input[name="gambar"]');
            const preview = document.getElementById('gambar-preview');
            const placeholder = document.getElementById('gambar-placeholder');

            if (!input || !preview) {
                return;
            }

            input.addEventListener('change', () => {
                const file = input.files?.[0];

                if (!file) {
                    return;
                }

                const reader = new FileReader();
                reader.onload = (event) => {
                    preview.src = event.target.result;
                    preview.classList.remove('hidden');

                    if (placeholder) {
                        placeholder.classList.add('hidden');
                    }
                };
                reader.readAsDataURL(file);
            });
        })();
    </script>
@endpush
