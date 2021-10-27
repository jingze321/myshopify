<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB; //use sql

use App\Models\Admin;

class AdminAuthController extends Controller
{
    function login (){
        return view ('admin.login');
    }
    function register (){
        // $city = City::where('locastatetion')
        // $user =User::where('id','=',session('LoggedUser'))->first();
        return view ('admin.register');
    }
    function create (Request $request){
        //validate request

        $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email|unique:admins',
            'password'=>'required|min:5|max:12',
            'address'=>'required',
            // 'apartment'=>'required',
            'postcode'=>'required',
            'state'=>'required',
            'country'=>'required',
            'phone'=>'required',   
            'storename'=>'required|unique:stores,store_name',
            'companyname'=>'required',
            'storeindustry'=>'required'
        ]);
        //if form validated successfully,then  register new user

        $query = DB::table('admins')
                ->insertGetId([
                    'first_name' => $request->firstname,
                    'last_name' => $request->lastname,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'address' => $request->address,
                    'apartment' => $request->apartment,
                    'postcode' => $request->postcode,
                    'state' => $request->state,
                    'country' => $request->country,
                    'phone' => $request->phone,
                    
                ]);

                
                $query1 = DB::table('stores')
                ->insert([
                    'store_name' => $request->storename,
                    'company_name'=> $request->companyname,
                    'store_industry' => $request->storeindustry,
                    'admin_id' => $query,
                    'store_address' => $request->address,
                    'postcode' => $request->postcode,
                    'city' => "kluang",
                    'state' => $request->state,
                    'country' => $request->country,
                    'phone' => $request->phone,
                ]);
                
                

        if($query){
            return back()->with('success','you have been sucessful');
        }else{
            return back()->with('fail','something went wrong');
        }
    
    }

    function check (Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12',
        ]);

        //if from validated successfully,the process login


        $admin = DB::table('admins')
            ->where('email',$request->email)
            ->first();
            // dd($admin);
        if($admin){
            if(Hash::check($request->password,$admin->password)){
                $request->session()->put('LoggedAdmin',$admin->id);
                session_set_cookie_params(0, '/', '.localhost:8000');
                return redirect('admin_profile');
            }else{
                return back()->with('fail','Invalid Password');
            }
        }else{
            return back()->with('fail','No account found for this email');
        }
    }

    function profile(){
        $admin =admin::where('ID','=',session('LoggedAdmin'))->first();
        $data =[
            'LoggedAdminInfo'=>$admin
        ];
        return view('admin.profile',$data);
    }

    function edit(){
        $admin =admin::where('ID','=',session('LoggedAdmin'))->first();
        $data =[
            'LoggedAdminInfo'=>$admin
        ];
        return view('admin.edit',$data);
    }

    function update (Request $request){
        //validate request
        $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required',
            
        ]);
        //if form validated successfully,then  register new user

            $admin =admin::where('ID','=',session('LoggedAdmin'))->first();
            $firstname = $request->firstname;
            // $UpdateDetails = admin::where('ID', '=',  $admin->ID)->first();
            // $UpdateDetails->first_name = $request->firstname;
            // $UpdateDetails->save();
            $UpdateDetails=DB::table('admins')->where('ID', $admin->ID)->update(['first_name' => $firstname]);

        if($UpdateDetails){
            return back()->with('success','you have been sucessful');
        }else{
            return back()->with('fail','something went wrong');
        }

    }

    function mystore(){
        $admin =admin::where('id','=',session('LoggedAdmin'))->first();
        // $stores = DB::select('select * from `store` where email="'.$admin->email.'"');
        $stores =DB::table('store')
            ->selectRaw('store_name')
            ->whereRaw('admin_id="'.$admin->ID.'"')
            ->get();
        
        // echo $stores;
        $data =[
            'LoggedAdminInfo'=>$admin,
            'Stores'=>$stores
        ];
        return view('admin.mystore',$data);
    }

    function store_product (){
        return view ('admin.storeproducts');
    }

    function logout(){
        if(session()->has('LoggedAdmin')){
            // session()->invalidate();
            session()->pull('LoggedAdmin');
            return redirect('admin_login');
        }
    }
}

