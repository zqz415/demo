<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public $loginAfterSignUp = true;

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function login(){

        $data = request(['name','password']);
        // dd($data);
        if($token = auth('api')->attempt($data)){
            $res = $this->respondWithToken($token);
          return  $res ?
                json_success('登录成功!', $res, 200) :
                json_fail('登录失败!', null, 100);
        }

        return response()->json(['error'=>'Unauthorized'],401);
    }

    public function me()
    {
        // dd(11);
        return response()->json(auth('api')->user());
    }

    public function logout(){

        $data = auth('api')->logout();

        return response()->json(['msg'=>'success','data'=>$data]);
    }

    public function register(Request $request)
    {

        $a = Users::where('name',$request->name)->count();

        if ($a>0){
            return json_fail('用户已存在!', null, 100);
        }
        $user = new User();
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();

//        if ($this->loginAfterSignUp) {
//            return $this->login($request);
//        }


        $res =  response()->json([
            'success' => true,
            'data' => $user
        ], 200);
        return  $res ?
            json_success('注册成功!', null, 200) :
            json_fail('注册失败!', null, 100);
    }

}
