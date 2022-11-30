<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class TransaksiPenjualanController extends Controller
{
    public function index()
    {
        $code = \request()->session()->get('code') ?? [];
        $code = count($code) === 0 ? [] : $code;
        $code[] = request()->get('code');
        $products = Product::whereIn('code', $code)->get();

        \request()->session()->put('code', $code);

        $member = Member::where('code', \request()->get('member'))->first();

        return view('admin.pages.transaksi.baru.penjualan.index', [
            'products'  => $products,
            'member'    => $member,
        ]);
    }

    public function create(Request $request)
    {
        $subtotal = 0;
        $quantityTotal = 0;
        $code = \request()->session()->get('code');
        $code[] = request()->get('code');
        $products = Product::whereIn('code', $code)->get();
        $member = Member::where('code', $request->member)->first();

        foreach ($products as $key => $product) {
            $subtotal += $request->quantity[$key] * $product->sell_price;
            $quantityTotal += $request->quantity[$key];
        }

        $discount = $subtotal * ($request->discount / 100);
        $total    = $subtotal - $discount;

        $penjualan = Penjualan::create([
            'member_id'  => $member->id,
            'cashier_id' => auth()->user()->id,
            'quantity' => $quantityTotal,
            'subtotal' => $subtotal,
            'discount' => $request->discount,
            'paid' => $request->paid,
            'total'    => $total,
        ]);

        foreach ($products as $key => $product) {
            PenjualanDetail::create([
                'penjualan_id' => $penjualan->id,
                'product_id'   => $product->id,
                'sell_price'   => $product->sell_price,
                'quantity'     => $request->quantity[$key],
                'discount'     => $request->discount,
                'amount'       => $penjualan->subtotal,
                'subtotal'     => $penjualan->subtotal,
            ]);
        }

        \request()->session()->put('code', '');

        return redirect(route('admin.penjualan.index'));
    }
}
