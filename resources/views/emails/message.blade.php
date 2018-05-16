<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="text-center">
            <h2>{{ $message->title }}</h2>
        </div>
        <div class="row">
            {{ $message->content }}
            <a href="{{ $message->href }}"><button class="btn-primary btm-lg">查看详情</button></a>
        </div>
    </div>
</body>
</html>