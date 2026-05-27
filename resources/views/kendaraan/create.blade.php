@extends('layouts.app')

@section('title', 'Tambah Kendaraan')
@section('header', 'Tambah Kendaraan')

@section('content')
    <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        @php($kendaraan = null)
        <form action="{{ route('kendaraan.store') }}" method="POST" enctype="multipart/form-data">
            @include('kendaraan._form')
        </form>
    </div>
@endsection
