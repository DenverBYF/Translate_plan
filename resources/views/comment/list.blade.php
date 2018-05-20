<div class="commentList">
    @foreach($comment as $eachComment)
        <div class="media">
            <a class="media-left" href="{{ route('person.show', ['id' => $eachComment->user->id]) }}">
                <img  src="{{ $eachComment->user->url }}" class="media-object" style="width: 50px; height: 50px">
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{ $eachComment->user->name }}</h4>
                {!! Parsedown::instance()->setMarkupEscaped(true)->text($eachComment->content) !!}
            </div>
        </div>
    @endforeach
</div>