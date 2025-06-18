@extends('navbar.nav')

@section('title', $post->title)

@section('style')
<style>
.blog-header {
    background-image: url('https://source.unsplash.com/1600x400/?blog,writing');
    background-size: cover;
    background-position: center;
    height: 40vh;
    position: relative;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.blog-header h1 {
    background: rgba(0, 0, 0, 0.6);
    padding: 20px;
    border-radius: 10px;
}

.blog-content img {
    max-width: 100%;
    height: auto;
    margin: 20px 0;
}
</style>
@endsection

@section('content')
<div class="blog-header">
    <h1>{{ $post->title }}</h1>
</div>

<div class="container py-5">
    <p class="text-muted mb-2">
        Published on {{ $post->created_at->format('F d, Y') }}
    </p>

    <hr>

    <div class="blog-content">
        {!! $post->content !!}
    </div>

    <a href="{{ route('home') }}" class="btn btn-secondary mt-4">← Back to Blogs</a>
</div>
<br />
<br />
<br />
<hr>


<div class="comment" style="padding:5%;">
    <h4>Comments</h4>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @foreach($post->comments as $comment)
    <div class="mb-3 border p-3 rounded">
        <strong>{{ $comment->name }}</strong>
        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
        <p class="mb-0">{{ $comment->comment }}</p>
    </div>
    @endforeach

    <hr>

    <h5 class="mt-4">Leave a Comment</h5>
    <form style="" method="POST" action="{{ route('blogs.show', $post->slug) }}">
        @csrf
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Comment:</label>
            <textarea name="comment" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Post Comment</button>
    </form>
</div>
@endsection