<div class="comment-items {{ isset($comment_value->parent_id) ? 'ms-4' : '' }}">
    
    <h5>User: <span>{{ ucfirst($comment_value->user->name) }}</span></h5>
    <p class="comment-text">{{ ucfirst($comment_value->message) }}</p>
    <a href="javascript:void(0);" class="write-reply">Write Comment</a>
    <form action="{{ route('comment') }}" method="POST" class="reply-comment-form comment-form" onsubmit="commentform(event,this)">
        <input type="hidden" name="blog_id" value="{{ $blogId }}"/>
        <input type="hidden" name="parent_id" value="{{ $comment_value->id }}"/>
        @csrf
        <div class="row">
            <div class="col-md-12 m-auto">
                
                <div class="card">
                    
                    <div class="card-body">
                        <!-- Blog title -->
                        <div class="form-group">
                            <label> Comment </label>
                            <textarea placeholder="Write Comment" name="message" class="form-control"></textarea>
                            @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success"> Save </button>
                        <a href="{{ url('/') }}" class="btn btn-danger"> Back </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>