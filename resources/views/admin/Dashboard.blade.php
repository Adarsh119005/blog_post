@extends('navbar.nav')

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="container">
    <h1 class="mb-4">My Blog Dashboard</h1>

    <a href="{{ route('posts.create') }}" class="btn btn-success mb-3">
        ➕ Add New Post
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
            <tr class="
                @if($post->status === 'draft') table-warning
                @elseif($post->status === 'archived') table-danger
                @else table-success
                @endif
            ">
                <td>{{ $post->title }}</td>
                <td>{{ ucfirst($post->status) }}</td>
                <td>{{ $post->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Delete this post?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center text-muted py-4">
                    📝 You haven’t created any blog posts yet. <br>
                    <a href="{{ route('posts.create') }}" class="btn btn-outline-primary mt-2">
                        Create Your First Blog Post
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection