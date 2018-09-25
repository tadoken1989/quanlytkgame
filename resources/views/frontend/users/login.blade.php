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
                                <div class="title title_module"> <i class="ion-ios-person-outline"></i> Đăng ký tài khoản <span class="title-narrow"></span></div>
                            </div>
                            <div class="box-content">
                                <div class="col-md-12">
                                    <div class="pr_umenu-tk">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-2 icon-wrapper">
                                                    <div class="icon-radius">
                                                        <i class="ion-ios-toggle"></i>
                                                    </div>
                                                </div>

                                                 <div class="col-md-8 content-wrapper"><a rel="nofollow" ng-href="{{ route('frontend.user.login') }}" class="title" href="{{ route('frontend.user.login') }}">Đăng nhập tài khoản</a>
                                                    <p>Đăng nhập tài khoản để sử dụng các dịch vụ của quản lý tài khoản.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end Bảo vệ và thay đổi tài khoản -->
                                </div>
                                <!-- Thay đổi số điện thoại-->
                            </div>
                            <div class="box-content">
                                <div class="form-change-acountinfo">
                                    <!-- ngIf: step1 -->
                                    <form class="ng-pristine ng-scope ng-invalid ng-invalid-required" method="post" action="{{ route('frontend.user.submitLogin') }}" style="">
                                    {{ csrf_field() }}
                                    <div class="col-md-12 help-block">
                                        @if ($errors->any())
                                            <ul class="alert alert-danger">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        Vui lòng nhập đủ trường thông tin tài khoản.<span></span>
                                    </div>
                                        <div class="form-group">
                                            <label for="username" class="col-md-4">Nhập tên tài khoản <span class="red_star">(*) </span></label>
                                            <div class="col-md-5">
                                                <input id="username" name="username" type="tel" placeholder="Nhập tên tài khoản" ng-model="phone.phone_number" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" required="">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="password" class="col-md-4">Nhập mật khẩu cấp 1 <span class="red_star">(*) </span></label>
                                            <div class="col-md-5">
                                                <input id="password" name="password" type="password" ng-model="phone.phone_number" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">Đăng nhập</button><br>
                                        </div>
                                          <div class="col-md-8 check_mk_pass">
                                            <a href="{{ route('frontend.user.forgot') }}"><i class="ion-ios-checkmark-outline"></i>lấy lại mật khẩu đăng nhập.</a><br>
                                        </div>
                                    </form><!-- end ngIf: step1 -->
                                    <!-- ngIf: !step1 -->
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