<?php

namespace App\Http\Controllers\API;

use Mail, Validator;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:191',
                'first_name' => 'required|string|max:191',
                'last_name' => 'required|string|max:191',
                'email' => 'required|string|max:191|email|unique:users',
                'password' => 'required|string|min:6|required_with:password_confirm|same:password_confirm',
            ]);
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()], 404);
            }

            $user = User::create([
                'user_name' => $request->username,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            if($user->id){
                return response()->json([
                    'status' => true,
                    'msg' => 'Đăng ký tài khoản thành công, vui lòng kiểm tra email để kích hoạt tài khoản!'
                ]);
            } else {
                throw new \Exception('Hiện tại hệ thống đăng ký tài khoản đang quá tải, vui lòng  thử lại sau!');
            }
        } catch(\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => 'error: '.$e->getMessage()
            ]);
        }

    }
}
