
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header blog-navigation">
                    {{ __('Blogs List') }}
                    <a href="{{ route('blog-create') }}">{{ __('Create Blog') }}</a>
                </div>

                <div class="card-body">
                    @if(isset($blogs) && $blogs->count()>0)
                        @foreach($blogs as $key => $blog_value)
                            <div class="col-md-4">
                                
                                {{$blog_value->title}}
                                {{$blog_value->tags}}

                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection