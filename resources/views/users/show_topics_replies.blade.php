@extends('users.layouts._show')

@section('content.user_show')
    
    <ul class="nav nav-tabs">
        <li class="{{ active_class(if_query('tab', null)) }}">
            <a href="{{ route('users.show', $user->id) }}">Ta 的话题</a>
        </li>
        <li class="{{ active_class(if_query('tab', 'replies')) }}">
            <a href="{{ route('users.show', [$user->id, 'tab' => 'replies']) }}">Ta 的回复</a>
        </li>
    </ul>
    @if (if_query('tab', 'replies'))
        @include('users._replies', ['replies' => $user->replies()->with('topic')->recent()->paginate(5)])
    @else
        @include('users._topics', ['topics' => $user->topics()->recent()->paginate(5)])
    @endif
@endsection