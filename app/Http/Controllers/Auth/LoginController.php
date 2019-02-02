<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Admin;
use Auth;
use Illuminate\Validation\Rule; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function formLogin() {
        return view('formLogin');
    }

    public function login() {
        $input = Input::all();
        switch ($input['button']) {
            case '1':
                $validator = Validator::make($input, [
                    'email' => 'required|min:6|max:255',
                    'password' => 'required|min:6'
                ]);
                if ($validator->fails()) {
                    return view('formLogin')
                                ->withErrors($validator);
                }else{
                    $check = User::where('email','=',$input['email'])->where('password','=',md5($input['password']))->first();
                    if($check) {
                        Auth::guard('web')->login($check, true);
                        return view('profile');
                    }else{
                        $repeat['error'] = "incorrect, please try again: ".$input['email']; 
                        return view('formLogin')->withErrors($repeat);
                    }
                }
                break;
            default:
                return Redirect::to('register');
                break;
        }
    }

    public function formAdminLogin() {
        return view('formAdminLogin');
    }

    public function AdminLogin() {
        $input = Input::all();
        $validator = Validator::make($input, [
            'email' => 'required|min:6|max:255',
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return view('formAdminLogin')
                        ->withErrors($validator);
        }else{
            $validator = Validator::make($input, [
                'email' => 'required|min:6|max:255',
                'password' => 'required|min:6'
            ]);
            if ($validator->fails()) {
                return view('formAdminLogin')
                            ->withErrors($validator);
            }else{
                $check = Admin::where('email','=',$input['email'])->where('password','=',md5($input['password']))->first();
                if($check) {
                    Auth::guard('admin')->login($check, true);
                    return Redirect::to('admin/profile');
                }else{
                    $repeat['error'] = "incorrect, please try again: ".$input['email']; 
                    return view('formAdminLogin')->withErrors($repeat);
                }
            }
        }
    }

    public function logout() {
        Auth::logout();
        return Redirect::to('/');
    }

    public function logoutAdmin() {
        Auth::guard('admin')->logout();
        return Redirect::to('admin');
    }

}
