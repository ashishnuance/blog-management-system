<div class="comment-items">
    {{$comment_value->id}}
    <h5>User: <span>{{ $comment_value->user->name }}</span></h5>
    <p class="comment-text">{{ $comment_value->message }}</p>
    <a href="javascript:void(0);" class="write-reply">Write Comment</a>
    <form action="{{ route('comment') }}" method="POST" class="reply-comment-form">
        <input type="hidden" name="blog_id" value="{{-- $blogResponse->id --}}"/>
        <input type="hidden" name="parent_id" value="{{ $comment_value->id }}"/>
        @csrf
        <div class="row">
            <div class="col-md-12 m-auto">
                @include('partials.flash-message')
                <div class="card">
                    
                    <div class="card-body">
                        <!-- Blog title -->
                        <div class="form-group">
                            <label> Comment </label>
                            <textarea placeholder="Write Comment" name="message" class="form-control">

                            </textarea>
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