<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class KendaraanController extends Controller
{
    public function index(Request $request): View
    {
        $query = Kendaraan::query()->latest();

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->string('tipe'));
        }

        $kendaraan = $query->paginate(10)->withQueryString();

        if (! auth()->user()?->isAdmin()) {
            return view('kendaraan.user-index', compact('kendaraan'));
        }

        return view('kendaraan.index', compact('kendaraan'));
    }

    public function create(): View
    {
        return view('kendaraan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'tipe' => ['required', 'in:motor,mobil'],
            'harga_per_hari' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:tersedia,disewa'],
            'keterangan' => ['nullable', 'string', 'max:1000'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kendaraan', 'public');
        }

        Kendaraan::create($data);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function edit(Kendaraan $kendaraan): View
    {
        return view('kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, Kendaraan $kendaraan): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'tipe' => ['required', 'in:motor,mobil'],
            'harga_per_hari' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:tersedia,disewa'],
            'keterangan' => ['nullable', 'string', 'max:1000'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('gambar')) {
            if ($kendaraan->gambar) {
                Storage::disk('public')->delete($kendaraan->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('kendaraan', 'public');
        }

        $kendaraan->update($data);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil diperbarui.');
    }

    public function destroy(Kendaraan $kendaraan): RedirectResponse
    {
        if ($kendaraan->rentals()->exists()) {
            return redirect()
                ->route('kendaraan.index')
                ->withErrors(['kendaraan' => 'Kendaraan ini tidak bisa dihapus karena masih dipakai pada data rental.']);
        }

        if ($kendaraan->gambar) {
            Storage::disk('public')->delete($kendaraan->gambar);
        }

        $kendaraan->delete();

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil dihapus.');
    }
}
