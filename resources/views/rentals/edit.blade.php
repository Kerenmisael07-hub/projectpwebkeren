@extends('layouts.app')

@section('title', 'Edit Rental')
@section('header', 'Edit Rental')

@section('content')
    <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <form action="{{ route('rentals.update', $rental) }}" method="POST">
            @method('PUT')
            @include('rentals._form')
        </form>
    </div>
@endsection
