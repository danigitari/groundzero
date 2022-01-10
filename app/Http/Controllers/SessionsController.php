<?php

namespace App\Http\Controllers;

use App\Models\Turfsession;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;

class SessionsController extends Controller

{
  

        public function index(){
            if(Auth::user()->hasRole('user')){
            return view('test');
            }
            else{
                return view('admin');
            }
        }

    
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'phoneNumber' => 'required',
            'email' => 'required|email',
            'date' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);
        // dd(Auth::user());
//        $data = Turfsession::where('date', '=' ,$request->date)->get();
//        $data2 = null;
//        dd(count($data));
//        dd(Turfsession::where('date', '=' ,$request->date)->get());

//        dd(Turfsession::whereBetween('start',[$request->start,$request->end])->get());

        if(count(Turfsession::where('date', '=' ,$request->date)->get())){
            if(Turfsession::whereBetween('start',[$request->start,$request->end])->get()){
                return [ 'data' => 'there is a session booked at this time'];
            }
            else {

                Turfsession::create([
                    'name' => $request->name,
                    'phoneNumber' => $request->phoneNumber,
                    'email' => $request->email,
                    'date' => $request->date,
                    'start' => $request->start,
                    'end' => $request->end,
                    'user_id' => Auth::id(),
                ]);
            }

        }
        else {

            Turfsession::create([
                'name' => $request->name,
                'phoneNumber' => $request->phoneNumber,
                'email' => $request->email,
                'date' => $request->date,
                'start' => $request->start,
                'end' => $request->end,
                'user_id' => Auth::id(),
            ]);
        }

     }
        public function turfSessions(): array
        {

            $sessions = Turfsession::where('user_id', '=' , Auth::id())->get()->toArray();
            $new_sessions=[];
            $index = 0;
                foreach ($sessions as $session){
                $index ++;
                $new_array = array('edit' => "" , 'delete' => "",'index'=>"$index" );
                $session2 = array_merge($session,$new_array);
                array_push($new_sessions,$session2);
            }
            

            return   [ 'data' => $new_sessions ];
        }
        public function user_list(): array
        
        {
            $new_users=[];
            $users_list = User::get()->toArray();
            foreach ($users_list as $user_list){
                $new_array = array('role' => "" );
                $session2 = array_merge($user_list,$new_array);
                array_push($new_users,$session2);
            }
            
            return   [ 'data' => $new_users ];
        }
        public function drop(Request $request){
        json_decode($request->getContent(), true);
        // dd($request->name);
        
        if(Turfsession::where('id', '=', $request->name)->delete()){
            return("deleted");
        }
        else{
            return "not deleted";
        }


        }
        public function dropuser(Request $request){
       
            // dd($request->name);
            
            if(User::where('id', '=', $request->name)->delete()){
                return("deleted");
            }
            else{
                return "not deleted";
            }
    
    
            }
        public function listAllSessions(): array
        {
//            $date = new \DateTime();
//            $date->format('Y-m-d');
            //            dd($date);


            $date = date('Y-m-d');

            $sessions = Turfsession::where('date', '>=', $date)->get();
    //            dd($sessions);
    //            $session= [];

            return   [ 'data' => $sessions ];
        }
        public function AllSessions(): array
        {

            $sessions = Turfsession::get();
    //            dd($sessions);
    //            $session= [];

            return   [ 'data' => $sessions ];
        }


}
