<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // show login form
    public function index(){
        return view('users.login');
    }

    // show user create form
    public function create(){
        return view('users.create');
    }
    
    //to store user-data
    public function store(){

        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:15',
            'phone' => 'required|min:8|max:11|digits:10'
        ]);

        $name=request('name');
        $email=request('email');
        $password=request('password');
        $phone=request('phone');
        $image=request()->file('image');

        $user_data=[
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'phone' => $phone
        ];
        if(request()->hasFile('image')){
            $user_data['image'] = $image->store('user_image','public');
        }
        User::create($user_data);
        return redirect()->route('account.create')->with('message','User account created successfully');

    }

    // login user
    public function login(){
        $input= ['email'=>request('email'),'password'=>request('password')];
        if(auth()->attempt($input,true)){

            return redirect()->route('home')->with('message', 'Login Successfully');
            
        }else{
            return redirect()->route('account.create')->with('message', 'Invalid Credentials...');
        }
    }

    //logout user
    public function logout(){
        auth()->logout();
        return redirect()->route('login')->with('message', 'Logout Successfully');
    }

    public function profile(){
        return view('users/profile');
    }
}
