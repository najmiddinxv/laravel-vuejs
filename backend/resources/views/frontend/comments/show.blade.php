@forelse($comments as $comment)

<div class="commen-item @if($comment->parent_id != null) reply @endif"">
    <div class="avatar">
        <img src="/assets/frontend/img/800x800.png" alt="Author">
    </div>
    <div class="content">
        <h5>{{ $comment->user->full_name }}</h5>
        <div class="comments-info">

            <p>{{ $comment->created_at->format('D, M d, Y')}}</p>
            <a href="#"><i class="fa fa-reply"></i>Reply</a>
        </div>
        <p>
            {{ $comment->body }}
        </p>
    </div>

    @auth
    <form method="POST" action="{{ route('frontend.comments.storeReply', ['commentId' => $comment->id]) }}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group comments">
                    <textarea name="body" class="form-control" placeholder="Comment"></textarea>
                </div>
                <div class="form-group full-width submit">
                    <button type="submit">
                        Comment
                    </button>
                </div>
            </div>
        </div>
    </form>
    @else
        <p>comment qoldirish uchun tizimga kiring
            <a href="{{route('userProfile.auth.login')}}" title="login" class="btn btn-success">
                login
            </a>
        </p>
    @endauth
     <!-- Recursively include replies -->
     @if($comment->replies?->isNotEmpty())
        @include('frontend.comments.show', ['comments' => $comment->replies])
    @endif
</div>

@empty

@endforelse

