<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    //

    public function login(){

    	 return view('auth.login');
    }

    public function register(){

    	 return view('auth.register');
    }



    //fungsi proses login post ambil request
    public function login_proses(Request $request){
        //remember
        $ingat = $request->remember ? true : false; //jika di ceklik true jika tidak gfalse
        //akan ingat selama 5 tahun jika tidak logout
    	 
    	//auth()->attempt buat proses login  request input username dan password,  request input  sama kayak $request->password dan usernamenya, ditambah $ingat jika pengen ingat
    	if(auth()->attempt(['username' => $request->input('username'), 'password' => $request->input('password')], $ingat)){
    		//auth->user() untuk memanggil data user yang sudah login
    		  if(auth()->user()->role == "auditor"){
                return redirect()->route('dashboard-auditor')->with('success', 'Anda Berhasil LOGIN');//route itu isinya name dari route di web.php
             }else if(auth()->user()->role == "prodi"){
                return redirect()->route('dashboard-prodi')->with('success', 'Anda Berhasil LOGIN');//route itu isinya name dari route di web.php
             }else if(auth()->user()->role == "kappm"){
                return redirect()->route('dashboard-kappm')->with('success', 'Anda Berhasil LOGIN');//route itu isinya name dari route di web.php
             }
                 
    	}else{

            return redirect()->route('login')->with('error', 'Username / Password anda salah'); //route itu isinya name dari route di web.php

        }
    }



    //register
    public function register_proses(Request $request){
            //pesan nya
        $messages = [
        'required' => ':attribute wajib diisi',
        'min' => ':attribute harus diisi minimal :min karakter ',
        'max' => ':attribute harus diisi maksimal :max karakter',
        'same' => ':attribute harus sama dengan re password',
        ];
 
            //validasi
        $this->validate($request, [
            //pasword validasinya repassword
            'password' => 'min:8|required_with:repassword|same:repassword',
            'repassword' => 'min:8'
        ], $messages);


        //disini soskod untuk create nya
         User::create([
           
            'username' => $request['username'], 
            'role' => $request['role']="admin",
            'password' => Hash::make($request['password']),
            
        ]);

         return redirect('/');
    }



    //proses logout
    public function logout(){
        
        auth()->logout(); //logout
        
        return redirect()->route('login');
        

    }
}
