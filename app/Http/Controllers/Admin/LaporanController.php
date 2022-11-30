<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $pengeluaran = Pengeluaran::whereBetween('created_at', [\request()->get('from'), \request()->get('to')])->get()->groupBy(function($item) {
            return $item->created_at->format('Y-m-d');
        });

        $pembelian   = Pembelian::whereBetween('created_at', [\request()->get('from'), \request()->get('to')])->get()->groupBy(function($item) {
            return $item->created_at->format('Y-m-d');
        });

        $laporans = $pembelian;

        $total = 0;
        foreach($laporans as $laporan) {
            $total += $laporan->sum('subtotal');
        }

        return view('admin.pages.laporan.index', [
            'laporans' => $laporans,
            'total' => $total,
        ]);
    }

    public function export()
    {
        //
    }
}
