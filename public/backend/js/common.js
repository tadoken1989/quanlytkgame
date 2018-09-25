/**
 * Created by ANH on 7/25/2017.
 */


var App = {
    initFlashMessage: function () {
        $("div.flash_message").not(".flash_important").delay(3000).slideUp();
    },
    initDatetime: function () {
        $('.birthday').datepicker({
            format: 'DD-MM-YYYY',
            maxDate: new Date()
        });
    },
    loadAvatar: function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.image_review_avatar')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    },
    deleteModel: function () {
        $('#data-table').on('click', '.btn-active', function () {
            var $_this = $(this);
            swal({
                    title: "Bạn có chắc chắn ?",
                    text: "Bạn có chắc chắn rằng mình muốn thực hiện thao tác này.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Vâng, thực hiện ngay!",
                    cancelButtonText: "Không, huỷ !",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        if ($_this.data('id')) {
                            $.ajaxSetup({headers: {'X-CSRF-Token': $('input[name="_token"]').val()}});
                            $.ajax({
                                method: "post",
                                url: '/admin/_ajax/_model/active',
                                data: {'id': $_this.data('id'), 'model': $_this.data('model')},
                                beforeSend: function () {
                                    swal.close();
                                    $('.loading').show();
                                },
                                success: function (res) {
                                    $('.loading').fadeOut();
                                    if (res.status == 200) {
                                        swal("Thành công", "Thao tác bạn vừa thực hiện thành công", "success");
                                        var $span = $('span#status-' + $_this.data("id"));
                                        if (res.data.status == 0) {
                                            $span.html('<i class="fa fa-clock-o"></i> hidden');
                                            $span.addClass('label-waring');
                                            $_this.html('<i class="fa fa-check-square-o"></i> Active');
                                        } else {
                                            $span.removeClass('label-waring');
                                            $span.html('<i class="fa fa-check"></i> active');
                                            $_this.html('<i class="fa fa-trash"></i> Delete');
                                        }
                                    } else {
                                        swal("Thất bại", "Hệ thống xảy ra lỗi,vui lòng liên hệ admin", "error");
                                    }
                                },
                                error: function () {
                                    $('.loading').fadeOut();
                                    swal("Thất bại", "Hệ thống xảy ra lỗi,vui lòng liên hệ admin", "error");

                                }
                            });
                        }
                    } else {
                        swal.close();
                    }
                });
        })
    },
    loadLocation: function () {
        $('.location-input').tagsinput({
            itemValue: 'name',
            itemText: 'name',
            typeahead: {
                source: function (query) {
                    return $.get('/admin/_ajax/_location&q=' + query);
                }
            }
        });
    },
    multiSelect: function () {
        $('.multiselect-ui').multiselect({
            includeSelectAllOption: true
        });
    },
    /* CHART - MORRIS  */

    init_morris_charts: function () {
        if (typeof (Morris) === 'undefined') {
            return;
        }
        if ($('#user_online').length) {
            var chartUserOnline = Morris.Area({
                element: 'user_online',
                xkey: 'time',
                ykeys: ['count'],
                labels: ['Số người online'],
                xLabels: 'auto',
                hideHover: 'auto',
                lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                data: [],
                axes: true,
                xLabelMargin: 10,
                parseTime: false,
                lineWidth: 2,
                resize: true
            });
            $.ajax({
                type: "GET",
                url: "/admin/_ajax/_char/user/online"
            })
                .done(function (data) {
                    chartUserOnline.setData(data);
                })
                .fail(function () {

                });
        }
        if ($('#user_register').length) {
            var chartUserRegister = Morris.Area({
                element: 'user_register',
                xkey: 'date',
                ykeys: ['count'],
                labels: ['Số người đăng kí'],
                xLabels: 'auto',
                hideHover: 'auto',
                lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                data: [],
                axes: true,
                xLabelMargin: 10,
                parseTime: false,
                lineWidth: 2,
                resize: true
            });
            $.ajax({
                type: "GET",
                url: "/admin/_ajax/_char/user/active"
            })
                .done(function (data) {
                    chartUserRegister.setData(data);
                })
                .fail(function () {
                });
        }
    },
    loadUserOnline: function () {
        $.ajax({
            method: "get",
            url: '/admin/_ajax/user/online',
            beforeSend: function () {
                $('.loading').show();
            },
            success: function (res) {
                $('.loading').fadeOut();
                $('#show_max_user_online').text(res);
            },
            error: function () {
                $('.loading').fadeOut();
            }
        });
    }
}

$(document).ready(function () {
    App.multiSelect();
    App.deleteModel();
    App.initFlashMessage();
    App.initDatetime();
    // App.loadLocation();
    App.init_morris_charts();
    // App.loadUserOnline();
});

