@extends("layouts.app")
@section("content")
<div class="container">
    <div class="card mb-2"> <div class="card-body">
        <h5 class="card-title">{{ $book->name }}</h5> <div class="card-subtitle mb-2 text-muted small">
        {{ $book->created_at->diffForHumans() }}
        </div>
        <p class="card-text">{{ $book->description }}</p>
        <a class="btn btn-info" href="/books"> Back </a>
        <a class="btn btn-danger float-right" href=""> Review </a>

    </div>
</div>

@endsection
