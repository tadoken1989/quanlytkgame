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


class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
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

    public function changePassword(Request $request)
    {
        return view('frontend.users.change_password');
    }

    public function changePassword2(Request $request)
    {
        return view('frontend.users.change_password_2');
    }

    public function changeEmail(Request $request)
    {
        return view('frontend.users.change_email');
    }

    public function profile()
    {
        return view('frontend.users.profile');
    }

    public function logout(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->api_token = NULL;
        $user->save();
        Auth::logout();
        $request->session()->flush();
        return redirect()->away('/');
    }

    public function changePasswordAction(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6',
            'password_new' => 'required|min:6',
        ], [
                'password.required' => 'Mật khẩu không được bỏ trống',
                'password.min' => 'Mật khẩu phải nhiều hơn 6 ký tự',
                'password_new.required' => 'Mật khẩu mới không được bỏ trống',
                'password_new.min' => 'Mật khẩu mới phải nhiều hơn 6 ký tự',
            ]
        );
        if ($this->remoteCheckLogin(Auth::user()->username, trim($request->password))) {
            $check = $this->updatePass(Auth::user()->username, trim($request->password_new));
            if ($check) {
                $user = User::find(Auth::user()->id);
                $user->pass_1 = trim($request->password_new);
                if ($user->save()) {
                    return redirect()->route('frontend.user.profile')->with('success', __('Cập nhật thành công !'));
                }
            }
        }
        return redirect()->route('frontend.user.change-pass')->with('error', __('Mật khẩu cũ không chính xác'));
    }

    public function changePassword2Action(Request $request)
    {
        $this->validate($request, [
            'password_2' => 'required|min:6',
            'password_2_new' => 'required|min:6',
        ], [
                'password_2.required' => 'Mật khẩu không được bỏ trống',
                'password_2.min' => 'Mật khẩu phải nhiều hơn 6 ký tự',
                'password_2_new.required' => 'Mật khẩu mới không được bỏ trống',
                'password_2_new.min' => 'Mật khẩu mới phải nhiều hơn 6 ký tự',
            ]
        );
        $user = User::find(Auth::user()->id);
        if ($user->pass_2 == trim($request->password_2)) {
            $check = $this->updatePass2(Auth::user()->username, trim($request->password_2_new));
            if ($check) {
                $user->pass_2 = trim($request->password_2_new);
                if ($user->save()) {
                    return redirect()->route('frontend.user.profile')->with('success', __('Cập nhật thành công !'));
                }
            }
        }
        return redirect()->route('frontend.user.change-pass-2')->with('error', __('Mật khẩu cũ không chính xác'));
    }


    public function changeEmailAction(Request $request)
    {
        $this->validate($request, [
            'email_new' => 'required|email|unique:users,email',
            'email' => 'required|email',
        ], [
                'email_new.required' => 'Email mới không được bỏ trốngs',
                'email.required' => 'Email cũ không được bỏ trống',
                'email.email' => 'Email cũ không đúng định dạng',
                'email_new.unique' => 'Email này đã tồn tại trong hệ thống,vui lòng nhập 1 email khác',
            ]
        );
        $user = User::find(Auth::user()->id);
        if ($user->email == trim($request->email)) {
            $user->email = trim($request->email_new);
            if ($user->save()) {
                return redirect()->route('frontend.user.profile')->with('success', __('Cập nhật thành công !'));
            }
        }
        return redirect()->route('frontend.user.change-email')->with('error', __('Email cũ không chính xác'));
    }

    public function payment()
    {
        return view('frontend.users.payment');
    }

    public function paymentAction(Request $request)
    {
        $this->validate($request, [
            'provider' => 'required',
            'card_seri' => 'required|min:6',
            'card_code' => 'required|min:6',
        ], [
                'provider.required' => 'Vui lòng chọn nhà cung cấp',
                'card_seri.required' => 'Vui lòng nhập số serial',
                'card_code.required' => 'Vui lòng nhập mã thẻ',
                'card_code.min' => 'Mã thẻ không đúng định dạng,hoặc quá ngắn',
                'card_seri.min' => 'Mã thẻ không đúng định dạng,hoặc quá ngắn',
            ]
        );
        $form = $request->all();
        if (in_array($form['provider'], $this->providerCard)) {
            $token_user = Auth::user()->api_token;
            if (!$token_user) {
                return redirect()->route('frontend.user.payment')->with('error', __('Bạn vui lòng đăng nhập lại trước khi thực hiện nap'));
            }
            $formData = [
                'provider' => $form['provider'],
                'pin' => $form['card_code'],
                'serial' => $form['card_seri'],
                'api_token' => $token_user
            ];
            $url = $this->baseUrlApi . $this->apiPayment;
            $res = json_decode($this->callApi('POST', $url, $formData), true);
            if ($res['status'] == 200 && $res['data']) {
                return redirect()->route('frontend.user.payment')->with('success', __('Bạn đã nạp thẻ thành công'));
            } elseif ($res['status'] == 50) {
                return redirect()->route('frontend.user.payment')->with('error', __('Mã thẻ đã bị sử dụng'));
            } elseif ($res['status'] == 53) {
                return redirect()->route('frontend.user.payment')->with('error', __('Mã thẻ sai hoặc serial không đúng định dạng'));
            } else {
                return redirect()->route('frontend.user.payment')->with('error', __('Hệ thống quá tại,vui lòng thử lại sau'));
            }
        }
        return redirect()->route('frontend.user.payment')->with('error', __('Nhà cung cấp thẻ không được hỗ trợ'));
    }

    public function paymentAtm()
    {
        return view('frontend.users.payment_atm');
    }


    public function paymentAtmAction(Request $request)
    {
        $this->validate($request, [
            'txnAmount' => 'required',
            'bankID' => 'required',
            'userCardName' => 'required|min:6',
        ], [
                'txnAmount.required' => 'Bạn vui lòng chọn mệnh giá nạp',
                'bankID.required' => 'Vui lòng chọn ngân hàng',
                'userCardName.required' => 'Bạn vui lòng nhập đầy đủ họ tên không dấu',
                'userCardName.min' => 'Bạn vui lòng nhập đầy đủ họ tên không dấu',
            ]
        );
        $form = $request->all();
        if ((in_array($form['bankID'], $this->bankSupport)) && (in_array($form['txnAmount'], $this->supportTxnAmount)) && $this->check_userName($form['userCardName'])) {
            $token_user = Auth::user()->api_token;
            if (!$token_user) {
                return redirect()->route('frontend.user.payment_atm')->with('error', __('Bạn vui lòng đăng nhập lại trước khi thực hiện giao dịch'));
            }
            $formData = [
                'bankID' => $form['bankID'],
                'txnAmount' => $form['txnAmount'],
                'userCardName' => $form['userCardName'],
                'fee' => $this->fee,
                'api_token' => $token_user
            ];
            $url = $this->baseUrlApi . $this->apiPaymentAtm;
            $res = json_decode($this->callApi('POST', $url, $formData), true);
            if ($res['status'] == 200 && $res['data']) {
                if (!is_null($res['data']['url'])) {
                    $request->session()->put(Auth::user()->id . '_txnAmount', $form['txnAmount']);
                    return redirect($res['data']['url']);
                }
            }
        }
        return redirect()->route('frontend.user.payment_atm')->with('error', __('Tên thanh toán,Ngân hàng hoặc mệnh giá chọn không được hỗ trợ'));
    }

    protected function check_userName($username)
    {
        return (!preg_match("/^[[:alpha:]- 1234567890_-ÀÁẢÃẠÂẦẤẨẪẬĂẰẮẲẴẶÄÅĀĄĂÆÇĆČĈĊĎĐÈÉẺẼẸÊỀẾỂỄỆËĒĘĚĔĖĜĞĠĢĤĦÌÍỈĨỊÎÏĪĨĬĮİĲĴĶŁĽĹĻĿÑŃŇŅŊÒÓỎÕỌÔỒỐỔỖỖƠỜỚỞỠỢÕÖØŌŐŎŒŔŘŖŚŠŞŜȘŤŢŦȚÙÚŨỤƯỪỨỬỮỰÛÜŪŮŰŬŨŲŴÝỲỶỸỴŶŸŹŽŻàáảãạâầấẩẫậăằắẳẵặãäåæçèéẻẽẹêềếểễệëìíỉĩịîïñòóỏõọôồốổỗộơờớởỡợõöøùúủũũưừứửữựûüýỳỷỹỵÿœšß_.]+$/", $username)) ? FALSE : TRUE;
    }

    public function bakingResult(Request $request)
    {
        $transid = $request->get('transid');
        $responCode = $request->get('responCode');
        $mac = $request->get('mac');
        if (!$responCode || !$transid || !$mac || $responCode != '00') {
            $request->session()->forget(Auth::user()->id . '_txnAmount');
            return redirect()->route('frontend.user.payment_atm')->with('error', __('Giao dịch không thành công !'));
        } else {
            $txnAmount = $request->session()->pull(Auth::user()->id . '_txnAmount', 10000);
            $token_user = Auth::user()->api_token;
            $formData = [
                'transid' => $transid,
                'responCode' => $responCode,
                'txnAmount' => $txnAmount,
                'mac' => $mac,
                'api_token' => $token_user
            ];
            $url = $this->baseUrlApi . $this->apiPaymentAtmHandle;
            $res = json_decode($this->callApi('POST', $url, $formData), true);
            if ($res['status'] == 200 && $res['data']) {
                return redirect()->route('frontend.user.payment_atm')->with('success', __('Bạn đã nạp thẻ thành công,vui lòng xem lịch sử nap thẻ biết thêm thông tin'));
            } else {
                return redirect()->route('frontend.user.payment_atm')->with('error', __('Giao dịch không thành công !'));
            }
        }
    }

    public function userPaymentHistory()
    {
        $history = DB::table('user_payment_history')->where('user_payment_history.user_id', Auth::user()->id)->get();
        return view('frontend.users.payment_history', compact('history'));
    }
} 