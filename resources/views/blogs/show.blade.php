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
                    @if(isset($blogResponse))
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
                    <div class="row">
                    @foreach($blogResponse->media as $media)
                    
                        @if($media->media_filetype=='image')
                        <div class="col-md-3">
                            <img src="{{ route('media-files',[$media->media_filename]) }}" class="blog-image" />
                        </div>
                        @endif
                        @if($media->media_filetype=='video')
                        <div class="col-md-3">
                            <video width="100%" height="240" controls>
                            <source src="{{ route('media-files',[$media->media_filename]) }}" type="video/mp4">
                            <source src="{{ route('media-files',[$media->media_filename]) }}" type="video/webm">
                            Your browser does not support the video tag.
                            </video>
                        </div>
                        @endif
                    @endforeach
                    </div>
                    @endif
                    <div class="blog-description py-3">
                    <h4>Description:</h4>
                    {!! (isset($blogResponse->description) && $blogResponse->description!='') ? $blogResponse->description : '' !!}
                    </div>
                    <p>
                        <a href="javascript:void(0);" data-blogid="" onclick="likeblog({{ $blogResponse->id }})">
                            <img src="{{ asset('icons/like-icon.svg') }}" style="width:25px;"/>
                        </a>
                        <span class="like-count">{{ $blogResponse->blogLike->count() }}<span>
                    </p>
                    @include('partials.flash-message')
                    
                    <h4 class="py-2">Comments</h4>
                    <div class="comment-replies-section">
                        {!! $comments_html !!}
                    </div>
                    
                    <h4 class="py-3">Write Comment on blog</h4>
                    <form action="{{ route('comment') }}" method="POST" class="comment-form" onsubmit="commentform(event,this)">
                        <input type="hidden" name="blog_id" value="{{ $blogResponse->id }}"/>
                        <!-- <input type="hidden" name="parent_id" value="0"/> -->
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
                    
                    @else
                    <a href="{{ route('blogs') }}">Blog List</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-script')
<script>
    function likeblog(blogId){
        console.log('blogId',blogId);
        $.ajax({
            url:'{{ route("like-blog") }}',
            type:'post',
            data:{blog_id:blogId,'_token':'{{@csrf_token()}}'},
            success:function(response){
                if(response.status){
                $('.like-count').html(response.like_count);
                }
            }
        });
    }

    function commentform(e,element){
        e.preventDefault();
        console.log('form',$(element).serialize());
        $.ajax({
            url:'{{ route("comment-replies") }}',
            type:'post',
            data:$(element).serialize(),
            success:function(response){
                if(response.status){
                // console.log('response',response);
                    $('.comment-replies-section').html(response.data);
                }
            }
        });
        $(element).find('textarea').val('');
        return false;
    }
    $(document).ready(function(){
        // $('body').on('submit','.comment-form',function(e){
            
        // })
        $('body').on('click','.write-reply',function(){
            console.log('reply');
            $('form.reply-comment-form').hide();
            $(this).parent().find('form.reply-comment-form').show();
        })
    })
</script>
@endsection