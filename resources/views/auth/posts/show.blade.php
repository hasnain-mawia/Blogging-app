@extends('layouts.auth')

@section('title', 'View Post  | Admin Dashboard')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
<link href="{{asset('assets/auth/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css')}}" rel="stylesheet" />
<style>
    .cus-thumb{
        width: 250px;
    }
</style>
@endsection

@section('content')
<!-- ============== CONTENT WRAPPER  ===================== -->
<div class="content-wrapper">
    <div class="content">
        <!-- Masked Input -->
        <div class="card card-default">
            <div class="card-header">
                <h2>View Post</h2>
            </div>
            <div class="card-body">
                @if($post)
                <table class="table">
                    <tbody>
                        <tr>
                             <th scope="col">Thumbnail</th>
                            <td><img class="cus-thumb" src="{{asset('storage/auth/posts/').'/'.$post->gallery->image}}" alt=""></td>

                        </tr>

                        <tr>
                             <th scope="col">Title</th>
                            <td>{{ $post->title}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Description</th>
                            <td>{{ $post->description}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Category</th>
                            <td>{{ $post->category->name}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Username</th>
                            <td>{{ $post->user->name}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Status</th>
                            <td>{{ $post->status == 1 ? 'Publish' : 'Draft' }}</td>
                        </tr>
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

@endsection