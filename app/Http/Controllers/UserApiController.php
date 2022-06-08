<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserApiController extends Controller
{
    public function ShowUser($id=null){
        if($id == ''){
            $users = User::get();
            return response()->json(['users'=>$users],200);
        }
        else{
            $users = User::find($id);
            return response()->json(['users'=>$users],200);
        }
    }
    public function AddUser(Request $request){
        if($request->ismethod('post')){
            $data = $request ->all();
            
            $rules= [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ];
            $customMessage = [
                'name.required'=>'Name is required',
                'email.required'=>'Email is required',
                'email.email'=>'Email must be a valid email',
                'password.required'=>'Password is required',
            ];

            $validator = Validator::make($data,$rules,$customMessage);
            if($validator->fails()){
                return response()->json($validator->errors(),422);
            }

            $user = new User();
            $user ->name=$data['name']; 
            $user ->email=$data['email']; 
            $user ->password= bcrypt($data['password']); 
            $user->save(); 
            $message ='User Succesfully Created';
            return response()->json(['message'=>$message],201);

        }
    }
}
