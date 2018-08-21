@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/simditor.css') }}">
@endsection

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <h2 class="text-center">
                    <i class="glyphicon glyphicon-edit"></i> 
                    @if($topic->id)
                        编辑话题
                    @else
                        新建话题
                    @endif
                </h2>
            </div>
            <hr>

            @include('common.error')

            <div class="panel-body">
                @if($topic->id)
                    <form action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    
                    <div class="form-group">
                        <input class="form-control" type="text" name="title" id="title-field" value="{{ old('title', $topic->title ) }}" placeholder="请输入标题"  required/>
                    </div> 

                    <div class="form-group">
                        <select name="category_id" id="category-field" class="form-control" required>
                            <option value="" hidden disabled selected>请选择分类</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"> {{ $category->name }}</option>
                            @endforeach
                        </select>       
                    </div> 

                    <div class="form-group">
                        <textarea name="body" id="editor" class="form-control" rows="3" placeholder="请输入至少三个字符的内容。" required>{{ old('body', $topic->body ) }}</textarea>
                    </div> 

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 保存
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script src="{{ asset('js/module.min.js') }}"></script>
    <script src="{{ asset('js/hotkeys.min.js') }}"></script>
    <script src="{{ asset('js/uploader.min.js') }}"></script>
    <script src="{{ asset('js/simditor.min.js') }}"></script>

    <script>
        $(document).ready(() => {
            var editor = new Simditor({
                textarea: $('#editor')
            })
        })
    </script>
@endsection

@endsection