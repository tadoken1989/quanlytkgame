<?php
/**
 * Created by PhpStorm.
 * User: ANH
 * Date: 5/11/2017
 * Time: 8:35 PM
 */

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;
use Illuminate\Support\Facades\Input;


class AjaxController extends Controller
{
    protected $res = [
        'status' => 500,
        'data' => [],
        'mess' => ""
    ];

    public function sendCodeForgot(Request $request)
    {
        $this->res = [
            'status' => 403,
            'data' => [],
            'mess' => "Tài khoản tồn tại trong hệ thống"];
        $username = $request->get('username');
        if ($username) {
            $user = User::where('username', $username)->where('status', 1)->first();
            if ($user) {
                $code = rand(1000000, 10000000);
                $mess = $this->contentMgs($code);
                if ($this->sendSmsCode($mess, trim($user->phone_number))) {
                    $user->token_code = $code;
                    if ($user->save()) {
                        $this->res = [
                            'status' => 200,
                            'data' => [],
                            'mess' => "Vui lòng kiểm tra tin nhắn của bạn"
                        ];
                    }
                }
            }
        }
        return response()->json($this->res, $this->res['status']);
    }
} 