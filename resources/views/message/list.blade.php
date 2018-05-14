@if (count($messageAll))

    <ul class="media-list">
        @foreach ($messageAll as $topic)
            <li class="media" id="m{{ $topic->id }}">
                <div class="media-left">
                    <a href="{{ route('users', ['id' => $topic->f_id]) }}">
                        <img class="media-object img-thumbnail" style="width: 52px; height: 52px;" src="{{ $topic->user->url }}" title="{{ $topic->user->name }}">
                    </a>
                </div>

                <div class="media-body">

                    <div class="media-heading">
                        <a id="title" href="{{ route('message.show', ['id' => $topic->id]) }}" title="{{ $topic->title }}">
                            {{ $topic->title }}
                        </a>
                    </div>

                    <div class="media-body meta">

                        @if($topic->status == 0)
                            <span class="text-success">未读</span>
                        @else
                            <span class="text-primary">已读</span>
                        @endif
                        <span> • </span>
                        <a href="{{ route('users', [$topic->u_id]) }}" title="{{ $topic->user->name }}">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            {{ $topic->user->name }}
                        </a>
                        <span> • </span>
                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                        <span class="timeago" title="最后活跃于">{{ $topic->updated_at->diffForHumans() }}</span>
                        <span> • </span>
                        <span class="glyphicon glyphicon-remove" id="{{ $topic->id }}"
                                aria-hidden="true" style="color: #721c24" onclick="mDelete(this.id)" ></span>

                    </div>
                </div>
            </li>

            @if ( ! $loop->last)
                <hr>
            @endif

        @endforeach
    </ul>

@else
    <div class="empty-block">暂无数据 ~_~ </div>
@endif
