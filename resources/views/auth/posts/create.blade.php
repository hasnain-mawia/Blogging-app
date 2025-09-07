@extends('layouts.auth')

@section('title', 'Create Post | Admin Dashboard')
@section('content')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/auth/css/multi-selectdropdown.css')}}">
@endsection


<div class="content-wrapper">
<div class="content">


<!-- Masked Input -->
<div class="card card-default">
  <div class="card-header">
    <h2>Create Post</h2>
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

  <form method="post" action="{{route('posts.store')}}">
  @csrf
  <div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" value="{{old('title')}}" class="form-control" placeholder="Title">
  </div>
  <div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" cols="30" rows="3" placeholder="Description"></textarea>
  </div>
  <div class="mb-3">
    <label class="form-label">Is Publish</label>
    <select name="status" id="" class="form-control">
      <option value="" disabled selected>--- Select ---</option>
      <option value="1">Publish</option>
      <option value="0">Draft</option>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Categories</label>
    <select name="category" id="" class="form-control">
      <option value="" disabled selected> --- Select ---</option>
      @if (count($categories) > 0)
      @foreach ($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>
      @endforeach
      @endif
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Tags</label>
    <select name="tags[]" id="" class="form-control selectpicker" multiple data-live-search="true">
     @if (count($tags) > 0)
      @foreach ($tags as $tag)
        <option value="{{$tag->id}}">{{$tag->name}}</option>
      @endforeach
      @endif
    </select>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>    
</div>
  </div>
</div>
</div>

@endsection

@section('scripts')
<script src="{{asset('assets/auth/js/multiselect-dropdown.js')}}"></script>
@endsection