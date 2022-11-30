<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MemberExport;
use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.pages.product.index', [
            'products'   => Product::orderby('id', 'DESC')->get(),
            'categories' => Category::all(),
        ]);
    }

    public function create(Request $request)
    {
        Product::create($request->all());

        return back();
    }

    public function edit(Product $product)
    {
        return back()->with([
            'data' => $product,
            'categories' => Category::all(),
            'isModalOpen' => true,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return redirect(route('admin.product.index'));
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(route('admin.product.index'));
    }

    public function multipleDestroy(Request $request)
    {
        Product::whereIn('id', $request->check_deletes)->delete();

        return redirect(route('admin.product.index'));
    }

    public function export()
    {
        return Excel::download(new ProductExport, now()->format('Y-m-d').'-products.xlsx');
    }
}
