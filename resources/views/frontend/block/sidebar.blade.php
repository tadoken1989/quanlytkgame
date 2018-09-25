@if(auth()->user())
    <div class="sidebar col-md-3">
        <div class="userpro_menu_tablist">
            <div class="userpro-box">
                <a ng-href="javascript:;" class="avatar" href="javascript:;">
                    <img ng-src="{{ auth()->user()->avatar }}" alt="" src="{{ auth()->user()->avatar }}">
                </a>
                <a href="#" class="username"><span class="ng-binding">{{ auth()->user()->username }}</span></a>
                <span class="ng-binding">UserID: {{ auth()->user()->id }}</span><br>
                <span class="ng-binding">Điểm tích luỹ : {{ auth()->user()->score }}</span><br>
            </div>
            <div class="userpro-menu border">
                <ul>
                    <li><a href="{{ route('frontend.user.profile') }}"><i class="ion-person"></i> Thông tin tài
                            khoản</a><span class="iconlist"><i class="fa fa-angle-right"></i></span>
                    </li>
                    <li class="has-icon-new" id="change-info-menu">
                        <a>
                            <i class="ion-lock-combination"></i>Thay đổi thông tin</a>
                        <span class="iconlist"><i class="fa fa-angle-right"></i></span>
                        <ul class="submenu-area">
                            <li id="li-change-pass"><a href="{{ route('frontend.user.change-pass') }}" >Đổi mật khẩu cấp 1</a></li>
                            <li id="li-change-pass-2"><a href="{{ route('frontend.user.change-pass-2') }}">Đổi mật khẩu cấp 2</a></li>
                            <li id="li-change-email"><a href="{{ route('frontend.user.change-email') }}" >Đổi Email tài khoản</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('frontend.user.payment') }}"><i class="fa fa-usd"></i> Nạp tiền</a><span
                                class="iconlist"><i class="fa fa-angle-right"></i></span>
                    </li>
                    <li><a href="{{ route('user.payment.history') }}"><i class="fa fa-usd"></i> Lịch sử nạp
                            tiền</a><span class="iconlist"><i class="fa fa-angle-right"></i></span>
                    </li>
                    <li class="has-icon-new" id="feedback-menu">
                        <a>
                            <i class="fa fa-commenting"></i>Hệ thống hỗ trợ</a><span class="iconlist">
                                <i class="fa fa-angle-right"></i></span>
                        <ul class="submenu-area">
                            <li id="send_feedback"><a href="{{ route('frontend.feedback.form-feedback') }}">Gửi yêu cầu hỗ trợ</a></li>
                            {{--<li id="feedback_history"><a href="javascript:;">Lịch sử</a></li>--}}
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('frontend.user.logout') }}"><i class="fa fa-share-square-o" aria-hidden="true"></i> Thoát</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endif