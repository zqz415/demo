<?php


namespace App\Http\Controllers;


use App\Models\Quality;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThirdController extends Controller
{

    /**
     * 查看空气质量
     * @return \Illuminate\Http\JsonResponse
     */
    public static function lookList(){

        $res=Quality::look_list();

        return  $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }

    /**
     * 填写建议
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public static function suggestion(Request $request){
        $id =  Auth::guard ('api')->id();
        $suggestion = $request['suggestion'];
        $res=Users::suggestion($id,$suggestion);
        return  $res ?
            json_success('成功!', $res, 200) :
            json_fail('失败!', null, 100);
    }
}
