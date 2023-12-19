@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('partials.flash-message')
            <div class="card">
                <div class="card-header blog-navigation">
                    <h4 class="card-title">{{ __('Blogs List') }}</h4>
                    <a href="{{ route('blog-create') }}">{{ __('Create Blog') }}</a>
                </div>

                <div class="card-body">
                    <div class="row">
                    @if(isset($blogs) && $blogs->count()>0)
                        @foreach($blogs as $key => $blog_value)
                            <div class="col-md-3">
                                 <h4>
                                    <a href="{{ route('blog-detail',[$blog_value->slug]) }}" class="text-decoration-none">
                                        {{ ucfirst($blog_value->title) }}
                                    </a>
                                </h4>
                                <span></span>
                                <p>Tags: {{$blog_value->tags}}</p>
                                <a href="{{ route('blog-detail',[$blog_value->slug]) }}" class="btn btn-primary">
                                    {{ __('View') }}
                                </a>
                            </div>
                        @endforeach
                    @else
                    <h4>{{__('No Blog Found')}}</h4>
                    <a href="{{ route('blog-create') }}">Create blog</a>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection