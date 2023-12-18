@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header blog-navigation">
                    <h4 class="card-title">{{ __('Blog Detail') }}</h4>
                    <a href="{{ route('blog-create') }}">{{ __('Create Blog') }}</a>
                </div>

                <div class="card-body">
                    <h3><strong>{{ ucfirst($blogResponse->title) }}</strong></h3>
                    <h5>Tags: {{ $blogResponse->title }}</h5>
                    <h5>Published On: {{ $blogResponse->sechedule_post_on }}</h5>
                    @if($blogResponse->category->count()>0)
                    <h5>Category: 
                    @foreach($blogResponse->category as $category_value)

                    <span>{{ $category_value->name }}</span>
                    @endforeach
                    </h5>
                    @endif
                    @if($blogResponse->media->count()>0)
                    @foreach($blogResponse->media as $media)
                        @if($media->media_filetype=='image')
                        <img src="{{ $media->media_filename }}" class="img-responsive" />
                        @endif
                        @if($media->media_filetype=='video')
                            <video width="320" height="240" controls>
                            <source src="{{ $media->media_filename }}" type="video/mp4">
                            <source src="{{ $media->media_filename }}" type="video/webm">
                            Your browser does not support the video tag.
                            </video>
                        @endif
                    @endforeach
                    @endif
                    
                    {!! (isset($blogResponse->description) && $blogResponse->description!='') ? $blogResponse->description : '' !!}

                    <p>Likes: <span>{{ $blogResponse->blogLike->count() }}<span></p>
                    @include('partials.flash-message')
                    @if(isset($comments) && $comments->count()>0)
                    <h4 class="py-2">Comments</h4>
                    {!! $comments_html !!}
                    @endif
                    <h4 class="py-3">Write Comment on blog</h4>
                    <form action="{{ route('comment') }}" method="POST" class="comment-form">
                        <input type="hidden" name="blog_id" value="{{ $blogResponse->id }}"/>
                        <input type="hidden" name="parent_id" value="0"/>
                        @csrf
                        <div class="row">
                            <div class="col-md-12 m-auto">
                                
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
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-script')
<script>
    $(document).ready(function(){

        $('.write-reply').click(function(){
            console.log('reply');
            $('form.reply-comment-form').hide();
            $(this).parent().find('form.reply-comment-form').show();
        })
    })
</script>
@endsection