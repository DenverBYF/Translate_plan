@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-offset-1 col-lg-10 col-md-10 col-xs-12 col-sm-12 col-lg-offset-1 panel panel-default">
            <div class="panel-heading">
                {{ $message->title }}
            </div>
            <div class="panel-body">
                {{ $message->content }}
            </div>
            @if(!empty($message->href))
                <div class="panel-footer">
                    <a href="{{ $message->href }}"><button class="btn btn-md btn-primary">查看详情</button></a>
                </div>
            @endif
        </div>
    </div>
@endsection