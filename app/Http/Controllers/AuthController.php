<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Redirect, Response;
use App\Models\User;
use App\UserLevel;
use App\Http\Middleware\DatabaseHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;
use Log;

class AuthController extends Controller
{

    protected $maxAttempts = 5;
    protected $decayMinutes = 2;

    public function index()
    {
        if (Auth::check() == true) {
            return redirect('/');
        } else {
            return view('login');
        }
    }

    public function postLogin(Request $request)
    {
        if (Auth::check()) {
            return redirect()->intended('/');
        }else{

            request()->validate([
                'username' => 'required',
                'password' => 'required'
            ]);

            $credentials    = $request->only('username', 'password');
            $user_check     = User::where("username",$credentials["username"])->first();

            if(!$user_check){
                return Redirect::to("/login")->withInput($request->all())->withErrors(['error' => 'Username tidak ditemukan']);

            }else{

                if (Auth::attempt($credentials)) {
                    Session::put('role', $user_check->role->role);
                    
                    return Redirect::to('/home');
        
                } else { // false
        
                    //Login Fail
                    return Redirect::to("/login")->withInput($request->all())->withErrors(['error' => 'Username atau Password salah']);
                }
 
                
            }
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect::to('/login');
    }

}
