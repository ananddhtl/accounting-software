<?php

namespace App\Http\Controllers;

use App\Models\CreditonSales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreditonSalesController extends Controller
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
        $list = DB::table('crediton_sales')
            ->join('main_accounts', 'crediton_sales.accno', '=', 'main_accounts.sn')
            ->select('crediton_sales.*', 'main_accounts.acname')
            ->where('cancel','=',0);
    
        if ($request->has('acname')) {
            $acname = $request->acname;
            $list->where('acname', 'like', '%' . $acname . '%');
        }
    
        $list = $list->simplePaginate(10);

        $list->appends([
            'acname' => $request->acname,
        ]);
        
        return view('pages.sales.credit', compact('list'));
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
            $creditonSales = new CreditonSales();
            $creditonSales->tcode = $tcode;
            $creditonSales->accno = $request->input('accno');
            $creditonSales->particulars = $request->input('particulars');
            $creditonSales->amount = $request->input('amount');
            $creditonSales->taxable_amount = $request->input('taxable_amount');
            $creditonSales->vat_amount = $request->input('vat_amount');
            $creditonSales->user_id = 0;
            $creditonSales->cancel = 0;
            $creditonSales->save();
            return redirect()->back()->with('message', 'Data has been saved successfully.');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CreditonSales  $creditonSales
     * @return \Illuminate\Http\Response
     */
    public function show(CreditonSales $creditonSales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CreditonSales  $creditonSales
     * @return \Illuminate\Http\Response
     */
    public function edit(CreditonSales $creditonSales,$id,Request $request)
    {
        $list = DB::table('crediton_sales')
        ->join('main_accounts', 'crediton_sales.accno', '=', 'main_accounts.sn')
        ->select('crediton_sales.*', 'main_accounts.acname')
        ->where('cancel','=',0)
        ->simplePaginate(10);
        
    $creditonSales = DB::table('crediton_sales')
        ->join('main_accounts', 'crediton_sales.accno', '=', 'main_accounts.sn')
        ->select('crediton_sales.*', 'main_accounts.acname')
        ->where('id', $id)
        ->first();

    if ($request->has('acname')) {
        $acname = $request->acname;
        $list = $list->where('acname', 'like', '%' . $acname . '%');
    }
    $list->appends([
        'acname' => $request->acname,
    ]);

    return view('pages.sales.credit', compact('creditonSales', 'list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CreditonSales  $creditonSales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CreditonSales $creditonSales)
    {
        CreditonSales::where('id', '=', $request->id)->update([
            'accno' => $request->accno,
            'particulars' => $request->particulars,
            'amount' => $request->amount,
            'taxable_amount' => $request->taxable_amount,
            'vat_amount' => $request->vat_amount,
            'user_id' => 0,
            'cancel' => 0,

        ]);
        return redirect('/salesoncredit')->with('message', 'Data has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CreditonSales  $creditonSales
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreditonSales $creditonSales, $id)
    {
        CreditonSales::where('id', '=', $id)->update(
            [
                'cancel' => 1,
            ]
        );
    
        return redirect('/salesoncredit')->with('message', 'Your data has been deleted successfully');
    }
}
