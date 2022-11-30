<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index()
    {
        return view('admin.pages.pembelian.index', [
            'pembelians' => Pembelian::all(),
        ]);
    }

    public function create()
    {
        return back()->with([
            'suppliers'   => Supplier::all(),
            'isModalOpen' => true,
        ]);
    }

    public function store(Request $request)
    {
        Pembelian::create($request->all());

        return back();
    }

    public function edit(Pembelian $pembelian)
    {
        //
    }

    public function update(Request $request, Pembelian $pembelian)
    {
        $pembelian->update($request->all());

        return back();
    }

    public function destroy(Pembelian $pembelian)
    {
        $pembelian->delete();

        return back();
    }

    public function selectSupplier(Request $request, Supplier $supplier)
    {
        $request->session()->put('selected_supplier', $supplier);

        return redirect(route('admin.transaksi.pembelian.index'));
    }
}
