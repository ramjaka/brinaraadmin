@extends('layouts.admin')

@section('title', 'Cleaner')

@section('css')

@endsection

@section('js')

@endsection

@section('content')

    <x-content>
        <x-slot name="modul">
            <h1>Cleaner</h1>
        </x-slot>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-trash"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>View Clear</h4>
                        </div>
                        <div class="card-body text-right">
                            <a href="{{ route('admin.cleaner.clear', 'view') }}" class="btn btn-danger">Clear</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-trash"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Route Clear</h4>
                        </div>
                        <div class="card-body text-right">
                            <a href="{{ route('admin.cleaner.clear', 'route') }}" class="btn btn-danger">Clear</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-trash"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Config Clear</h4>
                        </div>
                        <div class="card-body text-right">
                            <a href="{{ route('admin.cleaner.clear', 'config') }}" class="btn btn-danger">Clear</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-trash"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Cache Clear</h4>
                        </div>
                        <div class="card-body text-right">
                            <a href="{{ route('admin.cleaner.clear', 'cache') }}" class="btn btn-danger">Clear</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-trash"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>All Clear</h4>
                        </div>
                        <div class="card-body text-right">
                            <a href="{{ route('admin.cleaner.clear', 'optimize') }}" class="btn btn-danger">Clear</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-content>
@endsection
