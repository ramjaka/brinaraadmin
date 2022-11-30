@extends('layouts.admin')

@section('title', 'Penjualan')

@section('css')

@endsection

@section('js')
    <script>
        $(function () {
            @if(session('isModalOpen'))
            $('#createPenjualanModal').modal('show');
            @endif

            const formSubmit = document.getElementById("delete-form");

            $("#deletePenjualanModal").on("show.bs.modal", (e) => {
                formSubmit.action = route(
                    "admin.penjualan.destroy",
                    $(e.relatedTarget).data("id")
                );
            });
        });
    </script>
@endsection

@section('content')

    <x-content>
        <x-slot name="modul">
            <h1>Penjualan</h1>
        </x-slot>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="myTable">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kode Member</th>
                            <th>Total Item</th>
                            <th>Total Harga</th>
                            <th>Diskon</th>
                            <th>Total Bayar</th>
                            <th>Kasir</th>
                            <th style="width: 72px"><i class="fas fa-cog"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($penjualans as $penjualan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $penjualan->created_at->format('j F Y') }}</td>
                                <td>{{ $penjualan->member['code'] }}</td>
                                <td>{{ $penjualan->quantity }}</td>
                                <td>{{ formatRupiah($penjualan->subtotal) }}</td>
                                <td>{{ $penjualan->discount }}%</td>
                                <td>{{ formatRupiah($penjualan->total) }}</td>
                                <td>{{ $penjualan->cashier['name'] }}</td>
                                <td>
                                    <a href=""
                                       class="btn btn-primary btn-icon"><i
                                            class="fas fa-eye"></i></a>
                                    <button class="btn btn-danger btn-icon" data-target="#deletePenjualanModal"
                                            data-toggle="modal" data-id="{{ $penjualan->id }}"><i
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
    @include('admin.pages.penjualan.partials.delete-modal')
@endsection
