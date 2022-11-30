<div class="modal fade" tabindex="1" role="dialog" id="updateSupplierModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Edit Supplier
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.supplier.update', $member->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $member->name }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Telepon</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $member->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Alamat</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $member->address }}">
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn border bg-white" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
