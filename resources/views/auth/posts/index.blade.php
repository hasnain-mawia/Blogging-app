@extends('layouts.auth')

@section('title', 'All Post | Admin Dashboard')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
<link href="{{asset('assets/auth/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css')}}" rel="stylesheet" />
<style>
    <style>#outer {
        text-align: center;
    }

    .inner {
        display: inline-block;
    }
    .cus-thumb{
        width: 80px;
    }
</style>
</style>
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
                <h2>All Post</h2>
            </div>
            @if (Session::has('alert-success')) 
            <div class="alert alert-success alert-dismissible mx-2">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success!</strong> {{ Session::get('alert-success') }}
            </div>
            @endif

            <div class="card-body">
                @if(count($posts) > 0)
                <table class="table" id="posts">
                    <thead>
                        <tr>
                            <th scope="col">Thumbnail</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Category</th>
                            <th scope="col">Username</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="align-items-center">
                        @foreach($posts as $post)
                        <tr>
                            <td><img class="cus-thumb" src="{{asset('storage/auth/posts/').'/'.$post->gallery->image}}" alt=""></td>
                            <td>{{ Str::limit($post->title, 20, '...')}}</td>
                            <td>{{ Str::limit($post->description, 20, '...')}}</td>
                            <td>{{ $post->category->name}}</td>
                            <td>{{ $post->user->name }}</td>
                            <td >{{ $post->status == 1 ? 'Publish' : 'Draft' }}</td>
                            <td class="outer">
                                <a href="{{route('posts.show', $post->id)}}" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{route('posts.edit', $post->id)}}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form method="post" action="{{route('posts.destroy', $post->id)}}" class="inner">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><a class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="text-center">
                    <h3 class="text-center text-danger">No Post Found</h3>
                    <button class="mt-2" type="submit"><a href="{{route('posts.create')}}" class="btn btn-primary">Create Post</a></button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('assets/auth/js/multiselect-dropdown.js')}}"></script>
<script src="{{asset('assets/auth/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#posts').DataTable({
            'bLengthChange': false,
        });
    });
</script>
@endsection