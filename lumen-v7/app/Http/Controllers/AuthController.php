<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;


class AuthController extends Controller
{
    public function register (Request $request)
    {
        $input =  $request->all();
        // dd($input);
        $validator = Validator::make($input, [
            'email'=>'required|email',
            'password'=>'required',
            'confirm_password'=>'required|same:password'
        ]);
        // dd($validator);
        
        if($validator->fails())
        {
            return response()->json([
            'status'=> 500,
            'message'=>'Bad REQ',
            'error'=> $validator->errors()
            ],401);
        }
         unset($input['confirm_password']);
        $input['password']=Hash::make($input['password']);
        $query =User::create($input);
 
        $response['token']=$query->createToken('users')->accessToken;
        $response['email']=$query->email;

        return response()->json($response,200);
    }

   public function login(Request $request)
   {
       $input=$request->all();
       $validator = Validator::make($input,[
           'email'=>'required|email',
           'password'=>'required'
       ]);

       if($validator->fails())
       {
           return response()->json([
               'status'=>500,
                'message'=>'bad REQ',
                'error'=>$validator->errors(),
           ],401);
       }

       $check_users = User::where('email','=',$input['email'])->first();
    
       if(@count($check_users)>0)
       {
           $password =$input ['password'];
           if(Hash::check($password,$check_users['password']))
           {
            //    dd('true');
            $response['token']=$check_users->createToken('users')->accessToken;
            $response['status']=200;
            $response['message']='login successfully';

            return response()->json($response,200);
            
           }
           else{
            $response['status']=401;
            $response['message']='unsuccess';
 
            return response()->json($response,401);   
           }          
           
       }
   }
}
