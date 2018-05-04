
@extends('layouts.app')
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
    <div class="container">
        <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <li role="presentation">文章列表</li>
                </div>
                <div class="panel-body">
                    @include('article.list', ['article' => $article])
                    {!! $article->render() !!}
                </div>
            </div>
        </div>
    </div>
@stop
