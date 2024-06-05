@extends('layouts.app')
@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    ARTICLE DETAIL
                </div>
                @if($article->image_url)
                    <div class="text-center">
                        <img style="max-height: 200px; max-width: 200px;" src="{{ asset('storage/' . $article->image_url) }}" class="card-img-top text-center" alt="image">
                    </div>
                @endif
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        {{ $article->category->name ?? '' }}
                    </h6>
                    <p class="card-text">{{ $article->content }}</p>
                    <a  href="{{route('article.list')}}" class="btn btn-primary">Go back</a>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($article->tags as $tag)
                        <li class="list-group-item">{{ $tag->name }}</li>
                    @endforeach
                </ul>
                <div class="card-footer">
                    <small class="text-muted">created at {{ $article->created_at }}</small>
                </div>
            </div>
        </div>
    </div>




</div>
@endsection
