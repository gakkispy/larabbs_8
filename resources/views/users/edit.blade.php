@extends('layouts.app')

@section('content')
    
<div class="container">
    <div class="panel panel-default col-md-10 col-md-offset-1">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-edit"></i> 编辑个人资料
            </h4>
        </div>

        @include('common.error')

        <div class="panel-body">

            <form action="{{ route('users.update', $user->id) }}" accept-charset="UTF-8" method="post" class="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="name-field" class="control-label">用户名</label>
                    <input type="text" class="form-control" name="name" id="name-field" value="{{ old('name', $user->name) }}">
                </div>

                <div class="form-group">
                    <label for="email-field" class="control-label">E-Mail</label>
                    <input type="email" class="form-control" name="email" id="email-field" value="{{ old('email', $user->email) }}">
                </div>

                <div class="form-group">
                    <label for="introduction-field" class="control-label">个人简介</label>
                    <textarea  class="form-control" name="introduction" id="introduction-field" rows="3" >{{ old('introduction', $user->introduction) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="avatar-field" class="avatar-label">用户头像</label>
                    <input type="file" name="avatar" id="avatar_field">

                    @if ($user->avatar)
                        <br>
                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}" width="200px;" class="thumbnail img-responsive">
                    @endif
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection