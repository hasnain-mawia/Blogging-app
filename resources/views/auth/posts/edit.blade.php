@extends('layouts.auth')

@section('title', 'Edit Post | Admin Dashboard')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/auth/css/multiselect-dropdown.css')}}">
@endsection

@section('content')
<!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
<div class="content-wrapper">
    <div class="content"><!-- For Components documentaion -->
        <!-- Masked Input -->
        <div class="card card-default">
            <div class="card-header">
                <h2>Edit Post</h2>
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="post" action="{{route('posts.update', $post->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input name="title" value="{{ old('title', $post->title)}}" type="text" class="form-control" placeholder="Title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description </label>
                        <textarea name="description" id="" class="form-control" cols="30" rows="3" placeholder="Description">{{ old('description', $post->description)}}</textarea>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="mb-3 col-6 sm-col-12">
                                <label class="form-label">Is Publish</label>
                                <select name="status" id="" class="form-control">
                                    <option value="" disabled selected>Choose Option</option>
                                    <option value="1" {{ old('status', $post->status) == 1 ? 'selected' : '' }}>Publish</option>
                                    <option value="0" {{ old('status', $post->status) == 0 ? 'selected' : '' }}>Draft</option>
                                </select>
                            </div>
                            <div class="mb-3 col-6 sm-col-12">
                                <label class="form-label">Category</label>
                                <select name="category" id="" class="form-control">
                                    <option value="" disabled selected>Choose Options</option>
                                    @if(count($categories) > 0)
                                    @foreach ($categories as $category)
                                    <option @selected (old('category', $post->id) == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tags</label>
                            <select name="tags[]" id="" class="form-control selectpicker" multiple data-live-search="true">
                                @if(count($tags) > 0)
                                @foreach ($tags as $tag)
                                @if(count($post->tags) > 0)
                                @foreach($post->tags as $postTag)
                                <option @selected (old('tags', $postTag->id) == $tag->id) value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                                @endif
                                @php
                                continue;
                                @endphp
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <!-- ------------------------ Image View ---------------------------- -->
                        <!-- Current Image Section -->
                        <div class="mb-3" id="currentImageContainer">
                            <label>Current Image:</label><br>
                            @if ($post->gallery->image)
                            <div style="position: relative; display: inline-block;">
                                <img id="currentImage" class="cus-thumb mb-2"
                                    src="{{ asset('storage/auth/posts/' . $post->gallery->image) }}"
                                    alt="Current Image" width="150">
                                <!-- Cross (X) Button -->
                                <button type="button"
                                    onclick="removeCurrentImage()"
                                    style="position: absolute; top: -10px; right: -10px;
                           background: red; color: white; border: none;
                           border-radius: 50%; width: 25px; height: 25px;
                           cursor: pointer;">
                                    &times;
                                </button>
                            </div>
                            <!-- Hidden input to tell backend to delete image -->
                            <input type="hidden" name="remove_image" id="removeImageInput" value="0">
                            @else
                            <p>No image uploaded.</p>
                            @endif
                        </div>
                        <!-- Upload New Image Section (Initially hidden if image exists) -->
                        <div class="mb-3" id="imageUploadField" style="display: {{ $post->gallery->image ? 'none' : 'block' }};">
                            <label>Upload Image:</label>
                            <input type="file" name="image" class="form-control">
                        </div>


                        <!-- ------------------------ Image View ---------------------------- -->
                    </div>
                    <button type="submit" class="btn btn-primary">Update Post</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('assets/auth/js/multiselect-dropdown.js')}}"></script>
<script>
function removeCurrentImage() {
    // Hide the current image container
    document.getElementById('currentImageContainer').style.display = 'none';

    // Show the upload input
    document.getElementById('imageUploadField').style.display = 'block';

    // Set the hidden input value to indicate image should be removed
    document.getElementById('removeImageInput').value = '1';
}
</script>
@endsection