<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class TransaksiPembelianController extends Controller
{
    public function index()
    {
        $product = Product::where('code', \request()->get('code'))->first();

        return view('admin.pages.transaksi.baru.pembelian.index', [
            'supplier' => \request()->session()->get('selected_supplier'),
            'product'  => optional($product),
        ]);
    }

    public function create(Request $request)
    {
        $product  = Product::where('code', $request->code)->first();
        $supplier = $request->session()->get('selected_supplier');

        $subtotal = $request->quantity * $product->buy_price;
        $discount = $subtotal * ($request->discount / 100);
        $total    = $subtotal - $discount;

        $pembelian = Pembelian::create([
            'product_id'  => $product->id,
            'supplier_id' => $supplier->id,
            'quantity' => $request->quantity,
            'subtotal' => $subtotal,
            'discount' => $request->discount,
            'total'    => $total,
        ]);

        PembelianDetail::create([
            'pembelian_id' => $pembelian->id,
            'product_id'   => $product->id,
            'buy_price'    => $product->buy_price,
            'quantity'     => $pembelian->quantity,
            'subtotal'     => $pembelian->subtotal,
        ]);

        return redirect(route('admin.pembelian.index'));
    }
}
