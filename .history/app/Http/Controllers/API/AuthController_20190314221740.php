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

    public function register(Request $request)
    {
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

    /**
    * Get a JWT via given credentials.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (! $token = auth('api')->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
    * Get the authenticated User.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
    * Log the user out (Invalidate the token).
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
    * Refresh a token.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
    * Get the token array structure.
    *
    * @param string $token
    *
    * @return \Illuminate\Http\JsonResponse
    */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'user' => $this->guard()->user(),
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function guard(){
        return \Auth::Guard('api');
    }
    

}
