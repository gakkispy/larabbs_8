<hr>
<p class="stats">
    <a href="{{ route('followers.show', $user->id) }}"><strong>关注</strong>{{ count($user->followings) }}</a>
    <a href="{{ route('followers.show', [$user->id, 'tab' => 'followers']) }}"><strong>粉丝</strong>{{ count($user->followers) }}</a>
    <a href="{{ route('users.show', $user->id) }}"><strong>文章</strong>{{ count($user->topics) }}</a>
    @auth
        @include('users._follow_form')
    @endauth
</p>