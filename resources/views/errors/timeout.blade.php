@extends('navbar.nav')

@section('title', 'Timeout Error')

@section('content')
<div class="container text-center py-5">
    <h2>⚠️ Request Timed Out</h2>
    <p>Your request took too long to complete. Please try again.</p>
    <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">← Go Back</a>
</div>
@endsection