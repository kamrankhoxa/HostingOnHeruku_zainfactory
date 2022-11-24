<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Suppliers;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class SuppliersController extends Controller
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
        return view('supplier.supplier');
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
        
        $query = new Suppliers;
 
        $query->name = $request->name;
        $query->phno = $request->phno;
        $query->address = $request->address;
        $query->address1 = $request->address1;
        $query->state = $request->state;
        $query->city = $request->city;
        $query->user_id = Auth::user()->id;
        $query->save();
        return view('supplier.supplier');
        /*
        $result = DB::table('suppliers')->insert([
            'name' => $request->name,
            'phno' => $request->phno,
            'address' => $request->address,
            'address1' => $request->address1,
            'state' => $request->state,
            'city' => $request->city,
            'user_id' => Auth::user()->id,
            'created_at' => '',
            'updated_at' => '',
        ]);
        */
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoresupplierRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoresupplierRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = Suppliers::all();
        return view('supplier.supplierlist',['suppliers'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data = Suppliers::where('id', $request->route('id'))->first();
        return view('supplier.supplieredit',['suppliers'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatesupplierRequest  $request
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suppliers $supplier)
    {
        $query = Suppliers::find($request->id);
        $query->name = $request->name;
        $query->phno = $request->phno;
        $query->address = $request->address;
        $query->address1 = $request->address1;
        $query->state = $request->state;
        $query->city = $request->city;
        $query->user_id = Auth::user()->id;
        $query->save();
        return redirect()->route('suppliers-e', $request->id);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $query = Suppliers::find($request->id);
        $query->delete();
        return redirect()->route('suppliers-list');
    } 
}
