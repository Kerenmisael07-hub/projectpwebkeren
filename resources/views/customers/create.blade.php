@extends('layouts.app')

@section('title', 'Tambah Customer')
@section('header', 'Tambah Customer')

@section('content')
    <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        @php($customer = null)
        <form action="{{ route('customers.store') }}" method="POST">
            @include('customers._form')
        </form>
    </div>
@endsection
