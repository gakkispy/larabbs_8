@extends('users.layouts._show')

@section('content.user_show')
    
<ul class="nav nav-tabs">
    <li class="{{ active_class(if_query('tab', null)) }}">
        <a href="{{ route('followers.show', $user->id) }}">Ta 的关注</a>
    </li>
    <li class="{{ active_class(if_query('tab', 'followers')) }}">
        <a href="{{ route('followers.show', [$user->id, 'tab' => 'followers']) }}">Ta 的粉丝</a>
    </li>
</ul>
@if (if_query('tab', 'followers'))
    @include('users._followers', ['followers' => $user->followers()->paginate(5)])
@else
    @include('users._followings', ['followings' => $user->followings()->paginate(5)])
@endif
@endsection