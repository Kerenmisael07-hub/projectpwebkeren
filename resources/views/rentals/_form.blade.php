@csrf
@php($vehicleOptions = $kendaraanList ?? $kendaraan ?? collect())
<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Customer</label>
        <select name="customer_id" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
            <option value="">Pilih customer</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" @selected(old('customer_id', $rental->customer_id ?? '') == $customer->id)>{{ $customer->nama }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Kendaraan</label>
        <select name="kendaraan_id" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
            <option value="">Pilih kendaraan</option>
            @foreach($vehicleOptions as $item)
                <option value="{{ $item->id }}" @selected(old('kendaraan_id', $rental->kendaraan_id ?? '') == $item->id)>
                    {{ $item->nama }} - Rp {{ number_format($item->harga_per_hari, 0, ',', '.') }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Sewa</label>
        <input type="date" name="tgl_sewa" value="{{ old('tgl_sewa', isset($rental) ? $rental->tgl_sewa?->format('Y-m-d') : '') }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Kembali</label>
        <input type="date" name="tgl_kembali" value="{{ old('tgl_kembali', isset($rental) ? $rental->tgl_kembali?->format('Y-m-d') : '') }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
    </div>
    @isset($rental)
        <div class="md:col-span-2">
            <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
            <select name="status" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200">
                <option value="aktif" @selected(old('status', $rental->status) === 'aktif')>Aktif</option>
                <option value="selesai" @selected(old('status', $rental->status) === 'selesai')>Selesai</option>
                <option value="terlambat" @selected(old('status', $rental->status) === 'terlambat')>Terlambat</option>
            </select>
        </div>
    @endisset
</div>

<div class="mt-6 flex items-center gap-3">
    <button class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">Simpan</button>
    <a href="{{ route('rentals.index') }}" class="rounded-2xl bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700">Batal</a>
</div>
