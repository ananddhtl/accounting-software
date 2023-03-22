<?php

namespace App\Http\Controllers;

use App\Models\CreditonPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreditonPurchaseController extends Controller
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
        $list = DB::table('crediton_purchases')
            ->join('main_accounts', 'crediton_purchases.accno', '=', 'main_accounts.sn')
            ->select('crediton_purchases.*', 'main_accounts.acname')
            ->where('cancel','=',0);
    
        if ($request->has('acname')) {
            $acname = $request->acname;
            $list->where('acname', 'like', '%' . $acname . '%');
        }
    
        $list = $list->simplePaginate(10);

        $list->appends([
            'acname' => $request->acname,
        ]);
        
        return view('pages.purchase.credit', compact('list'));
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
        {
            $tcode = $this->tCodeGenerate();
            $creditonPurchase = new CreditonPurchase();
            $creditonPurchase->tcode = $tcode;
            $creditonPurchase->accno = $request->input('accno');
            $creditonPurchase->particulars = $request->input('particulars');
            $creditonPurchase->amount = $request->input('amount');
            $creditonPurchase->taxable_amount = $request->input('taxable_amount');
            $creditonPurchase->vat_amount = $request->input('vat_amount');
            $creditonPurchase->user_id = 0;
            $creditonPurchase->cancel = 0;
            $creditonPurchase->save();
            return redirect()->back()->with('message', 'Data has been saved successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CreditonPurchase  $creditonPurchase
     * @return \Illuminate\Http\Response
     */
    public function show(CreditonPurchase $creditonPurchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CreditonPurchase  $creditonPurchase
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditonPurchase $creditonPurchase,$id,Request $request)
    {
        {
            $list = DB::table('crediton_purchases')
            ->join('main_accounts', 'crediton_purchases.accno', '=', 'main_accounts.sn')
            ->select('crediton_purchases.*', 'main_accounts.acname')
            ->where('cancel','=',0)
            ->simplePaginate(10);
            
        $creditonPurchase = DB::table('crediton_purchases')
            ->join('main_accounts', 'crediton_purchases.accno', '=', 'main_accounts.sn')
            ->select('crediton_purchases.*', 'main_accounts.acname')
            ->where('id', $id)
            ->first();
    
        if ($request->has('acname')) {
            $acname = $request->acname;
            $list = $list->where('acname', 'like', '%' . $acname . '%');
        }
        $list->appends([
            'acname' => $request->acname,
        ]);
    
        return view('pages.purchase.credit', compact('creditonPurchase', 'list'));
        }
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CreditonPurchase  $creditonPurchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CreditonPurchase $creditonPurchase)
    {
        CreditonPurchase::where('id', '=', $request->id)->update([
            'accno' => $request->accno,
            'particulars' => $request->particulars,
            'amount' => $request->amount,
            'taxable_amount' => $request->taxable_amount,
            'vat_amount' => $request->vat_amount,
            'user_id' => 0,
            'cancel' => 0,

        ]);
        return redirect('/purchaseoncredit')->with('message', 'Data has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CreditonPurchase  $creditonPurchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditonPurchase $creditonPurchase, $id)
    {
        CreditonPurchase::where('id', '=', $id)->update(
            [
                'cancel' => 1,
            ]
        );
    
        return redirect('/purchaseoncredit')->with('message', 'Your data has been deleted successfully');
    }
}
