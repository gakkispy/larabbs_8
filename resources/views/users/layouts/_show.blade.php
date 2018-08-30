@extends('layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')
    <div class="row">

        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="media">
                        <div class="center">
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" width="300px" height="300px" class="thumbnail img-responsive">
                        </div>
                        <div class="media-body">
                            @include('shared._stats')
                            <hr>
                            <h4><strong>个人简介</strong></h4>
                            <p>{{ $user->introduction }}</p>
                            <hr>
                            <h4><strong>注册于</strong></h4>
                            <p>{{ $user->created_at->diffForHumans() }}</p>
                            <h4><strong>最后活跃</strong></h4>
                            <p title="{{ $user->last_actived_at }}">{{ $user->last_actived_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <span>
                        <h1 class="panel-title pull-left" style="font-size: 30px;">{{  $user->name }} <small>{{ $user->email }}</small></h1>
                    </span>
                </div>
            </div>

            <hr>
            {{--  用户发布的内容  --}}

            <div class="panel panel-default">
                <div class="panel-body">
                    @yield('content.user_show')
                </div>
            </div>
        </div>
    </div>
@endsection