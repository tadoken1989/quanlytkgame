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
                                            <li>
                                                <a href="{{ route('frontend.user.payment') }}"><span class="index">1</span>
                                                    <div class="step-name"><span class="">Nạp tiền bằng thẻ Cào</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="atm_step active" style="">
                                                <a href="javascript:;"><span class="index">2</span>
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
                                                <td><strong>11</strong></td>
                                                <td><strong>22</strong></td>
                                                <td><strong>55</strong></td>
                                                <td><strong>110</strong></td>
                                                <td><strong>220</strong></td>
                                                <td><strong>550</strong></td>
                                                <td><strong>1.100</strong></td>
                                                <td><strong>2.200</strong></td>
                                                <td><strong>5.500</strong></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <!-- ngIf: step1 -->
                                        <form class="ng-pristine ng-scope ng-invalid ng-invalid-required" method="POST" action="{{ route('user.payment.atm') }}" >
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
                                                <label for="bankID" class="col-md-4">Chọn ngân hàng </label>
                                                <div class="col-md-5">
                                                    <select name="bankID">
                                                        <option value="99001">Ngân hàng Agribank</option>
                                                        <option value="99002">Ngân hàng Saigonbank</option>
                                                        <option value="99003">Ngân hàng PG Bank</option>
                                                        <option value="99004">Ngân hàng GP Bank</option>
                                                        <option value="99005">Ngân hàng Sacombank</option>
                                                        <option value="99006">Ngân hàng Nam Á</option>
                                                        <option value="99007">Ngân hàng Đông Á</option>
                                                        <option value="99008">Ngân hàng Vietinbank</option>
                                                        <option value="99009">Ngân hàng Techcombank</option>
                                                        <option value="99010">Ngân hàng VIB</option>
                                                        <option value="99011">Ngân hàng HDBank</option>
                                                        <option value="99012">Ngân hàng Eximbank</option>
                                                        <option value="99013">Ngân hàng TienphongBank</option>
                                                        <option value="99014">Ngân hàng Maritime Bank</option>
                                                        <option value="99015">Ngân hàng BIDV</option>
                                                        <option value="99016">Ngân hàng MB</option>
                                                        <option value="99017">Ngân hàng Seabank</option>
                                                        <option value="99018">Ngân hàng SHB</option>
                                                        <option value="99019">Ngân hàng Việt Á Bank</option>
                                                        <option value="99020">Ngân hàng OceanBank</option>
                                                        <option value="99021" selected>Ngân hàng Vietcombank</option>
                                                        <option value="99022">Ngân hàng VP Bank </option>
                                                        <option value="99023">Ngân hàng ACB</option>
                                                        <option value="99026">Ngân hàng NaviBank</option>
                                                        <option value="99027">Ngân hàng Bắc á</option>
                                                        <option value="99029">Ngân hàng AnBinhBank</option>
                                                        <option value="99030">Ngân hàng Dai a bank</option>
                                                        <option value="99031">Ngân hàng Visa - Master</option>
                                                        <option value="99032">Ngân hàng PVcombank</option>
                                                        <option value="99033">Ngân hàng Liên Việt posbank</option>
                                                        <option value="99034">Ngân hàng Bảo Việt Bank</option>
                                                        <option value="99035">Ngân hàng Ngân hàng Phương Đông Việt Nam (OCB)</option>
                                                        <option value="99036">Ngân hàng Kiên Long Bank</option>
                                                        <option value="99037">Ngân hàng Ngân hàng Quốc dân (NCB)</option>
                                                        <option value="99038">Ngân hàng Ngân hàng liên doanh Việt Nga (VRB)</option>
                                                        <option value="99039">Ngân hàng NH TNHH MTV Public Vietnam</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="txnAmount" class="col-md-4">Mệnh giá nạp </label>
                                                <div class="col-md-5">
                                                    <select name="txnAmount">
                                                        <option value="20000" selected>20.000 VND</option>
                                                        <option value="50000">50.000 VND</option>
                                                        <option value="100000">100.000 VND</option>
                                                        <option value="200000">200.000 VND</option>
                                                        <option value="500000">500.000 VND</option>
                                                        <option value="1000000">1.000.000 VND</option>
                                                        <option value="2000000">2.000.000 VND</option>
                                                        <option value="5000000">5.000.000 VND</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="userCardName" class="col-md-4">Họ và Tên <span class="red_star">(*) </span></label>
                                                <div class="col-md-5">
                                                    <input id="userCardName" name="userCardName" type="text" placeholder="Họ và Tên ATM" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">Nạp ngay </button>
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