<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail, Validator;
use App\User;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function sendMail(){
        $data = array('name' => "Virat Gandhi");
        Mail::send('mail', $data, function($message) {
           $message->to('daochienhubt@gmail.com', 'Tutorials Point')->subject('Laravel HTML Testing Mail');
           $message->from('chienedudct@gmail.com','Virat Gandhi');
        });
        echo "HTML Email Sent. Check your inbox.";
    }

    public function verify(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'email' => 'required|string|max:191|email',
            'secretKey' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        }

        $secretKey = md5($request->id.$request->email.md5('@daochien'));
        if($secretKey != $request->secretKey){
            return response()->json(['Secret key không chính xác']);
        }

        $user = User::findOrFail($request->id);
        if($user->verify == 1){
            return response()->json(['Tài khoản của bạn đã được kích hoạt']);
        }
        $user->verify = 1;
        $user->save();
        return response()->json(['Kích hoạt tài khoản thành công']);
    }
}
