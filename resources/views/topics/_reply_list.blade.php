<div class="reply-list">
    @foreach ($replies as $index => $reply)
        <div class="media" id="reply{{ $reply->id }}" name="reply{{ $reply->id }}">
            <div class="avatar pull-left">
                <a href="{{ route('users.show', [$reply->user_id]) }}">
                    <img src="{{ $reply->user->avatar }}" alt="{{ $reply->user->name }}" class="media-object img-thumbnail" width="48px" height="48px">
                </a>
            </div>

            <div class="infos">
                <div class="media-heading">
                    <a href="{{ route('users.show', [$reply->user_id]) }}" title="{{ $reply->user->name }}">
                        {{ $reply->user->name }}
                    </a>
                    <span> •  </span>
                    <span class="meta" title="{{ $reply->created_at }}">{{ $reply->created_at->diffForHumans() }}</span>

                    {{--  回复删除按钮  --}}
                    @can('destroy', $reply)
                        <span class="meta pull-right">
                            <form action="{{ route('replies.destroy', $reply->id) }}" method="POST" title="删除回复">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-default btn-xs pull-left">
                                    <i class="glyphicon glyphicon-trash" aria-hidden=""></i>
                                </button>
                            </form>
                        </span>
                    @endcan
                </div>
                <div class="reply-content">
                    {!! $reply->content !!}
                </div>
            </div>
        </div>
    @endforeach
</div>