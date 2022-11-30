@extends('layouts.admin')

@section('title', 'Transaksi Penjualan')

@section('css')

@endsection

@section('js')
    <script>
        let quantityElm = document.querySelectorAll(".quantity");
        let totalElm = document.getElementById("total");
        let discountElm = document.getElementById("discount");
        let payElm = document.getElementById("pay");
        let receiveElm = document.getElementById("receive");
        let changeElm  = document.getElementById("change");

        let quantity = 0;
        let discount = 0;
        let subtotal = 0;
        let pay = 0;
        let receive = 0;
        let total
        let products = [];

        quantityElm.forEach((item, i) => {
            let sellPrice = 0;
            item.addEventListener("keyup", (e) => {
                sellPrice = e.target.attributes.price.value;
                quantity = parseInt(e.target.value) || 0;

                let sellPriceCalculated = parseInt(sellPrice) * quantity;

                products[i] = {
                    product: i,
                    quantity: quantity,
                    price: sellPrice,
                    subtotal: sellPriceCalculated,
                };

                let subtotalElm = document.getElementById("subtotal" + i);

                total = 0;
                products.forEach((item) => {
                    total += item.subtotal;
                });

                displayToHtml(sellPriceCalculated, total, subtotalElm);
            });
        });

        const displayToHtml = (subtotal, total, subtotalElm) => {
            totalElm.innerHTML = formatRupiah(total);
            subtotalElm.innerHTML = formatRupiah(subtotal);
        }

        discountElm.addEventListener("keyup", (e) => {
            discount = e.target.value;

            solve();
        });

        const solve = () => {
            pay = total - (total * discount / 100) || 0;
            payElm.innerHTML = formatRupiah(pay);
        }

        receiveElm.addEventListener("keyup", () => {
            received();
        });

        const received = () => {
            if(receiveElm.value < pay) {
                changeElm.innerHTML = "Uang tidak cukup";
            } else {
                let change = receiveElm.value - pay;
                changeElm.innerHTML = formatRupiah(change);
            }
        }

        solve();

    </script>
@endsection

@section('content')

    <x-content>
        <x-slot name="modul">
            <h1>Transaksi Penjualan</h1>
        </x-slot>

        <div class="card">
            <div class="card-body">
                <form>
                    <div class="row w-50">
                        <div class="col-4 my-auto">
                            <h4>Kode Produk</h4>
                        </div>
                        <div class="mt-2 col-8">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="code">
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
                @if(! blank($products))
                    <form method="post">
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
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $product->code }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ formatRupiah($product->sell_price) }}</td>
                                        <td><input type="number" name="quantity[]" price="{{ $product->sell_price }}"
                                                   class="form-control quantity">
                                        </td>
                                        <td id="subtotal{{ $loop->iteration - 1 }}">Rp0</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5"></td>
                                    <td colspan="2"><b>Total</b> <span id="total"></span></td>
                                </tr>
                                <tr>
                                    <td colspan="5"></td>
                                    <td><b>Member</b>
                                        <div class="form-group">
                                            <div class="input-group mb-1">
                                                <input type="text" class="form-control" name="member"
                                                       value="{{ isset($member) ? $member->code : null }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit"
                                                            formaction="{{ url()->current() }}" formmethod="GET"><i
                                                            class="fas fa-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @if(! blank($member))
                                                <span class="text-success">{{ $member->name }}</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5"></td>
                                    <td><b>Diskon</b> <input type="number" id="discount" name="discount"
                                                             class="form-control"></td>
                                </tr>
                                <tr>
                                    <td colspan="5"></td>
                                    <td><b>Bayar</b> <span id="pay"></span></td>
                                </tr>
                                <tr>
                                    <td colspan="5"></td>
                                    <td><b>Diterima</b> <input type="number" id="receive" name="paid"
                                                               class="form-control"></td>
                                </tr>
                                <tr>
                                    <td colspan="5"></td>
                                    <td><b>Kembali</b> <span id="change">Rp0</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right">
                            <input type="hidden" name="code" value="{{ request()->get('code') }}">
                            <button class="btn btn-primary" type="submit" formaction="{{ route('admin.transaksi.penjualan.create') }}">
                                <i class="fas fa-save"></i> Simpan Transaksi
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </x-content>
@endsection
