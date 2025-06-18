@extends('navbar.nav')

@section('title', 'Home')

@section('style')
<style>
.imagin img {
    width: 100%;
    height: 70vh;
    object-fit: cover;
    display: block;
}

.imagin {
    position: relative;
}

.imagin h1 {
    position: absolute;
    font-size: 50px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    background-color: rgba(0, 0, 0, 0.5);
    padding: 10px 20px;
    border-radius: 8px;
}
</style>
@endsection

@section('content')
<div class="imagin mb-4">
    <img src="https://cdn.futura-sciences.com/sources/images/dossier/773/01-intro-773.jpg" alt="Blog Banner" />
    <h1>Welcome to the Home Page</h1>

</div>

<div class="container py-4">

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <h2 class="mb-4">Latest Blogs</h2>
    <hr />

    <div class="row">
        @forelse($posts as $post)
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h4 class="card-title">{{ $post->title }}</h4>
                    <p class="card-text text-muted">
                        {{ Str::limit(strip_tags($post->content), 100) }}
                    </p>
                    <a href="{{ route('blogs.show', $post->slug) }}" class="btn btn-sm btn-primary">Read More</a>
                </div>
                <div class="card-footer text-muted small">
                    Published on {{ $post->created_at->format('M d, Y') }}
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                No blogs available yet.
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection