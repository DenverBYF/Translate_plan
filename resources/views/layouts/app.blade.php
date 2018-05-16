<html  lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') 协同翻译平台</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <style>
        body {
            font-family: Hiragino Sans GB, "Hiragino Sans GB", Helvetica, "Microsoft YaHei", Arial,sans-serif;
        }

        .navbar-static-top {
            border-color: #e7e7e7;
            background-color: #fff;
            box-shadow: 0px 1px 11px 2px rgba(42, 42, 42, 0.1);
            border-top: 4px solid #00b5ad;
            margin-bottom: 40px;
            margin-top: 0px;
        }

        html {
            position: relative;
            min-height: 100% ;
        }
        body {
            /* Margin bottom by footer height */
            margin-bottom: 60px;
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100% ;
            /* Set the fixed height of the footer here */
            height: 60px;
            background-color: #adb5bd;
        }
        .footer-container{
            padding-right: 15px;
            padding-left: 15px;
        }
        .footer-pull-left {
            margin: 19px 50px;
            color: #1b1e21;
        }
    </style>
    @yield('css')
</head>

<body>
    <div id="app" class="{{ route_class() }}-page">
        @include('layouts._header')
        <div class="container">
            @include('layouts._message')
            @yield('content')
        </div>
        @include('layouts._footer')
    </div>
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('js')
</body>
</html>