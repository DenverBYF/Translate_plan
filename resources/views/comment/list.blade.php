<div class="commentList">
    @foreach($comment as $eachComment)
        <div class="media" id="c{{ $eachComment->id }}">
            <a class="media-left" href="{{ route('person.show', ['id' => $eachComment->user->id]) }}">
                <img  src="{{ $eachComment->user->url }}" class="media-object" style="width: 50px; height: 50px">
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{ $eachComment->user->name }}</h4>
                {!! Parsedown::instance()->setMarkupEscaped(true)->text($eachComment->content) !!}
            </div>
            <div class="media-right">
                <span><i id="{{ $eachComment->id."#".$eachComment->user->name}}" class="glyphicon glyphicon-comment" onclick="replay(this.id)"></i></span>
                @if(\Illuminate\Support\Facades\Auth::id() === $eachComment->u_id)
                    <span><i id="{{ $eachComment->id }}" class="glyphicon glyphicon-remove" onclick="deleteComment(this.id)"></i></span>
                @endif
            </div>
        </div>
    @endforeach
</div>