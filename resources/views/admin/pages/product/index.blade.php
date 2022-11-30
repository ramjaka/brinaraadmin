@extends('layouts.admin')

@section('title', 'Daftar Produk')

@section('css')

@endsection

@section('js')
    <script src="{{ asset('stisla/js/components-table.js') }}"></script>
    <script>
        $(function () {
            @if(session('isModalOpen'))
            $('#updateProductModal').modal('show');
            @endif

            const formSubmit = document.getElementById("delete-form");

            $("#deleteProductModal").on("show.bs.modal", (e) => {
                formSubmit.action = route(
                    "admin.product.destroy",
                    $(e.relatedTarget).data("id")
                );
            });
        });
    </script>
@endsection

@section('content')

    <x-content>
        <x-slot name="modul">
            <h1>Daftar Produk</h1>
        </x-slot>
        <form action="{{ route('admin.product.multipleDestroy') }}" method="post">
            @csrf
            @method('DELETE')
            <div class="card">
                <div class="card-header">
                    <button type="button" class="mx-1 btn btn-success" data-target="#createProductModal" data-toggle="modal">
                        Tambah
                    </button>
                    <button type="submit" class="mx-1 btn btn-danger">
                        Hapus
                    </button>
                    <a href="{{ route('admin.product.export') }}" class="mx-1 btn btn-primary">
                        Cetak
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="myTable">
                            <thead>
                            <tr>
                                <th>
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                               class="custom-control-input" id="checkbox-all">
                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </th>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Merk</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Diskon</th>
                                <th>Stok</th>
                                <th style="width: 72px"><i class="fas fa-cog"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="p-0 text-center">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="mygroup"
                                                   name="check_deletes[]"
                                                   class="custom-control-input"
                                                   value="{{ $product->id }}"
                                                   id="checkbox-{{ $loop->iteration }}">
                                            <label for="checkbox-{{ $loop->iteration }}" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><span class="badge badge-success">{{ $product->code }}</span></td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category['name'] }}</td>
                                    <td>{{ $product->merk }}</td>
                                    <td>{{ formatRupiah($product->buy_price) }}</td>
                                    <td>{{ formatRupiah($product->sell_price) }}</td>
                                    <td>{{ formatRupiah($product->discount) }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        <a href="{{ route('admin.product.edit', $product->id) }}"
                                           class="btn btn-primary btn-icon"><i
                                                class="fas fa-pencil-alt"></i></a>
                                        <button type="button" class="btn btn-danger btn-icon" data-target="#deleteProductModal"
                                                data-toggle="modal" data-id="{{ $product->id }}"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </x-content>
    @if(session('isModalOpen'))
        @include('admin.pages.product.partials.update-modal', ['product' => session('data'), 'categories' => session('categories')])
    @endif
    @include('admin.pages.product.partials.delete-modal')
    @include('admin.pages.product.partials.create-modal', ['categories' => $categories])
@endsection
