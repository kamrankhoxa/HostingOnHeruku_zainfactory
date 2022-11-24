<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Buyers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BuyersController extends Controller
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
        return view('buyers.buyers');
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
        
        $query = new Buyers;
        
        $query->shop_name = $request->shop_name;
        $query->name = $request->name;
        $query->phno = $request->phno;
        $query->address = $request->address;
        $query->address1 = $request->address1;
        $query->state = $request->state;
        $query->city = $request->city;
        $query->user_id = Auth::user()->id;
        $query->save();
        return view('buyers.buyers');
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
     * @param  \App\Models\Buyers  $buyers
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = Buyers::all();
        return view('buyers.buyerslist',['buyers'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buyers  $buyers
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data = Buyers::where('id', $request->route('id'))->first();
        return view('buyers.buyersedit',['buyers'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buyers  $buyers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buyers $Buyers)
    {
        $query = Buyers::find($request->id);
        $query->shop_name = $request->shop_name;
        $query->name = $request->name;
        $query->phno = $request->phno;
        $query->address = $request->address;
        $query->address1 = $request->address1;
        $query->state = $request->state;
        $query->city = $request->city;
        $query->user_id = Auth::user()->id;
        $query->save();
        return redirect()->route('buyers-e', $request->id);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buyers  $buyers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $query = Buyers::find($request->id);
        $query->delete();
        return redirect()->route('buyers-list');
    }
}
