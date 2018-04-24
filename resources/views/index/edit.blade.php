@extends('layouts.app')
@section('title', $user->name)

@section('content')
    <div class="row">
        <div class="panel panel-default col-md-10 col-md-offset-1">
            <div class="panel-heading">
                <h4>
                    <i class="glyphicon glyphicon-edit"></i> 编辑个人资料
                </h4>
            </div>
            @include('layouts._error')
            <div class="panel-body">
                <form action="{{ route('person.update', Auth::id()) }}" method="post"
                        class="form-horizontal" role="form" enctype="multipart/form-data" accept-charset="utf-8">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="name" class="control-label">用户名</label>
                        <input class="form-control col-md-10" type="text" name="name" id="name"
                                value="{{ old('name', $user->name) }}">
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">邮箱</label>
                        <input class="form-control col-md-10" type="text" name="email" id="email"
                                value="{{ old('email', $user->email) }}">
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">年龄</label>
                        <input class="form-control col-md-10" type="text" name="age" id="age"
                                value="{{ old('age', $user->age) }}">
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">微信</label>
                        <input class="form-control col-md-10" type="text" name="wechat" id="wechat"
                                value="{{ old('wechat', $user->wechat) }}">
                    </div>
                    <div class="form-group">
                        <label for="sex" class="control-label">性别</label>
                        <select class="form-control col-md-10" name="sex" id="sex">
                            <option value="0" @if ($user->sex == 0) selected="selected" @endif>保密</option>
                            <option value="1" @if ($user->sex == 1) selected="selected" @endif>男</option>
                            <option value="2" @if ($user->sex == 2) selected="selected" @endif>女</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="desc">个人简介</label>
                        <textarea name="desc" id="desc" class="form-control"
                                rows="3">{{ old('desc', $user->desc ) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="img">头像</label>
                        <input class="form-control" name="img" id="img" type="file">
                    </div>
                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection