<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        return view('admin.pages.penjualan.index', [
            'penjualans' => Penjualan::all(),
        ]);
    }

    public function show(Penjualan $penjualan)
    {
        return view('admin.pages.penjualan.show', [
            'penjualan' => $penjualan
        ]);
    }

    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();

        return back();
    }
}
