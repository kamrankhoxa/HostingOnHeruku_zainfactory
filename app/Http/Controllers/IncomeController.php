<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Income;
use App\Models\Buyers;
use Illuminate\Http\Request;
use Carbon\Carbon;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buyersx = Buyers::all(['id', 'name']);
        if($buyersx->count() >= 1)
        {
        return view('income.income',['buyers'=>$buyersx]);
        }else{
            return view('buyers.buyers');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $date = date('Y-m-d H:i:s');
        $date_time = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('m/d/Y');
        
        $query = new Income;
 
        $query->title = $request->title;
        $query->description = $request->description;
        $query->quantity = $request->quantity;
        $query->amount = $request->amount;
        $query->submit = $request->submit;
        $query->buyers_id = $request->buyers_id;
        $query->user_id = Auth::user()->id;
        $query->save();
        return redirect()->route('income');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = Income::all();
        return view('income.incomelist',['income'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $buyersx = Buyers::all();
        $data = Income::where('id', $request->route('id'))->first();
        return view('income.incomeedit',['income'=>$data,'buyers'=>$buyersx]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $query = Income::find($request->id);
        $query->title = $request->title;
        $query->description = $request->description;
        $query->quantity = $request->quantity;
        $query->amount = $request->amount;
        $query->submit = $request->submit;
        $query->buyers_id = $request->buyers_id;
        $query->user_id = Auth::user()->id;
        $query->save();
        return redirect()->route('income-e', $request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $query = Income::find($request->id);
        $query->delete();
        return redirect()->route('income-list');
    }
}
