@extends('layouts.admin')

@section('title', 'Supplier')

@section('css')

@endsection

@section('js')
    <script>
        $(function () {
            @if(session('isModalOpen'))
            $('#updateSupplierModal').modal('show');
            @endif

            const formSubmit = document.getElementById("delete-form");

            $("#deleteSupplierModal").on("show.bs.modal", (e) => {
                formSubmit.action = route(
                    "admin.supplier.destroy",
                    $(e.relatedTarget).data("id")
                );
            });
        });
    </script>
@endsection

@section('content')

<x-content>
    <x-slot name="modul">
        <h1>Supplier</h1>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <button class="mx-1 btn btn-success" data-target="#createSupplierModal" data-toggle="modal">Tambah</button>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped" id="myTable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th style="width: 72px"><i class="fas fa-cog"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($suppliers as $supplier)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->phone }}</td>
                            <td>{{ $supplier->address }}</td>
                            <td>
                                <a href="{{ route('admin.supplier.edit', $supplier->id) }}"
                                   class="btn btn-primary btn-icon"><i
                                        class="fas fa-pencil-alt"></i></a>
                                <button class="btn btn-danger btn-icon" data-target="#deleteSupplierModal"
                                        data-toggle="modal" data-id="{{ $supplier->id }}"><i
                                        class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-content>
@if(session('isModalOpen'))
    @include('admin.pages.supplier.partials.update-modal', ['member' => session('data')])
@endif
@include('admin.pages.supplier.partials.delete-modal')
@include('admin.pages.supplier.partials.create-modal')
@endsection
