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
                            文章翻译
                    </h2>
                    <hr>
                    @include('layouts._error')
                        <form class="form-horizontal" role="form"
                                action="{{ route('translate.store') }}" method="post" accept-charset="utf-8">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ old('pid', $article->id) }}" name="pid" id="pid">
                            <input type="hidden" value="{{ old('aid', $article->article->id) }}" name="aid" id="aid">
                            <div class="form-group">
                                <input class="form-control" type="text" name="title" id="title"
                                        value="{{ old('title', $article->article->title) }}" placeholder="文章标题" readonly="readonly">
                            </div>
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <label for="content">原文</label>
                                <textarea id="content" name="content"
                                    class="form-control" cols="50" readonly>{{ old('content', $article->content) }}</textarea>
                            </div>
                            <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <label for="translate">译文</label>
                                <textarea id="translate" name="translate"
                                        class="form-control" cols="50" cols="25">{{ old('translate', $article->content) }}</textarea>
                            </div>
                            <div class="well well-sm">
                                <button type="submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>翻译</button>
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
        var simplemde2 = new SimpleMDE({ element: document.getElementById('translate') });
    </script>
@endsection

