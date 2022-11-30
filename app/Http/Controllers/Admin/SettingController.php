<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.pages.setting.index', [
            'setting' => optional(Setting::first()),
        ]);
    }

    public function update(Request $request)
    {
        $memberCard = $request->file('member_card');
        $memberCard->store('company', 'public');
        $logoImage = $request->file('company_logo');
        $logoImage->store('company', 'public');

        $request->validate([
            'name'    => 'required',
            'address' => 'required',
            'phone'   => 'required',
            'member_card'     => 'required',
            'company_logo'    => 'required',
        ]);

        Setting::updateOrCreate([
            'company_name' => $request->name,
            'company_address' => $request->address,
            'company_phone' => $request->phone,
            'company_member_card' => $memberCard->hashName(),
            'company_logo' => $logoImage->hashName(),
        ]);

        return back();
    }
}
