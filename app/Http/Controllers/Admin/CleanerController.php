<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CleanerController extends Controller
{
    public function index()
    {
        return view('admin.pages.setting.cleaner');
    }

    public function clear($cleaner)
    {
        Artisan::call($cleaner.':clear');

        return back();
    }
}
