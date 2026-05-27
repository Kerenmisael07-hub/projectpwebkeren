@extends('layouts.app')

@section('title', 'Edit Customer')
@section('header', 'Edit Customer')

@section('content')
    <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <form action="{{ route('customers.update', $customer) }}" method="POST">
            @method('PUT')
            @include('customers._form')
        </form>
    </div>
@endsection
