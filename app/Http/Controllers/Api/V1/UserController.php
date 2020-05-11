<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = 'user index';
        return success_json($data);
    }

    /**
     * 用户登录
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author PeakXin<xinyflove@sina.com>
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return error_json(10001);
        };

        $params = request(['username', 'password']);

        if (!Auth::attempt($params)) {
            return error_json(10102);
        }

        $userInfo = Auth::user();

        $data = [
            'id' => $userInfo->id,
            'token' => $userInfo->token,
        ];

        return success_json($data);
    }

    /**
     * 用户登录信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author PeakXin<xinyflove@sina.com>
     */
    public function loginInfo(Request $request)
    {
        $data = [
            'name' => $request->userInfo['name']
        ];

        return success_json($data);
    }
}
