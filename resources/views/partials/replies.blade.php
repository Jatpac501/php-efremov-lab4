@foreach ($comments as $reply)
    <div class="comment comment__reply" style="margin-left: {{ $level * 20 }}px; margin-top: 15px">
        <strong class="comment__author">{{ $reply->user->name }}</strong> <span class="comment__date">({{ $reply->created_at->diffForHumans() }}):</span>
        <p class="comment__content">{{ $reply->content }}</p>
        <button class="reply-button" data-comment-id="{{ $reply->id }}">Ответить</button>
        <form action="{{ route('comments.store', $reply->product_id) }}" method="POST" class="reply-form" style="display: none;" data-comment-id="{{ $reply->id }}">
            @csrf
            <input type="hidden" name="parent_id" value="{{ $reply->id }}">
            <div class="form-group">
                <textarea name="content" class="form-group" placeholder="Ваш ответ..." required>{{ old('content') }}</textarea>
            </div>
            <button type="submit" class="button">Отправить</button>
        </form>

        @if ($reply->replies)
            @include('partials.replies', ['comments' => $reply->replies, 'level' => $level + 1])
        @endif
    </div>
@endforeach
