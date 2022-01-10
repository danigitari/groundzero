<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use function PHPUnit\Framework\throwException;

class   RegisterController extends Controller
{   public function _construct(){
    $this->middleware(['guest']);
}
    public function index(){
        return view('/register');
    }
    public function store(Request $request){
//        dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',

        ]);
        

       if(! $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password),
       ])){
//        dd($exception->getMessage());

           return response()->json([
               'error' => 'invalid credentials '
           ], 200);
//           return[
//               'error' => 'invalid credentials '
//           ];
       }


//        return redirect('/test');

        $user->attachRole('user');
//         if(auth()->attempt($request->only('name','password'))){
//             return ("logged in");
//         }
//         else {
//             return (" not logged in");

// //            throw ValidationException::withMessages([
// //                'email' => ['the provided credentials are incorrect']
// //            ]);
//         }
    }
}
