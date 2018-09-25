<?php
/**
 * Created by PhpStorm.
 * User: ANH
 * Date: 9/28/2017
 * Time: 4:28 PM
 */

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\FeedBack;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;
use Illuminate\Support\Facades\Input;

class FeedbackController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function send(Request $request)
    {
        return view('frontend.feedback.send');
    }

    public function sendAction(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'bug_type' => 'required',
            'name' => 'required',
            'username' => 'required',
            'title' => 'required',
            'content' => 'required',
        ], [
                'type.required' => 'Bộ phận hỗ trợ Không được bỏ trống',
                'bug_type.required' => 'Chủ đề trợ giúp Không được bỏ trống',
                'name.required' => 'Tên người liên hệ Không được bỏ trống',
                'username.required' => 'Tài khoản game Không được bỏ trống',
                'title.required' => 'Tiêu đề yêu cầu Không được bỏ trống',
                'content.required' => 'Nội dung Không được bỏ trống',
            ]
        );
        $formData = $request->all();
        $formData['user_id'] = Auth::user()->id;
        $menu = FeedBack::create($formData);
        if ($menu) {
            return redirect()->route('frontend.feedback.form-feedback')->with('success', __('Đã gửi phản hồi thành công,cảm ơn bạn'));
        }
        return redirect()->route('frontend.feedback.form-feedback')->with('error', __('Vui lòng kiểm tra lại thông tin'));
    }

}