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
                                        <div class="title title_module"><i class="ion-ios-cart"></i> Nạp tiền <span
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
                                                            <p>Nạp tiền vào game bằng hình thức nạp thẻ và ATM.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end Bảo vệ và thay đổi tài khoản -->
                                    </div>
                                </div>
                                <div class="box-content">
                                    <div class="change-acountinfo-step">
                                        <ul class="countstep2">
                                            <li ng-class="{active: step1}" ng-click="step1 = true" class="active"
                                                style="">
                                                <a href="javascript:;"><span class="index">1</span>
                                                    <div class="step-name"><span class="">Nạp tiền bằng thẻ Cào</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="atm_step" style="">
                                                <a href="{{ route('frontend.user.payment_atm') }}"><span class="index">2</span>
                                                    <div class="step-name"><span class="">Nạp tiền bằng thẻ ATM</span>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <br>
                                    <p class="text-muted text-center"> Nap tiền bằng ATM được hưởng thêm 10% giá trị</p>
                                    <br>
                                    <div class="form-change-acountinfo">
                                        <table class="table">
                                            <thead>
                                            <tr>

                                                <th>10k</th>
                                                <th>20k</th>
                                                <th>50k</th>
                                                <th>100k</th>
                                                <th>200k</th>
                                                <th>500k</th>
                                                <th>1.000.000</th>
                                                <th>2.000.000</th>
                                                <th>5.000.000</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><strong>10</strong></td>
                                                <td><strong>20</strong></td>
                                                <td><strong>50</strong></td>
                                                <td><strong>100</strong></td>
                                                <td><strong>200</strong></td>
                                                <td><strong>500</strong></td>
                                                <td><strong>1.000</strong></td>
                                                <td><strong>2.000</strong></td>
                                                <td><strong>5.000</strong></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <!-- ngIf: step1 -->
                                        <form class="ng-pristine ng-scope ng-invalid ng-invalid-required" method="POST" action="{{ route('user.payment.card') }}" >
                                             {{ csrf_field() }}
                                            <div class="col-md-12 help-block">
                                            @if ($errors->any())
                                                <ul class="alert alert-danger">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="col-md-4">Chọn nhà mạng </label>
                                                <div class="col-md-5">
                                                    <select name="provider">
                                                      <option value="VNP" selected="selected">Vinaphone</option>
                                                      <option value="VMS">Mobifone</option>
                                                      <option value="VTT">Viettel</option>
                                                      <option value="MGC">MegaCard</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="card_seri" class="col-md-4">Nhập số seri <span class="red_star">(*) </span></label>
                                                <div class="col-md-5">
                                                    <input id="card_seri" name="card_seri" type="tel" placeholder="Nhập số serial" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="card_code" class="col-md-4">Nhập mã thẻ <span
                                                            class="red_star">(*) </span></label>
                                                <div class="col-md-5">
                                                    <input id="card_code" name="card_code" type="tel" placeholder="Nhập mã thẻ" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">Nạp thẻ </button>
                                                <br>
                                            </div>
                                        </form><!-- end ngIf: step1 -->
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