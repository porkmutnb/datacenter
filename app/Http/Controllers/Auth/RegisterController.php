<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Admin;
use Illuminate\Validation\Rule; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    public function formRegister() {
        return view('formRegister');
    }

    public function register() {
        $input = Input::all();
        switch ($input['button']) {
            case '1':
                $validator = Validator::make($input, [
                    'username' => 'required|min:6|max:255',
                    'email' => 'required|min:6|max:255',
                    'password' => 'required|min:6|same:passwordConfirm',
                    'passwordConfirm' => 'required|min:6'
                ]);
                if ($validator->fails()) {
                    return view('formRegister')
                                ->withErrors($validator);
                }else{
                    $check = User::where('email','=',$input['email'])->first();
                    if($check) {
                        $repeat['error'] = "not have this email: ".$input['email']; 
                        return view('formRegister')->withErrors($repeat);
                    }else{
                        $newuser = new User;
                        $newuser->username = $input['username'];
                        $newuser->email = $input['email'];
                        $newuser->password = md5($input['password']);
                        $newuser->save();
                        $repeat['success'] = "register complete Login again in email: ".$input['email']; 
                        return view('formLogin')->withErrors($repeat);
                    }
                }
                break;
            default:
                return Redirect::to('login');
                break;
        }
    }

}
