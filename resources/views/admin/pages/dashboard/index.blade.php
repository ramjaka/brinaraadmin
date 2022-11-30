@extends('layouts.admin')

@section('title', 'Dashboard')

@section('css')

@endsection

@section('js')
    <script src="https://demo.getstisla.com/assets/modules/chart.min.js"></script>
    <script src="{{ asset('stisla/js/index.js') }}"></script>
@endsection

@section('content')

<x-content>
    <x-slot name="modul">
        <h1>Dashboard</h1>
    </x-slot>

    @include('admin.pages.dashboard.partials.header', [
        'categories' => $countCategories,
        'suppliers'  => $countSuppliers,
        'members'    => $countMembers,
        'products'   => $countProducts,
    ])
    @include('admin.pages.dashboard.partials.chart')
</x-content>

@endsection
