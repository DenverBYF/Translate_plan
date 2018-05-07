@if (count($article))

    <ul class="media-list">
        @foreach ($article as $topic)
            <li class="media">
                <div class="media-left">
                    <a href="{{ route('users', ['id' => $topic->u_id]) }}">
                        <img class="media-object img-thumbnail" style="width: 52px; height: 52px;" src="{{ $topic->user->url }}" title="{{ $topic->user->name }}">
                    </a>
                </div>

                <div class="media-body">

                    <div class="media-heading">
                        <a id="title" href="{{ route('translate.show', ['id' => $topic->id]) }}" title="{{ $topic->part->article->title }}">
                            {{ $topic->part->article->title }}
                        </a>
                    </div>

                    <div class="media-body meta">
                        <a href="{{ route('users', [$topic->u_id]) }}" title="{{ $topic->user->name }}">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            {{ $topic->user->name }}
                        </a>
                        <span> • </span>
                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                        <span class="timeago" title="创建于">{{ $topic->updated_at->diffForHumans() }}</span>
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