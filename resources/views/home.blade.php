@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header blog-navigation">
                    {{ __('Blogs List') }}
                    <a href="">{{ __('Create Blog') }}</a>
                </div>

                <div class="card-body">
                    
                    <div class="col-md-4">
                        list 1
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
