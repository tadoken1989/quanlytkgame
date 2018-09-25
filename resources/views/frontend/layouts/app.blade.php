<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSRF Token -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @meta
    <!-- Styles -->
       {!! Html::style('asset/css/style.css') !!}
       {!! Html::style('asset/css/app.css') !!}
       {!! Html::style('backend/sweetalert.css') !!}
       {!! Html::style('asset/css/custom.css') !!}
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,700italic,500italic,400italic&amp;subset=latin,vietnamese" rel="stylesheet" type="text/css">
    {{--Vue csrf--}}
    @tojs
    {{--end vue--}}
</head>
<body ng-class="{'has-slide': hasSlide}" class="unknown-device">
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=158912121134417";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<div class="page" id="mainContainer">
    @if(Session::has('success'))
        <div class="alert alert-success fade in flash_message">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>{{ Session::get('success') }}</strong>
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger fade in flash_message">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>{{ Session::get('error') }}</strong>
        </div>
    @endif
    @include('frontend.block.header')
    <ui-view class="ng-scope">
        @yield('content')
    </ui-view>
    @include('frontend.block.footer')
    @include('frontend.block.chat')
    @include('frontend.block.download')
</div>
<div class="loading"></div>
<!-- Scripts -->
{!! Html::script('asset/js/jquery.min.js') !!}
{!! Html::script('asset/js/main.js') !!}
{!! Html::script('backend/sweetalert.min.js') !!}
{!! Html::script('asset/js/custom.min.js') !!}
</body>
@yield('custom-js')
</html>
