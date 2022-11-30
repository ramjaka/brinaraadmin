@extends('layouts.admin')

@section('title', 'Pengeluaran')

@section('css')

@endsection

@section('js')
    <script>
        $(function () {
            @if(session('isModalOpen'))
            $('#updatePengeluaranModal').modal('show');
            @endif

            const formSubmit = document.getElementById("delete-form");

            $("#deletePengeluaranModal").on("show.bs.modal", (e) => {
                formSubmit.action = route(
                    "admin.pengeluaran.destroy",
                    $(e.relatedTarget).data("id")
                );
            });
        });
    </script>
@endsection

@section('content')

<x-content>
    <x-slot name="modul">
        <h1>Pengeluaran</h1>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <button class="mx-1 btn btn-success" data-target="#createPengeluaranModal" data-toggle="modal">Tambah</button>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped" id="myTable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Nominal</th>
                        <th style="width: 72px"><i class="fas fa-cog"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pengeluarans as $pengeluaran)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pengeluaran->created_at->format('j F Y') }}</td>
                            <td>{{ $pengeluaran->deskripsi }}</td>
                            <td>{{ formatRupiah($pengeluaran->nominal) }}</td>
                            <td>
                                <a href="{{ route('admin.pengeluaran.edit', $pengeluaran->id) }}"
                                   class="btn btn-primary btn-icon"><i
                                        class="fas fa-pencil-alt"></i></a>
                                <button class="btn btn-danger btn-icon" data-target="#deletePengeluaranModal"
                                        data-toggle="modal" data-id="{{ $pengeluaran->id }}"><i
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
    @include('admin.pages.pengeluaran.partials.update-modal', ['pengeluaran' => session('data')])
@endif
@include('admin.pages.pengeluaran.partials.delete-modal')
@include('admin.pages.pengeluaran.partials.create-modal')
@endsection
