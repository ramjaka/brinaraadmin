<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return view('admin.pages.supplier.index', [
            'suppliers' => Supplier::all(),
        ]);
    }

    public function create(Request $request)
    {
        Supplier::create($request->all());

        return back();
    }

    public function edit(Supplier $supplier)
    {
        return back()->with([
            'data' => $supplier,
            'isModalOpen' => true,
        ]);
    }

    public function update(Request $request, Supplier $supplier)
    {
        $supplier->update($request->all());

        return back();
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return back();
    }
}
