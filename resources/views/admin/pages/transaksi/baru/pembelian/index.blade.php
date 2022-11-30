@extends('layouts.admin')

@section('title', 'Transaksi Pembelian')

@section('css')

@endsection

@section('js')
    <script>
        let quantityElm = document.getElementById("quantity");
        let subtotalElm = document.getElementById("subtotal");
        let totalElm = document.getElementById("total");
        let discountElm = document.getElementById("discount");

        let quantity = 0;
        let discount = 0;
        let subtotal = 0;
        let total = 0;
        let buyPrice = "{{ $product->buy_price }}";

        quantityElm.addEventListener("keyup", (e) => {
            quantity = e.target.value;

            solve();
        });

        discountElm.addEventListener("keyup", (e) => {
            discount = e.target.value;

            solve();
        });

        const solve = () => {
            subtotal = parseInt(buyPrice) * quantity;
            total = subtotal - (subtotal * discount / 100);

            subtotalElm.innerHTML = formatRupiah(subtotal);
            totalElm.innerHTML = formatRupiah(total);
        }

        solve()

    </script>
@endsection

@section('content')

    <x-content>
        <x-slot name="modul">
            <h1>Transaksi Pembelian</h1>
        </x-slot>

        <div class="card">
            <div class="card-body">
                <div>
                    <table>
                        <tr>
                            <td>Supplier:</td>
                            <td>{{ $supplier->name }}</td>
                        </tr>
                        <tr>
                            <td>Telepon:</td>
                            <td>{{ $supplier->phone }}</td>
                        </tr>
                        <tr>
                            <td>Alamat:</td>
                            <td>{{ $supplier->address }}</td>
                        </tr>
                    </table>
                    <form>
                        <div class="row w-50">
                            <div class="col-4 my-auto">
                                <h4>Kode Produk</h4>
                            </div>
                            <div class="mt-2 col-8">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="code" placeholder=""
                                               value="{{ request()->get('code') }}"
                                               aria-label="">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="fas fa-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @if(! blank(request()->get('code')))
                <form action="{{ route('admin.transaksi.pembelian.create') }}" method="post">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th style="width: 72px"><i class="fas fa-cog"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ formatRupiah($product->buy_price) }}</td>
                                <td><input type="number" name="quantity" id="quantity" class="form-control"></td>
                                <td colspan="2"><b>Total</b> <span id="subtotal"></span></td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                                <td colspan="2"><b>Diskon</b> <input type="number" id="discount" name="discount"
                                                                     class="form-control"></td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                                <td colspan="2"><b>Bayar</b> <span id="total"></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right">
                        <input type="hidden" name="code" value="{{ request()->get('code') }}">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Simpan Transaksi
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </x-content>
@endsection
