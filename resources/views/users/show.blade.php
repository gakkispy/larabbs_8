@extends('layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')
    <div class="row">

        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="media">
                        <div class="center">
                            <img src="https://fsdhubcdn.phphub.org/uploads/images/201709/20/1/PtDKbASVcz.png?imageView2/1/w/600/h/600" alt="{{ $user->name }}" width="300px" height="300px" class="thumbnail img-responsive">
                        </div>
                        <div class="media-body">
                            <hr>
                            <h4><strong>个人简介</strong></h4>
                            <p>Despesido</p>
                            <hr>
                            <h4><strong>注册于</strong></h4>
                            <p>1999.9.1</p>
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
                    暂无数据 &nbsp;&nbsp;   ○|￣|_
                </div>
            </div>
        </div>
    </div>
@endsection