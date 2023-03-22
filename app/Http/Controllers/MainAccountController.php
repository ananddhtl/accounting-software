<?php

namespace App\Http\Controllers;

use App\Models\MainAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainAccountController extends Controller
{

    public function tCodeGenerate()
    {
        $today = date('YmdHi');
        $startDate = date('YmdHi', strtotime('-10 days'));
        $range = $today - $startDate;
        $rand = rand(0, $range);
        $uniqueid = $startDate + $rand;
        $length = 20;
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $sn = substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
        $sn = $sn . $uniqueid;

        return $sn;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index(Request $request)
    {
        $list = DB::table('main_accounts');
    
        if ($request->has('acname')) {
            $acname = $request->acname;
            $list->where('acname', 'like', '%' . $acname . '%');
        }
    
        $data = $list->where(function($query) {
            $query->where('status', '=', null)
                  ->orWhere('status', '=', 0);
        })->simplePaginate(10);
    
        if ($data->count() == 0 && $request->has('acname')) {
            return redirect()->back()->with('message', 'Account name not found.');
        }
    
        $data->appends([
            'acname' => $request->acname,
        ]);
    
        return view('pages.ledger', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store(Request $request)
{
    
    $existingName = MainAccount::where('acname', $request->acname)->first();
    $existingMobile = MainAccount::where('mobno', $request->mobno)->first();

    if (!empty($existingName)) {
    return redirect()->back()->with('message', 'This name is already taken');
    } elseif (!empty($existingMobile)) {
    return redirect()->back()->with('message', 'This mobile number is already taken');
    }

    $tcode = $this->tCodeGenerate();
    $mainAccount = new MainAccount();
    $mainAccount->accno = $tcode;
    $mainAccount->acname = $request->input('acname');
    $mainAccount->accounthead = $request->input('accounthead');
    $mainAccount->groups = $request->input('groups');
    $mainAccount->subgroups = $request->input('subgroups');
    $mainAccount->phoneno = $request->input('phoneno');
    $mainAccount->address = $request->input('address');
    $mainAccount->mobno = $request->input('mobno');
    $mainAccount->save();

    return redirect()->back()->with('message', 'Data has been saved successfully. Account name: '.$request->input('acname').', Mobile number: '.$request->input('mobno'));
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainAccount  $mainAccount
     * @return \Illuminate\Http\Response
     */
    public function show(MainAccount $mainAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MainAccount  $mainAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $sn = null)
{
    $list = DB::table('main_accounts');

    if ($request->has('acname')) {
        $acname = $request->acname;
        $list->where('acname', 'like', '%' . $acname . '%');
    }

    $data = $list->where('status', '=', null)
        ->orWhere('status', '=', 0)
        ->simplePaginate(1);

    $mainAccount = null;

    if ($sn) {
        $mainAccount = DB::table('main_accounts')
            ->select('*')
            ->where('sn', '=', $sn)
            ->first();

        if (!$mainAccount) {
            return redirect()->back()->with('error', 'Account not found.');
        }
    }

    $nextPageUrl = $data->nextPageUrl();

    return view('pages.ledger', compact('mainAccount', 'data', 'nextPageUrl'));
}
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MainAccount  $mainAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainAccount $mainAccount)
    {
    $existingName = MainAccount::where('acname', $request->acname)->first();
    $existingMobile = MainAccount::where('mobno', $request->mobno)->first();

    if (!empty($existingName)) {
    return redirect()->back()->with('message', 'This name is already taken');
    } elseif (!empty($existingMobile)) {
    return redirect()->back()->with('message', 'This mobile number is already taken');
    }
        MainAccount::where('sn', '=', $request->sn)->update([
            'accno' => $request->tCode,
            'acname' => $request->acname,
            'accounthead' => $request->accounthead,
            'groups' => $request->groups,
            'subgroups' => $request->subgroups,
            'phoneno' => $request->phoneno,
            'address' => $request->address,
            'mobno' => $request->mobno,
            'status' => 0,

        ]);
        return redirect('/ledger')->with('message', 'Data has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MainAccount  $mainAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy($sn)
    {
        MainAccount::where('sn', '=', $sn)->update(
            [
                'status' => 1,
            ]
        );
    
        return redirect('/ledger')->with('message', 'Your data has been deleted successfully');
    }
    public function searchPartyName($searchkey)
    {
        $data = MainAccount::select('sn', 'acname')
            ->where('acname', 'like', $searchkey . '%')
            ->take(10)
            ->get();
    
        return json_encode($data);
    }

}