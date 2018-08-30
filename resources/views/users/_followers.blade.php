@if (count($followers))
    
    <ul class="list-group">
        @foreach ($followers as $follower)
            <li class="list-group-item">
                <img src="{{ $follower->avatar }}" alt="{{ $follower->name }}" width="24px" height="24px">
                <a href="{{ route('users.show', $follower->id) }}">
                    {{ $follower->name }}
                </a>

                <div class="meta pull-right">
                    <span class="glyphicon glyphicon-time" aria-hidden="true"></span> 最后活跃 {{ $follower->last_actived_at->diffForHumans() }}
                </div>
            </li>
        @endforeach
    </ul>

@else
    <div class="empty-block"> 暂无数据 ~_~ </div>
@endif

{{--  分页  --}}
{!! $followers->appends(Request::except('page'))->render() !!}