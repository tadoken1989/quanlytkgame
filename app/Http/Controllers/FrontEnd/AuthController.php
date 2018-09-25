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


class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::user()) {
            return view('frontend.users.login');
        }
        return redirect()->route('frontend.user.profile');
    }

    public function checkLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                'username' => 'required|alpha_dash',
                'password' => 'required',

            ], [
                'username.required' => 'Tên tài khoản không được bỏ trống',
                'username.alpha_dash' => 'Tên tài khoản không được chứa kí tự đặc biệt',
                'password.required' => 'Mật khẩu không được bỏ trống',
            ]
        );
        $formData = $request->all();
        if (array_key_exists('username', $formData) && array_key_exists('password', $formData)) {
            // cal api
            $url = $this->baseUrlApi . $this->apiLogin;
            $res = json_decode($this->callApi('POST', $url, $formData), true);
            if ($res['status'] == 200 && $res['data']) {
                $accountInfo = User::where('username', $formData['username'])->first();
                $accountInfo->api_token = str_random(100);
                $accountInfo->save();
                Auth::login($accountInfo);
                return redirect()->route('frontend.user.profile')->with('success', __('Đăng nhập thành công !'));
            }
        }
        return redirect()->route('frontend.user.login')
            ->with('error', __('Tên tài khoản hoặc mật khẩu không chính xác'));
    }

    public function register(Request $request)
    {
        if (!Auth::user()) {
            return view('frontend.users.register');
        }
        return redirect()->route('frontend.user.profile');
    }

    public function forgot(Request $request)
    {
        if (!Auth::user()) {
            return view('frontend.users.forgot');
        }
        return redirect()->route('frontend.user.profile');
    }

    public function registerAction(Request $request)
    {
        $this->validate(
            $request,
            [
                'username' => 'required|alpha_dash|unique:users,username',
                'password' => 'required|min:6',
                'password_2' => 'required|min:6',
                're_password' => 'required|same:password',
//                'email' => 'required|email|unique:users,email',
//                'phone_number' => 'required|unique:users,phone_number',
            ],
            [
                'username.required' => 'Tên tài khoản không được bỏ trống',
//                'email.required' => 'Email không được bỏ trống',
                'username.alpha_dash' => 'Tên tài khoản không được chứa kí tự đặc biệt',
                'username.unique' => 'Tên tài khoản đã tồn tại trong hệ thống',
//                'email.unique' => 'Email đã tồn tại trong hệ thống',
//                'phone_number.unique' => 'Số điện thoại đã tồn tại trong hệ thống',
//                'phone_number.required' => 'Số điện thoại không được bỏ trống',
                'password.required' => 'Mật khẩu không được bỏ trống',
                'password.min' => 'Mật khẩu phải nhiều hơn 6 ký tự',
                'password_2.required' => 'Mật khẩu 2 không được bỏ trống',
                'password_2.min' => 'Mật khẩu 2 phải nhiều hơn 6 ký tự',
                're_password.same' => 'Xác nhận mật khẩu cấp 1 và mật khẩu cấp 1 của bạn không giống nhau',
            ]
        );
        $form = $request->all();
        if(!array_key_exists('email',$form) || is_null($form['email'])){
            $form['email'] = 'no-email.'.rand(1000,1000000).'@vdev.vn';
        }
        if(!array_key_exists('phone_number',$form) || is_null($form['phone_number'])){
            $form['phone_number'] = rand(1000,10000000);
        }
        $loginGame = $this->remoteRegisterUser(trim($form['username']), trim($form['password']), trim($form['password_2']));
        if ($loginGame) {
            $loginInfo = new User();
            $loginInfo->username = trim($form['username']);
            $loginInfo->name = trim($form['username']);
            $loginInfo->password = bcrypt($form['password']);
            $loginInfo->pass_1 = trim($form['password']);
            $loginInfo->pass_2 = trim($form['password_2']);
            $loginInfo->birthday = \Carbon\Carbon::now();
            $loginInfo->email = trim($form['email']);
            $loginInfo->phone_number = trim($form['phone_number']);
            $loginInfo->api_token = str_random(100);
            if ($loginInfo->save()) {
                Auth::login($loginInfo);
                return redirect()->route('frontend.user.profile')->with('success', __('Đăng kí thành công !'));
            }
        }
        return redirect()->route('frontend.user.register')->with('error', __('Không thể đăng kí,lòng kiểm tra lại thông tin'));
    }

    public function getNewPass(Request $request)
    {
        $this->validate($request, [
            'token_code' => 'required|min:6',
        ], [
            'token_code.min' => 'Mã code phải nhiều hơn 6 ký tự',
        ]);
        $token_code = $request->get('token_code');
        $user = User::where('token_code', $token_code)->first();
        if ($user) {
            $newPass = str_random(7);
            if ($this->updatePass($user->username, $newPass)) {
                $user->password = bcrypt($newPass);
                $user->pass_1 = $newPass;
                if ($user->save()) {
                    $mess = 'Mật khẩu mới của bạn là ' . $newPass;
                    if ($this->sendSmsCode($mess, trim($user->phone_number))) {
                        $user->token_code = '';
                        $user->save();
                        return redirect()->route('frontend.user.login')->with('success', __('Reset thành công !'));
                    }
                }
            }
        }
        return redirect()->route('frontend.user.forgot')->with('error', __('Mã xác nhận không chính xác'));
    }
} 