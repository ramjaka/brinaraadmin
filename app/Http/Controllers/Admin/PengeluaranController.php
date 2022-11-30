<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        return view('admin.pages.pengeluaran.index', [
            'pengeluarans' => Pengeluaran::all(),
        ]);
    }

    public function create(Request $request)
    {
        Pengeluaran::create($request->all());

        return back();
    }

    public function edit(Pengeluaran $pengeluaran)
    {
        return back()->with([
            'data' => $pengeluaran,
            'isModalOpen' => true,
        ]);
    }

    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $pengeluaran->update($request->all());

        return back();
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();

        return back();
    }
}
