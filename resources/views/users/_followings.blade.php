@if (count($followings))
    
    <ul class="list-group">
        @foreach ($followings as $following)
            <li class="list-group-item">
                <img src="{{ $following->avatar }}" alt="{{ $following->name }}" width="24px" height="24px">
                <a href="{{ route('users.show', $following->id) }}">
                    {{ $following->name }}
                </a>

                <div class="meta pull-right">
                    <span class="glyphicon glyphicon-time" aria-hidden="true"></span> 最后活跃 {{ $following->last_actived_at->diffForHumans() }}
                </div>
            </li>
        @endforeach
    </ul>

@else
    <div class="empty-block"> 暂无数据 ~_~ </div>
@endif

{{--  分页  --}}
{!! $followings->appends(Request::except('page'))->render() !!}