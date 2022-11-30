@extends('layouts.admin')

@section('title', 'Laporan')

@section('css')

@endsection

@section('js')

@endsection

@section('content')

    <x-content>
        <x-slot name="modul">
            <h1>Laporan</h1>
        </x-slot>

        <div class="card">
            <div class="card-header">
                <button class="mx-1 btn btn-success" data-target="#updatePeriodeModal" data-toggle="modal"><i
                        class="fas fa-pencil-alt"></i> Ubah Periode
                </button>
                <a href="{{ route('admin.laporan.export') }}" class="mx-1 btn btn-warning"><i
                        class="fas fa-id-card"></i> Cetak Laporan</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="myTable">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Penjualan</th>
                            <th>Pembelian</th>
                            <th>Pengeluaran</th>
                            <th>Pendapatan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($laporans as $key => $laporan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $key }}</td>
                                <td>{{ formatRupiah($laporan->sum('subtotal')) }}</td>
                                <td>{{ formatRupiah($laporan->sum('subtotal')) }}</td>
                                <td>{{ formatRupiah($laporan->sum('subtotal')) }}</td>
                                <td>{{ formatRupiah($laporan->sum('subtotal')) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4"></td>
                            <td>Total Pendapatan</td>
                            <td>{{ formatRupiah($total) }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </x-content>
    @include('admin.pages.Laporan.partials.update-modal')
@endsection
