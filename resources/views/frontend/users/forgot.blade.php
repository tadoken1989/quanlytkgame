@extends('frontend.layouts.app')
@section('content')
    <ui-view class="ng-scope"><div class="content-wrapper ng-scope">
        <div class="user_profile">
            <div class="container">
            <div class="">
                <!-- information account-->
                <div class="content-main col-md-12">
                    <div class="grid-category green user_profile_main">
                         <!-- start change mat khau -->
                        <div class="active change-password">

                            <div class="heading">
                                <div class="title title_module"> <i class="ion-lock-combination"></i> Quên mật khẩu <span class="title-narrow"></span></div>
                            </div>
                            <div class="box-content">
                                <div class="col-md-12">
                                    <div class="pr_umenu-tk">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-2 icon-wrapper">
                                                    <div class="icon-radius">
                                                        <i class="ion-lock-combination"></i>
                                                    </div>
                                                </div>

                                                 <div class="col-md-8 content-wrapper"><a rel="nofollow" class="title" href="javascript:;">Quên mật khẩu</a>
                                                    <p>Chức năng lấy lại mật khẩu trong trường hợp bạn quên mật khẩu cũ</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end Bảo vệ và thay đổi tài khoản -->
                                </div>
                                <!-- Thay đổi số điện thoại-->
                            </div>
                            <div class="heading-box">
                                <div class="title">Quên mật khẩu</div>
                            </div>
                            <div class="box-content">
                                <div class="change-acountinfo-step">
                                    <ul class="countstep2">
                                        <li class="tab1 active" style=""><a ng-href="javascript:;" href="javascript:;"><span class="index">1</span><div class="step-name"><span class="">Nhập tên tài khoản</span></div></a></li>
                                        <li class="tab2" style=""><a ng-href="javascript:;" href="javascript:;"><span class="index">2</span><div class="step-name"><span class="">Nhập mã xác thực</span></div></a></li>
                                    </ul>
                                </div>
                                <div class="form-change-acountinfo">
                                   <form class="ng-pristine ng-scope ng-invalid ng-invalid-required" id="step1">
                                       {{ csrf_field() }}
                                       <div class="col-md-12 help-block">Vui lòng nhập đúng tên tài khoản. Mã xác thực sẽ được gửi đến điện thoại bạn nhập.<span></span></div>
                                        <div class="form-group">
                                            <label for="username" class="col-md-4">Nhập tên tài khoản <span class="red_star">(*) </span></label>
                                            <div class="col-md-5">
                                                <input id="username"  name="username" type="text" placeholder="Nhập tên tài khoản" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <p class="help-block col-md-8 col-md-offset-4"><span class="red_star">(*) </span>Thông tin bắt buộc. </p>
                                        </div>
                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="button" class="btn btn-primary sendCode" >Gửi mã xác thực</button><br>
                                        </div>
                                    </form>
                                    <form class="ng-pristine ng-scope ng-invalid ng-invalid-required" id="step2" style="display: none;" method="post" action="{{ route('frontend.user.get_new_pass') }}">
                                        {{ csrf_field() }}
                                        <div class="col-md-12 help-block">Vui lòng nhập mã xác nhận<span></span></div>
                                        <div class="form-group">
                                            <label for="token_code" class="col-md-4">Nhập mã xác nhận <span class="red_star">(*) </span></label>
                                            <div class="col-md-5">
                                                <input id="token_code"  name="token_code" type="text" placeholder="Nhập mã xác nhận" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <p class="help-block col-md-8 col-md-offset-4"><span class="red_star">(*) </span>Thông tin bắt buộc. </p>
                                        </div>
                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary confirmSubmit" >Lấy mật khẩu mới</button><br>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end Thay đổi số điện thoại  -->
                        </div>
                        <!-- end change mat khau -->
                    </div>
                </div>
                <!-- end information account-->
                </div>
            </div><!-- container -->
        </div>
    </ui-view>
@endsection