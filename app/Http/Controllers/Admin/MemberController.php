<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MemberExport;
use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
    public function index()
    {
        return view('admin.pages.member.index', [
            'members' => Member::all(),
        ]);
    }

    public function create(Request $request)
    {
        Member::create($request->all());

        return back();
    }

    public function edit(Member $member)
    {
        return back()->with([
            'data' => $member,
            'isModalOpen' => true,
        ]);
    }

    public function update(Request $request, Member $member)
    {
        $member->update($request->all());

        return back();
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return back();
    }

    public function download()
    {
        return Excel::download(new MemberExport, now()->format('Y-m-d').'-members.xlsx');
    }
}
