@extends('layouts.app')
@section('content')
        
        <div class="container mt-5">
            
            <form action="{{ route('blog') }}" method="POST" class="blog-create-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 m-auto">
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ Session::get('success') }}
                            </div>
                        @elseif(Session::has('failed'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ Session::get('failed') }}
                            </div>
                        @endif
                        <div class="card shadow">
                            <div class="card-header">
                                <h4 class="card-title"> Create Blog </h4>
                            </div>
                            <div class="card-body">
                                <!-- Blog title -->
                                <div class="form-group">
                                    <label> Title </label>
                                    <input type="text" class="form-control" name="title" placeholder="Enter the Title" value="{{ old('title') }}" maxlength="200">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Category select multiple -->
                                <div class="form-group">
                                    <label> Category </label>
                                    <div class="row">
                                    @if(isset($categories) && $categories->count()>0)
                                    @foreach($categories as $category)
                                    <div class="col-md-2">
                                    <input type="checkbox" name="category[]" id="check-{{ $category->id }}" value="{{ $category->id }}">
                                    <label for="check-{{ $category->id }}">{{ $category->name }}</label>
                                    </div>
                                    @endforeach
                                    @endif
                                    </div>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Images and videos multiple -->
                                <div class="form-group">
                                    <label> Images/Videos </label>
                                    <input type="file" class="form-control" name="image_video_file[]" multiple accept="image/*,video/*">
                                    @error('image_video_file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Tags -->
                                <div class="form-group">
                                    <label> Tags </label>
                                    <div class="u-tagsinput">
                                        <input type="text" name="tags" value="{{ old('tags') }}" class="form-control " data-role="tagsinput">
                                    </div>
                                    @error('tags')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Published date and time picker -->
                                <div class="form-group">
                                    <label> Published On </label>
                                    <div class="col-md-12 d-flex gap-3 blog-date-time">
                                        <div>
                                        <input type="date" id="datetimepicker1" class="form-control" name="sechedule_post_on_date" value="{{ old('sechedule_post_on_date') }}">
                                        @error('sechedule_post_on_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                        <div>
                                        <input type="time" class="form-control" name="sechedule_post_on_time" value="{{ old('sechedule_post_on_time') }}">
                                        @error('sechedule_post_on_time')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Description -->
                                <div class="form-group">
                                    <label> Description </label>
                                    <textarea class="form-control" id="content" placeholder="Enter the Description" rows="5" name="body"></textarea>
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
        
        
@endsection

@section('page-script')




<script>
    ClassicEditor.create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        } );

</script>
@endsection