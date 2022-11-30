@extends('layouts.admin')

@section('title', 'Pembelian')

@section('css')

@endsection

@section('js')
    <script>
        $(function () {
            @if(session('isModalOpen'))
            $('#createPembelianModal').modal('show');
            @endif

            const formSubmit = document.getElementById("delete-form");

            $("#deletePembelianModal").on("show.bs.modal", (e) => {
                formSubmit.action = route(
                    "admin.pembelian.destroy",
                    $(e.relatedTarget).data("id")
                );
            });
        });
    </script>
@endsection

@section('content')

    <x-content>
        <x-slot name="modul">
            <h1>Pembelian</h1>
        </x-slot>

        <div class="card">
            <div class="card-header">
                <a class="mx-1 btn btn-success" href="{{ route('admin.pembelian.create') }}">Transaksi Baru</a>
                <a class="mx-1 btn btn-primary" href="{{ route('admin.pembelian.create') }}">Transaksi Aktif</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="myTable">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Supplier</th>
                            <th>Total Item</th>
                            <th>Total Harga</th>
                            <th>Diskon</th>
                            <th>Total Bayar</th>
                            <th style="width: 72px"><i class="fas fa-cog"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pembelians as $pembelian)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pembelian->created_at->format('j F Y') }}</td>
                                <td>{{ $pembelian->supplier['name'] }}</td>
                                <td>{{ $pembelian->quantity }}</td>
                                <td>{{ formatRupiah($pembelian->subtotal) }}</td>
                                <td>{{ $pembelian->discount }}%</td>
                                <td>{{ formatRupiah($pembelian->total) }}</td>
                                <td>
                                    <a href=""
                                       class="btn btn-primary btn-icon"><i
                                            class="fas fa-eye"></i></a>
                                    <button class="btn btn-danger btn-icon" data-target="#deletePembelianModal"
                                            data-toggle="modal" data-id="{{ $pembelian->id }}"><i
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
        @include('admin.pages.pembelian.partials.create-modal', ['suppliers' => session('suppliers')])
    @endif
    @include('admin.pages.pembelian.partials.delete-modal')
@endsection
