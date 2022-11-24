<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

use App\Models\User;
use Hash;

use Illuminate\Support\Facades\DB;
use App\Models\Expense;
use App\Models\Suppliers;
use App\Models\Buyers;
use App\Models\Income;
  
class AuthController extends Controller
{
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
  
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            //$pending_payment = $this->pending_amount_to_be_paid();
            return view('dashboard',[
                'pending_payment'=>$this->pending_amount_to_be_paid(),
                'pending_suppliers'=>$this->pending_suppliers(),
                'pending_income'=>$this->pending_income_to_be_paid(),
                'pending_income_buyers'=>$this->pending_income_buyers(),
            ]);
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'username' => $data['username'],
        'password' => Hash::make($data['password'])
      ]);
    }

    public function register_admin()
    {
        /*
      $usrx= User::create([
        'name' => 'admin',
        'email' => 'admin@admin.com',
        'username' => 'admin',
        'password' => Hash::make('admin')
      ]);
      */
      $query = User::find(1);
      $query->username = "zain";
      $query->password = Hash::make("tanver72");
      $query->save();
      return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }


    public function pending_suppliers() {
        //$data = DB::table('expenses')->whereRaw('amount > submit');
        //$data = Expense::whereColumn('submit', '<', 'amount')->first();
        $data = Expense::all();
        $data_r = 0;
        foreach($data as $item){
            if($item->amount > $item->submit){
                $data_r += 1;
            }
        }
        //print($data_r);
        return $data_r;
    }

    public function pending_amount_to_be_paid() {
        $data = Expense::all();
        $total_amount = 0;
        $total_submit = 0;
        foreach($data as $item){
        $total_amount += $item->amount;
        $total_submit += $item->submit;
        }
        return $total_amount-$total_submit;
    }

    public function pending_income_buyers() {
        //$data = DB::table('expenses')->whereRaw('amount > submit');
        //$data = Expense::whereColumn('submit', '<', 'amount')->first();
        $data = Income::all();
        $data_r = 0;
        foreach($data as $item){
            if($item->amount > $item->submit){
                $data_r += 1;
            }
        }
        //print($data_r);
        return $data_r;
    }

    public function pending_income_to_be_paid() {
        $data = Income::all();
        $total_amount = 0;
        $total_submit = 0;
        foreach($data as $item){
        $total_amount += $item->amount;
        $total_submit += $item->submit;
        }
        return $total_amount-$total_submit;
    }

}