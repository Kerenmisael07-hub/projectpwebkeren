@extends('layouts.app')

@section('title', 'Buat Rental')
@section('header', 'Buat Rental')

@section('content')
    <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        @php($rental = null)
        <form action="{{ route('rentals.store') }}" method="POST">
            @include('rentals._form')
        </form>
    </div>
@endsection
