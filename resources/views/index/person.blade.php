
@extends('layouts.app')
@section('title', $user->name)
@section('css')
    <style>

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3 col-lg-3 hidden-xs hidden-md user-info">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="media">
                        <div class="center">
                            <img class="thumbnail img-responsive" src="{{ $user->url }}"
                                    width="300px" height="300px" style="margin-bottom: 0px">
                        </div>
                        <div class="media-body">
                            <hr>
                            <h3><strong style="align-content: center">{{ $user->name }}</strong></h3>
                            <hr>
                            <h4><strong>个人简介</strong></h4>
                            <p>{{ $user->desc }}</p>
                            <hr>
                            <h4><strong>年龄</strong></h4>
                            @if ($user->age !== -1)
                                <p>{{ $user->age }}</p>
                            @endif
                            <hr>
                            <h4><strong>性别</strong></h4>
                            @if ($user->sex === 1)
                                <p>男</p>
                            @elseif ($user->sex === 2)
                                <p>女</p>
                            @else
                                <p>保密</p>
                            @endif
                            <hr>
                            <h4><strong>WeChat</strong></h4>
                            <p>{{ $user->wechat }}</p>
                            <hr>
                            @if ($user->id === Auth::id())
                            <a href="{{ route('person.edit', Auth::id()) }}">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>编辑个人资料
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xs-12 col-md-9 col-lg-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <span>
                        <h1 class="panel-title pull-left">发布文章列表</h1>
                    </span>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <span>
                        <h1 class="panel-title pull-left">点赞文章列表</h1>
                    </span>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <span>
                        <h1 class="panel-title pull-left">翻译文章列表</h1>
                    </span>
                </div>
            </div>
        </div>
    </div>
@stop
