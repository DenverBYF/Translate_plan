@extends('layouts.app')

@section('title', '文章编辑')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endsection
@section('content')
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="text-center">
                        <i class="glyphicon glyphicon-edit"></i>
                        @if (empty($article))
                            新建文章
                        @else
                            编辑文章
                        @endif
                    </h2>
                    <hr>
                    @include('layouts._error')
                    @if (empty($article))
                        <form class="form-horizontal" role="form"
                                action="{{ route('article.store') }}" method="post" accept-charset="utf-8">
                    @else
                        <form class="form-horizontal" role="form"
                                action="{{ route('article.update', ['id' => $article->id]) }}" method="post" accept-charset="utf-8">
                            <input type="hidden" name="_method" value="PUT">
                    @endif
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input class="form-control" type="text" name="title" id="title"
                                        value="{{ old('title', $article->title??'') }}" placeholder="文章标题">
                            </div>

                            <div class="form-group">
                                <select class="form-control" id="t_id" name="t_id">
                                    <option value="" hidden disabled selected>请选择文章分类</option>
                                    @foreach($type as $each)
                                        <option value="{{ $each->id }}">{{ $each->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="divide" name="divide">
                                    <option value="" hidden disabled selected>请选择分割长度</option>
                                    <option value="300">300</option>
                                    <option value="500">500</option>
                                    <option value="800">800</option>
                                    <option value="1000">1000</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea id="content" name="content"
                                        class="form-control" cols="50">{{ old('content', $article->content??"") }}</textarea>
                            </div>
                            <div class="well well-sm">
                                <button type="submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 保存</button>
                            </div>
                        </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

    <script>
        var simplemde = new SimpleMDE({ element: document.getElementById('content') });
    </script>
@endsection

