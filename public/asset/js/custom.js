/**
 * Created by ANH on 7/31/2017.
 */
var App = {
    initFlash: function () {
        $("div.flash_message").not(".flash_important").delay(5000).slideUp();
    },
    sendCode: function () {
        $('.box-content').on('click', '.sendCode', function () {
            var username = $('input[name="username"]').val();
            if (username.length > 0 && username != '') {
                $.ajaxSetup({headers: {'X-CSRF-Token': $('input[name="_token"]').val()}});
                $.ajax({
                    method: "post",
                    url: '/user/forgot/check-phone',
                    data: {'username': username},
                    beforeSend: function () {
                        $('.loading').show();
                    },
                    success: function (res) {
                        $('.loading').fadeOut();
                        if (res.status == 200) {
                            $('li.tab1').removeClass('active');
                            $('li.tab1').addClass('active');
                            $('form#step1').fadeOut();
                            $('form#step2').fadeIn();
                            return false;
                        }
                        else {
                            swal("Cảnh báo", "Tài khoản không tồn tại trong hệ thống", "error");
                            return false;
                        }
                    },
                    error: function () {
                        $('.loading').fadeOut();
                    }
                });
            }
            else {
                swal("Cảnh báo", "Bạn vui lòng nhập tên tài khoản", "error");
                return false;
            }
        });
    }
}
$(document).ready(function () {
    App.initFlash();
    App.sendCode();
});