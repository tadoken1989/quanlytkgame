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
                                        <div class="title title_module"><i class="fa fa-commenting"></i> Gửi yêu cầu hỗ
                                            trợ<span class="title-narrow"></span></div>
                                    </div>
                                    <div class="box-content">
                                        @if ($errors->any())
                                            <ul class="alert alert-danger">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        <div class="col-md-12">
                                            <form class="form-support" method="post" action="{{ route('frontend.feedback.submit') }}"><br>
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label for="type" class="col-sm-3 control-label">Bộ phận hỗ trợ <span
                                                                class="red_star"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <select name="type" id="type" required=""
                                                                class="ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required">
                                                            <option value="NULL">---Lựa chọn---</option>
                                                            @foreach(getFeedBackType() as $type)
                                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">

                                                    <label for="bug_type" class="col-sm-3 control-label">Chủ đề trợ giúp
                                                        <span class="red_star"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <select name="bug_type" id="bug_type" required="" class="ng-pristine ng-empty ng-invalid ng-invalid-required ng-touched" style="">
                                                            <option value="">---Lựa chọn---</option>
                                                            @foreach(getBugType() as $bugType)
                                                            <option value="{{ $bugType->id }}" class="ng-binding ng-scope" style="">{{ $bugType->name }}
                                                            </option>
                                                            @endforeach
                                                            <!-- interpolation -->
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-3 control-label">Tên nhân vật<span
                                                                class="red_star"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input id="name" name="name" type="text" placeholder="Tên nhân vật" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tk" class="col-sm-3 control-label">Tên tài khoản<span
                                                                class="red_star"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input id="username" name="username" type="text" placeholder="Nhập tên tài khoản" class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="title" class="col-sm-3 control-label">Tiêu đề yêu cầu
                                                        <span class="red_star"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <input id="title" type="text" name="title"
                                                               placeholder="Nhập tiêu đề"
                                                               class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required"
                                                               required="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="content" class="col-sm-3 control-label">Nội dung <span
                                                                class="red_star"> *</span></label>
                                                    <div class="col-sm-8">
                                                        <textarea id="content" name="content" type="text" rows="6"
                                                                  cols="50"
                                                                  class="form-control ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required"
                                                                  required=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-8">
                                                        <button type="submit" ng-click="create(ticket)"
                                                                class="btn btn-primary">Gửi phản hồi
                                                        </button>
                                                        <button type="reset"
                                                                class="btn btn-primary">Làm mới
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <br>

                                            <div class="notice">
                                                <a>Lưu ý</a>
                                                <ul>
                                                    <li><p><strong>Bộ phận Hỗ trợ kỹ thuật Game</strong>: Là bộ phân
                                                            chuyên phụ trách xử lí các vấn đề lỗi tài khoản; nhân vật và
                                                            các vấn đề ingame (Mất đồ; lỗi không đăng nhập được; lỗi
                                                            hoạt động .v.v..)</p></li>
                                                    <li><p><strong>Bộ phận Hỗ trợ tài khoản - Tiền tệ</strong>: Là bộ
                                                            phân chuyên phụ trách xử lí các vấn đề về thông tin tài
                                                            khoản; thẻ nạp; thẻ ATM khi có vấn đề lỗi xảy ra.</p></li>
                                                    <li><p>Thời gian trả lời phản hồi: <strong>Từ 8h00 sáng tới 24h00
                                                                đêm</strong>.</p></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
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
    </ui-view>
@endsection

@section('custom-js')
    <script>
        $(document).ready(function () {
            $('#feedback-menu').addClass('active');
            $('li#send_feedback').addClass('active-sub');
        });
    </script>
@endsection