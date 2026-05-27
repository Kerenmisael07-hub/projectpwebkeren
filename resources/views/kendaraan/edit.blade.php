@extends('layouts.app')

@section('title', 'Edit Kendaraan')
@section('header', 'Edit Kendaraan')

@section('content')
    <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <form action="{{ route('kendaraan.update', $kendaraan) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('kendaraan._form')
        </form>
    </div>
@endsection
