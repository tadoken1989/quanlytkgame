@extends('frontend.layouts.app')
@section('content')
    <ui-view class="ng-scope">
        <div class="content-wrapper ng-scope">
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
                                        <div class="title title_module"><i class="ion-ios-cart"></i> Lịch sử nạp thẻ của tài khoản <span
                                                    class="title-narrow"></span></div>
                                    </div>
                                    <div class="box-content">
                                        <div class="col-md-12">
                                            <div class="pr_umenu-tk">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-2 icon-wrapper">
                                                            <div class="icon-radius">
                                                                <i class="ion-ios-cart"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8 content-wrapper"><a rel="nofollow" ng-href="javascript:;" class="title" href="javascript:;">Nạp tiền</a>
                                                            <p>Lịch sử nạp thẻ của tài khoản</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end Bảo vệ và thay đổi tài khoản -->
                                    </div>
                                </div>
                                <div class="box-content">
                                    <div class="form-change-acountinfo">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Loại</th>
                                                <th>Mã thẻ</th>
                                                <th>Số serial</th>
                                                <th>Mệnh giá</th>
                                                <th>Ngày nạp</th>
                                                <th>Mã giao dịch</th>
                                            </tr>
                                            </thead>
                                            @if($history)
                                            <tbody>
                                            @foreach($history as $item)
                                            <tr>
                                                <td><strong>{{ $item->type }}</strong></td>
                                                <td><strong>{{ $item->card_code }}</strong></td>
                                                <td><strong>{{ $item->card_serial }}</strong></td>
                                                <td><strong>{{ number_format($item->card_price) }}</strong></td>
                                                <td><strong>{{ $item->created_at }}</strong></td>
                                                <td><strong>{{ $item->trans_id }}</strong></td>
                                            </tr>
                                            </tbody>
                                            @endforeach
                                            @endif
                                        </table>
                                        <!-- ngIf: step1 -->
                                        <!-- ngIf: !step1 -->
                                    </div>
                                </div>
                                <!-- end Payment  -->
                            </div>
                            <!-- end cPayment -->
                        </div>
                    </div>
                    <!-- end information account-->
                </div>
            </div><!-- container -->
        </div>
    </ui-view>
@endsection