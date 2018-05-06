@extends('layouts.app')


@section('css')
    <style>
        .topic-body {
            font-size: 15px;
            line-height: 1.3;
            overflow: hidden;
            line-height: 1.6;
            word-wrap: break-word;
        }
        a {
            background: transparent;
        }
        a:active,
        a:hover {
            outline: 0;
        }
        ol li {
            margin: 8px 0;
        }
        pre[class*=language-] {
            margin: 1.2em 0!important;
        }
        strong {
            font-weight: bold;
        }
        h1 {
            font-size: 2em;
            margin: 0.67em 0;
        }
        img {
            border: 0;
        }
        hr {
            -moz-box-sizing: content-box;
            box-sizing: content-box;
            height: 0;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
        td,
        th {
            padding: 0;
        }
        * {
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        a {
            text-decoration: none;
        }
        a:hover,
        a:focus,
        a:active {
            text-decoration: none;
        }
        hr {
            height: 0;
            margin: 15px 0;
            overflow: hidden;
            background: transparent;
            border: 0;
            border-bottom: 1px solid #ddd;
        }
        hr:before,
        hr:after {
            display: table;
            content: " ";
        }
        hr:after {
            clear: both;
        }
        blockquote {
            margin: 0;
        }
        ul,
        ol {
            padding: 0;
            margin-top: 0;
            margin-bottom: 0;
        }
        ol ol {
            list-style-type: lower-roman;
        }
        dd {
            margin-left: 0;
        }
        code,
        pre {
            font-family: monaco, Consolas, "Liberation Mono", Menlo, Courier, monospace;
            font-size: 1em;
        }
        pre {
            margin-top: 0;
            margin-bottom: 0;
            overflow: auto;
        }
        .topic-body>*:first-child {
            margin-top: 0 !important;
        }
        .topic-body>*:last-child {
            margin-bottom: 0 !important;
        }
        .anchor {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            display: block;
            padding-right: 6px;
            padding-left: 30px;
            margin-left: -30px;
        }
        .anchor:focus {
            outline: none;
        }
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            position: relative;
            margin-top: 1.0em;
            margin-bottom: 16px;
            line-height: 1.4;
        }
        h1 {
            padding-bottom: 0.3em;
            font-size: 2.25em;
            line-height: 1.2;
            border-bottom: 1px solid #eee;
        }
        h2 {
            padding-bottom: 0.3em;
            font-size: 1.3em;
            line-height: 1.225;
            border-bottom: 1px solid #eee;
        }
        h3 {
            font-size: 1.2em;
            line-height: 1.43;
        }
        h4 {
            font-size: 1.1em;
        }
        h5 {
            font-size: 1.0em;
        }
        h6 {
            font-size: 0.9em;
            color: #777;
        }
        p,
        blockquote,
        ul,
        ol,
        dl,
        table,
        pre {
            margin-top: 0;
            margin-bottom: 0px;
            line-height: 30px;
        }
        hr {
            border: 2px dashed #F0F4F6;
            border-bottom: 0px;
            margin: 18px auto;
            width: 50%;
        }
        ul,
        ol {
            padding-left: 2em;
            padding: 10px 20px 10px 30px;
            color: #7d8688;
        }
        ol ol,
        ol ul {
            margin-top: 0;
            margin-bottom: 0;
        }
        li>p {
            margin-top: 6px;
        }
        dl {
            padding: 0;
        }
        dl dt {
            padding: 0;
            margin-top: 6px;
            font-size: 1em;
            font-style: italic;
            font-weight: bold;
        }
        dl dd {
            padding: 0 16px;
            margin-bottom: 16px;
        }
        blockquote {
            font-size: inherit;
            padding: 0 15px;
            color: #777;
            border-left: 4px solid #ddd;
        }
        blockquote>:first-child {
            margin-top: 20px;
        }
        blockquote>:last-child {
            margin-bottom: 20px;
        }
        blockquote {
            margin: 20px 0!important;
            background-color: #f5f8fc;
            padding: 1rem;
            color: #8796A8;
            border-left: none;
        }
        table {
            display: block;
            width: 100%;
            overflow: auto;
            margin: 25px 0;
        }
        table th {
            font-weight: bold;
        }
        table th,
        table td {
            padding: 6px 13px;
            border: 1px solid #ddd;
        }
        table tr {
            background-color: #fff;
            border-top: 1px solid #ccc;
        }
        table tr:nth-child(2n) {
            background-color: #f8f8f8;
        }
        topic-body>img {
            max-width: 100%;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        topic-body>img {
            border: 1px solid #ddd;
            box-shadow: 0 0 30px #ccc;
            -moz-box-shadow: 0 0 30px #ccc;
            -webkit-box-shadow: 0 0 30px #ccc;
            margin-bottom: 30px;
            margin-top: 10px;
        }
        code {
            background: rgba(90, 87, 87, 0);
            margin: 5px;
            color: #858080;
            border-radius: 4px;
            background-color: #f9fafa;
            border: 1px solid #e4e4e4;
            max-width: 740px;
            overflow-x: auto;
            font-size: .9em;
            padding: 1px 2px 1px;
        }
        code:before,
        code:after {
            letter-spacing: -0.2em;
            content: "\00a0";
        }
        pre>code {
            padding: 0;
            margin: 0;
            font-size: 100%;
            white-space: pre;
            background: transparent;
            border: 0;
        }
        .highlight {
            margin-bottom: 16px;
        }
        .highlight pre,
        pre {
            padding: 14px;
            overflow: auto;
            line-height: 1.45;
        // background-color: #4e4e4e;
            border-radius: 3px;
            color: inherit;
            border: none;
        }
        .highlight pre {
            margin-bottom: 0;
        }
        pre {
            word-wrap: normal;
        }
        pre code {
            display: block;
            padding: 0;
            margin: 0;
            overflow: initial;
            line-height: inherit;
            word-wrap: normal;
            background-color: transparent;
            border: 0;
        }
        pre code:before,
        pre code:after {
            content: normal;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 topic-content">
            @include('layouts._message')
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="article-meta text-center">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        发布者: <a href="{{ route('users', ['id' => $article->user->id]) }}">{{ $article->user->name }}</a>
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                        发布时间: {{ $article->created_at }}
                    </div>
                    <h1 class="text-center">
                        <strong>{{ $article->title }}</strong>
                    </h1>
                    @foreach($part as $eachPart)
                    <div class="topic-body col-md-9 col-lg-9 col-sm-9 col-xs-9" id="{{ $eachPart->id }}">
                        {!! Parsedown::instance()->setMarkupEscaped(true)->text($eachPart->content) !!}
                    </div>
                    <div class="col-md-2 col-lg-2 col-md-offset-1 panel panel-default" >
                        <div class="panel-body">
                            <a href="{{ route('translate.edit', ['id' => $eachPart->id]) }}">
                                <button class="text-center btn btn-danger" id="{{ $eachPart->id }}">我来翻译</button>
                            </a>
                        </div>
                    </div>
                    <hr class="col-md-12 col-lg-12 ">
                    @endforeach

                    <div class="operate">
                        <hr>
                        @if (Auth::id() === $article->u_id)
                        <a href="{{ route('article.edit', $article->id) }}" class="btn btn-default btn-xs" role="button">
                            <i class="glyphicon glyphicon-edit"></i> 编辑
                        </a>
                        <a href="#" class="btn btn-default btn-xs" role="button">
                            <i class="glyphicon glyphicon-trash"></i> 删除
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection