@extends('frontend.layouts.app')
@section('content')
    <ui-view class="ng-scope"><div class="content-wrapper ng-scope">
        <div class="user_profile">
            <div class="container">
            <div class="">
                 @include('frontend.block.sidebar')
                <!-- information account-->
                <div class="content-main col-md-9">
                    <div class="grid-category green user_profile_main">
                         <!-- start change mat khau -->
                        <div class="active change-password">

                            <div class="heading">
                                <div class="title title_module"> <i class="ion-ios-locked"></i> Thay đổi mật khẩu cấp 2 <span class="title-narrow"></span></div>
                            </div>
                            <div class="box-content">
                                <div class="col-md-12">
                                    <div class="pr_umenu-tk">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-2 icon-wrapper">
                                                    <div class="icon-radius">
                                                        <i class="ion-ios-locked"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 content-wrapper"><a rel="nofollow" ng-href="https://id.appota.com/profile" class="title" href="https://id.appota.com/profile">Thay đổi mật khẩu</a>
                                                    <p>Để bảo vệ mật khẩu bạn nên thay đổi mật khẩu thường xuyên</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end Bảo vệ và thay đổi tài khoản -->
                                </div>

                            </div>

                            <div class="box-content">
                                 @if ($errors->any())
                                     <ul class="alert alert-danger">
                                         @foreach ($errors->all() as $error)
                                             <li>{{ $error }}</li>
                                         @endforeach
                                     </ul>
                                 @endif
                                <div class="form-change-acountinfo">
                                   <form class="ng-pristine ng-scope ng-invalid ng-invalid-required" method="post" action="{{ route('frontend.user.change-pass-2.submit') }}">
                                     {{ csrf_field() }}

                                    <div class="form-group">
                                            <label for="password" class="col-md-4">Nhập mật khẩu cấp 2 cũ <span class="red_star">(*) </span></label>
                                            <div class="col-md-5">
                                                <input id="password_2" name="password_2" type="password" placeholder="Nhập mật khẩu cấp 2 cũ" ng-model="phone.phone_number" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_new" class="col-md-4">Nhập mật khẩu cấp 2 mới <span class="red_star">(*) </span></label>
                                            <div class="col-md-5">
                                                <input id="password_2_new" name="password_2_new" type="password" placeholder="Nhập mật khẩu cấp 2 mới" ng-model="phone.phone_number" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" required="">
                                            </div>
                                        </div>

                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary" ng-click="sendVerifyCode()">Thay đổi</button><br>
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
@section('custom-js')
    <script>
        $(document).ready(function(){
            $('#change-info-menu').addClass('active');
            $('li#li-change-pass-2').addClass('active-sub');
        });
    </script>
@endsection