
@extends('layouts.app')
@section('title', $user->name)
@section('css')
    <style>
        .topic-list > .nav > li > a {
            position: relative;
            display: block;
            padding: 5px 14px;
            font-size: 0.9em;
        }
        .a {
            color: #444444;
        }
        .topic-list>hr {
            margin-top: 12px;
            margin-bottom: 12px;
            border: 0;
            border-top: 1px solid #dcebf5;
        }
        .topic-list>.badge {
            background-color: #d8d8d8;
        }
        .topic-list>.meta {
            font-size:0.9em;
            color: #b3b3b3;
        }
        #title {
            color: #444444;
        }
        .meta>a {
            color: #b3b3b3;
        }
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
                <div class="panel-heading">
                    <li role="presentation"><a href="#">发布文章列表</a></li>
                </div>
                <div class="panel-body">
                    @include('article.list', ['article' => $articlePush])
                    {!! $articlePush->render() !!}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <li role="presentation"><a href="#">翻译文章列表</a></li>
                </div>
                <div class="panel-body">
                    @include('article.list', ['article' => $articleTranslate])
                    {!! $articleTranslate->render() !!}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <li role="presentation"><a href="#">点赞文章列表</a></li>
                </div>
                <div class="panel-body">
                    @include('article.list', ['article' => $articleLike])
                </div>
            </div>
            @if(\Illuminate\Support\Facades\Auth::id() === $user->id)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <li role="presentation"><a href="#">待审核翻译</a></li>
                </div>
                <div class="panel-body">
                    @include('translate.list', ['article' => $articleAccept])
                    {!! $articlePush->render() !!}
                </div>
            </div>
            @endif
        </div>
    </div>
@stop
