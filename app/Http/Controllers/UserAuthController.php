<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB; //use database sql query

use Intervention\Image\Facades\Image;

use Mail;
use File;

use App\Mail\EmailVerificationMail;

use App\Models\User;

class UserAuthController extends Controller
{
    function login (){
        return view ('auth.login');
    }
    function register (){
        return view ('auth.register');
    }
    function create (Request $request){
        //validate request
        $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12'
            
        ]);
        //if form validated successfully,then  register new user
        $user =new User;
        // $user = User::where('email','=', $request->email)->first;
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->email_verification_code = Str::random(40);
        $query = $user ->save();

        Mail::to($request->email)->send(new EmailVerificationMail($user));

        if($query){
            // session()->flash('sucessful', 'Successfully done the operation.');
            return Redirect::to('login')->with('success','Please check email'); 
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

        $user = User::where('email','=', $request->email) -> first(); 
        if($user){
            if(!$user->verify_status){
                return back()->with('fail','Please verify your email');
            }
            if(Hash::check($request->password,$user->password)){
                $request->session()->put('LoggedUser',$user->id);
                return redirect('profile');
            }else{
                return back()->with('fail','Invalid Password');
            }
        }else{
            return back()->with('fail','No account found for this email');
        }
    }

    public function verify_email($verification_code){
        $user = User::where('email_verification_code',$verification_code)->first();
        if(!$user){
            return redirect('login')->with('fail','Invalid Verification Code');
        }else{
            if(!$user->verify_status){
                // $user->update([
                //     'verify_status'=>true,
                // ]);
                $UpdateDetails = User::where('id', '=',  $user->id)->first();
                $UpdateDetails->verify_status = true;
                $UpdateDetails->save();
                // session()->flash('sucessful', 'Successfully done the operation.');
                return redirect('login')->with('success','verify successful');

            }else{
                // session()->flash('fail', 'Fail');
                return redirect('login')->with('fail','Something went wrong');    
            }
        }
    }

    function profile(){
        $user =User::where('id','=',session('LoggedUser'))->first();
        $data =[
            'LoggedUserInfo'=>$user
        ];
        return view('user.profile',$data);
    }
    function editprofile(){
        $user =User::where('id','=',session('LoggedUser'))->first();
        $data =[
            'LoggedUserInfo'=>$user
        ];
        return view('user.edit',$data);
    }

    function update (Request $request){
        //validate request
        $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            
        ]);
        //if form validated successfully,then  register new user
            
            $user =User::where('id','=',session('LoggedUser'))->first();

            $UpdateDetails = User::where('id', '=',  $user->id)->first();
            $UpdateDetails->first_name = $request->firstname;
            $UpdateDetails->last_name = $request->lastname;
            $UpdateDetails->save();

        // $image = array();
        // if($files =$request-> file('image')){
        //     foreach($files as $file){
        //         $image_name = md5(rand(1000,10000));

        //     }
        // }

        if($UpdateDetails){
            return back()->with('success','you have been sucessful');
        }else{
            return back()->with('fail','something went wrong');
        }

    }

    function upload_avantar (Request $request){
        $user =User::where('id','=',session('LoggedUser'))->first();
        $UpdateDetails=NULL;
        // dd($request->avatar);
        if ($request->avatar){
            $avatar = $request->file('avatar');
            $filename = time().'.'.$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save(public_path('uploads/avantars/'.$filename));
            // print_r($filename) ;
            $UpdateDetails = User::where('id', '=',  $user->id)->first();
            $UpdateDetails->profile_image = $filename;
            $UpdateDetails->save(); 
            return back()->with('success','you have been sucessful');
         }else{
            return back()->with('fail','something went wrong');
         }

        
    }

    function remove_avantar (Request $request){
        $user =User::where('id','=',session('LoggedUser'))->first();
        $UpdateDetails = User::where('id', '=',  $user->id)->first();
        // dd($request->avatar);
        if ($UpdateDetails){
            File::delete(public_path('uploads/avantars/'.$UpdateDetails->profile_image ));
            $UpdateDetails->profile_image = NULL;
            $UpdateDetails->save(); 
            return back()->with('success','you have been sucessful');
         }else{
            return back()->with('fail','something went wrong');
         }

        
    }

    function logout(){
        if(session()->has('LoggedUser')){
            // session()->invalidate();
            session()->pull('LoggedUser');
            return redirect('login');
        }
    }
}
