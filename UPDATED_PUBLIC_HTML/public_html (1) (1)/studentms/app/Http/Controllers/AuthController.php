<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginPage(){
        return view('auth.login');
    }

    public function registerPage(){
        return view('auth.register');
    }

    public function storeData(Request $request) {

        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|regex:/^(\+\d{1,3})?[-.\s]?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]+$/',
                // The regex enforces the following criteria:
                // At least one uppercase letter
                // At least one lowercase letter
                // At least one digit
                // At least one special character ($@$!%*?&)
            ],
        ]);

        $credentials = $request->except(['_token']);

        $credentials['password'] = Hash::make($request->input('password'));
        $user = User::create($credentials);

        return redirect()->route('login')->with('success', 'Yeah, Logged in successfully!');
    }


    public function authentication(Request $request){

        $this->validate($request, [
            'identity' => 'required',
            'password' => 'required',
        ]);

        $identity = $request->input('identity');
        $credentials = [
            'password' => $request->input('password'),
        ];

        if (filter_var($identity, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $identity;
        } else {
            // If not an email, consider it as a phone number
            $credentials['phone'] = $identity;
        }

        if (Auth::attempt($credentials)) {

            if (auth()->user()->role_position === 'admin') {
                return redirect()->route('admin_dashboard');
            }
            elseif(auth()->user()->role_position === 'branch'){
                return redirect()->route('branch_dashboard');
            }
        }
        elseif(Auth::guard('student')->attempt($credentials)){
            return redirect()->route('student_dashborad');
        }
        else{
            return redirect()->back()->withErrors(['email' => 'Invalid credentials', 'password' => 'Invalid credentials']);
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials', 'password' => 'Invalid credentials']);
    }

    public function logout(Request $request){

        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }
}
