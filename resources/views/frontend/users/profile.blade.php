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
                        <div ng-show="isSet('account-info')" role="tabpanel" ng-class="{active:isSet('account-info')}" class="active">
                            <div class="heading">
                                <div class="title title_module"> <i class="ion-ios-person-outline"></i> Thông tin tài khoản <span class="title-narrow"></span></div>
                            </div>
                            <div class="box-content">
                                @if(auth()->user())
                                <div class="col-md-12">
                                    <flash-message duration="5000" class="ng-isolate-scope"><!-- ngRepeat: flash in $root.flashes track by $index --></flash-message>
                                    <div class="userinfo-box">
                                        <form class="form-horizontal ng-pristine ng-invalid ng-invalid-required ng-valid-pattern ng-valid-date" ng-submit="update()" name="userInfo">
                                            <div class="form-group user-id-form">
                                                <label for="userId" class="col-sm-3 control-label">UserID :</label>
                                                <div class="col-sm-8">
                                                    <p class="form-control-static"> <b class="ng-binding">{{ auth()->user()->id }}</b></p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="col-sm-3 control-label">tên tài khoản</label>
                                                <div class="col-sm-8">
                                                    <input id="inputEmail" type="email" disabled="disabled" value="{{  preg_replace('/(?:^|@).\K|\.[^@]*$(*SKIP)(*F)|.(?=.*?\.)/', '*', auth()->user()->username) }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="col-sm-3 control-label">Email :</label>
                                                <div class="col-sm-8">
                                                    <input id="inputEmail" type="email" disabled="disabled" value="{{  preg_replace('/(?:^|@).\K|\.[^@]*$(*SKIP)(*F)|.(?=.*?\.)/', '*', auth()->user()->email) }}" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="phone" class="col-sm-3 control-label">Điện thoại :</label>
                                                <div class="col-sm-8">
                                                    <input id="phone" type="text" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-pattern" value="{{  substr(auth()->user()->phone_number, 0, 3) . '****' . substr(auth()->user()->phone_number,  -3) }}" ng-required="true" name="phone" required="required" disabled="">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="address" class="col-sm-3 control-label">Mật khẩu cấp 1</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="address" ng-model="data.address" value="**********" class="form-control ng-pristine ng-untouched ng-valid ng-empty" disabled="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="address" class="col-sm-3 control-label">Mật khẩu cấp 2</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="address" value="************" ng-model="data.address" class="form-control ng-pristine ng-untouched ng-valid ng-empty">
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end information account-->
                </div>
            </div><!-- container -->
        </div>
    </div></ui-view>
@endsection