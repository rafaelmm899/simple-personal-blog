@extends('layouts.app')
@section('content')
    <div class="row justify-content-center ">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    EDIT ARTICLE
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('article.update', [$article]) }}" enctype="multipart/form-data">
                                {{ method_field("PUT") }}
                                @csrf
                                <div class="form-group">
                                    <label for="title">Title:</label><br>
                                    <input class="form-control" type="text" id="title" name="title" required value="{{ $article->title }}"><br>
                                </div>
                                <div class="form-group">
                                    <label for="content">Content:</label><br>
                                    <textarea class="form-control" id="content" name="content" rows="4" cols="50" required>{{ $article->content }}</textarea><br>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category:</label><br>
                                    <select class="form-control" id="category" name="category" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @selected($category->id === $article->category_id)>{{ $category->name }}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image:</label><br>
                                    <input class="form-control" type="file" id="image" name="image" accept="image/*"><br>
                                </div>
                                <div class="form-group">
                                    <label for="tags">Tags:</label><br>
                                    <select class="form-control" id="tags" name="tags[]" multiple required>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}" @selected(in_array($tag->id, $article->tags->pluck('id')->toArray()))>{{ $tag->name }}</option>
                                        @endforeach
                                    </select><br>
                                </div>
                                <div class="form-group">

                                    <input type="submit" class="btn btn-primary" value="Enviar">
                                    <a href="{{route('article.list')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
