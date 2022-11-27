<?php

namespace App\Http\Controllers;
use Auth;

use App\Models\Expense;
use App\Models\Suppliers;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ExpenseController extends Controller
{
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
        $suppliersx = Suppliers::all(['id', 'name']);
        if($suppliersx->count() >= 1)
        {
        return view('expense.expense',['suppliers'=>$suppliersx]);
        }else{
            return view('supplier.supplier');
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
        
        $query = new Expense;
 
        $query->title = $request->title;
        $query->description = $request->description;
        $query->quantity = $request->quantity;
        $query->amount = $request->amount;
        $query->submit = $request->submit;
        $query->supplier_id = $request->supplier_id;
        $query->user_id = Auth::user()->id;
        $created_at = date('Y-m-d H:i:s',strtotime($request->date));
        $query->created_at = $created_at;
        $query->save();
        return redirect()->route('expense');
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
     * @param  \App\Models\Expense  $Expense
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = Expense::all();
        return view('expense.expenselist',['expense'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $Expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $suppliers = Suppliers::all();
        $data = Expense::where('id', $request->route('id'))->first();
        return view('expense.expenseedit',['expense'=>$data,'suppliers'=>$suppliers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $Expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $Expense)
    {
        $query = Expense::find($request->id);
        $query->title = $request->title;
        $query->description = $request->description;
        $query->quantity = $request->quantity;
        $query->amount = $request->amount;
        $query->submit = $request->submit;
        $query->supplier_id = $request->supplier_id;
        $query->user_id = Auth::user()->id;
        $created_at = date('Y-m-d H:i:s',strtotime($request->date));
        $query->created_at = $created_at;
        $query->save();
        return redirect()->route('expense-e', $request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $Expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $query = Expense::find($request->id);
        $query->delete();
        return redirect()->route('expense-list');
    }
}
