@extends('layouts.auth')

@section('title', 'All Tags | Admin Dashboard')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
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
                <h2>Tags</h2>
            </div>
            @if (Session::has('alert-success')) 
            <div class="alert alert-success alert-dismissible mx-2">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success!</strong> {{ Session::get('alert-success') }}
            </div>
            @endif

            <div class="card-body">
                @if(count($tags) > 0)
                <table class="table" id="posts">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                        <tr class="text-align-center ">
                            <td>{{ $tag->id}}</td>
                            <td>{{ $tag->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="text-center">
                    <h3 class="text-center text-danger">No Tags Found</h3>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#posts').DataTable({
            'bLengthChange': false,
        });
    });
</script>
@endsection