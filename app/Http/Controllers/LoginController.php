<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

//    protected $redirectTo = '/test';
    public function index(){
        return view('login');
  
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',

        ]);

        if(Auth::attempt($request->only('name', 'password'))){

//            $request->session()->regenerate();
            if(Auth::user()->hasRole('user')){
                     return [
                        'role' => 'user '
                    ];
                }
                elseif(Auth::user()->hasRole('administrator')){
                    return [
                        'role' => 'admin'
                    ];
                }
                else{
                    return [
                        'role' => 'user'
                    ];
                }   

        }

            return [
                'errors' => 'invalid credentials '
            ];

        



    }

    protected function redirectTo(){
        return 'test';
    }
    protected function authenticated(Request $request, $user){
        return redirect('/test');
    }


}
