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
                                                        <i class="ion-ios-contact-outline"></i>
                                                    </div>
                                                </div>

                                                 <div class="col-md-8 content-wrapper"><a rel="nofollow" ng-href="https://id.appota.com/profile" class="title" href="https://id.appota.com/profile">Đăng ký tài khoản</a>
                                                    <p>Người dùng vui lòng lưu lại thông tin khi đăng ký tài khoản.</p>
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
                                  <form class="ng-pristine" method="post" action="{{ route('frontend.user.register.submit') }}">
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
                                                <input id="username" name="username" type="text"  placeholder="Nhập tên tài khoản" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" required="">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="password" class="col-md-4">Nhập mật khẩu cấp 1 <span class="red_star">(*) </span></label>
                                            <div class="col-md-5">
                                                <input id="password" name="password" type="password" ng-model="phone.phone_number" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" required="">
                                            </div>
                                        </div>
                                      <div class="form-group">
                                          <label for="re_password" class="col-md-4">Nhập lại mật khẩu cấp 1 <span class="red_star">(*) </span></label>
                                          <div class="col-md-5">
                                              <input id="re_password" name="re_password" type="password" ng-model="phone.phone_number" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" required="">
                                          </div>
                                      </div>
                                         <div class="form-group">
                                            <label for="password_2" class="col-md-4">Nhập mật khẩu cấp 2<span class="red_star">(*) </span></label>
                                            <div class="col-md-5">
                                                <input id="password_2" name="password_2" type="password" ng-model="phone.phone_number" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="email" class="col-md-4">Email đăng ký </label>
                                            <div class="col-md-5">
                                                <input id="email" name="email" type="email" placeholder="Email đăng ký . ví dụ : abc@gmail.com" ng-model="phone.phone_number" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="phone_number" class="col-md-4">Số điện thoại </label>
                                            <div class="col-md-5">
                                                <input id="phone_number" name="phone_number" type="number" placeholder="Số điện thoại đăng ký" ng-model="phone.phone_number" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <p class="help-block col-md-8 col-md-offset-4"><span class="red_star">(*) </span>Thông tin bắt buộc. </p>
                                        </div>
                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">Đăng ký</button><br>
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