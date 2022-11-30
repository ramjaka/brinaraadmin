<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Member;
use App\Models\Penjualan;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.pages.dashboard.index', [
            'countCategories' => Category::count(),
            'countSuppliers'  => Supplier::count(),
            'countMembers'    => Member::count(),
            'countProducts'   => Product::count(),
        ]);
    }

    public function sales()
    {
        $sales = [];
        $rangeDate = 30;
        for ($index = 1; $index < $rangeDate; $index++) {
            $date = now()->subDays($index);

            $sales[] = [
                'date' => $date->format('j F'),
                'value' => round(Penjualan::whereDate('created_at', $date->format('Y-m-d'))->sum('total'))
            ];
        }

        return $sales;
    }
}
