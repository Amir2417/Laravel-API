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
    //Multiple User
    public function AddMultipleUser(Request $request){
        if($request->ismethod('post')){
            $data = $request->all();

            $rules = [
                'users.*.name' => 'required',
                'users.*.email' => 'required|email|unique:users',
                'users.*.password' => 'required',
                
            ];
            $customMessage = [
                'users.*.name.required'=> 'Name is required',
                'users.*.email.required'=> 'email is required',
                'users.*.email.email'=> 'Email must ba a valid email',
                'users.*.password'=> 'Password is required',
            ];
            $validator = Validator::make($data,$rules,$customMessage);
            if($validator->fails()){
                return response()->json($validator->errors(),422);
            }

            foreach($data['users'] as $addUser){
                $user = new User();
                $user -> name= $addUser['name'];
                $user -> email= $addUser['email'];
                $user -> password= bcrypt($addUser['password']);
                $user->save();
                $message = 'User Inserted Succesfully';
                
            }
            return response()->json(['message'=>$message]);

        }
    }

    public function UpdateUserDetails(Request $request,$id){
        if($request->ismethod('put')){
            $data = $request->all();

            $rules =[
                'name' => 'required',
                'password' => 'required',
            ];
            $customMessage = [
                'name.required' => 'Name is Required',
                'password.required' => 'Password is Required',
            ];
            $validator = Validator::make($data,$rules,$customMessage);
            if($validator->fails()){
                return response()->json($validator->errors(),422);
            }

            $user = User::findOrFail($id);
            $user ->name=$data['name']; 
            $user ->password= bcrypt($data['password']); 
            $user->save(); 
            $message ='User Succesfully Updated';
            return response()->json(['message'=>$message],202);
            
        }
    }
    public function UpdateSingleRecord(Request $request,$id){
        if($request->ismethod('patch')){
            $data = $request->all();

            $rules =[
                'name' => 'required',
                
            ];
            $customMessage = [
                'name.required' => 'Name is Required',
                
            ];
            $validator = Validator::make($data,$rules,$customMessage);
            if($validator->fails()){
                return response()->json($validator->errors(),422);
            }

            $user = User::findOrFail($id);
            $user ->name=$data['name']; 
            $user->save(); 
            $message ='User Succesfully Updated';
            return response()->json(['message'=>$message],202);
            
        }
    }
    public function DeleteSingleUser($id=null){
        User::findOrFail($id)->delete();
        $message ='User Succesfully Deleted';
        return response()->json(['message'=>$message],200);
    }
}
