<div class="modal fade" tabindex="1" role="dialog" id="createProductModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Tambah Produk
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.product.create') }}" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <select name="category_id" class="form-control" id="category">
                            <option value="" selected hidden>Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="merk">Merk</label>
                        <input type="text" class="form-control" id=merk" name="merk">
                    </div>
                    <div class="form-group">
                        <label for="buy_price">Harga Beli</label>
                        <input type="text" class="form-control" id="buy_price" name="buy_price">
                    </div>
                    <div class="form-group">
                        <label for="sell_price">Harga Jual</label>
                        <input type="text" class="form-control" id="sell_price" name="sell_price">
                    </div>
                    <div class="form-group">
                        <label for="discount">Diskon</label>
                        <input type="text" class="form-control" id="discount" name="discount">
                    </div>
                    <div class="form-group">
                        <label for="stock">Stok</label>
                        <input type="text" class="form-control" id="stock" name="stock">
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    @csrf
                    <button type="button" class="btn border bg-white" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
