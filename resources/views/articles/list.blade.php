@extends('layouts.app')
@section('content')
    <div class="row justify-content-center ">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    ARTICLES
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 offset-lg-10 ">
                            <a class="btn btn-primary btn-lg btn-block float-end" href="{{ route('article.create') }}">Create</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Updated At</th>
                                    <th scope="col" colspan="3">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($articles as $article)
                                    <tr>
                                        <td>{!! \Illuminate\Support\Str::of($article->title)->limit(50) !!}</td>
                                        <td>{!! $article->category?->name !!}</td>
                                        <td>{!! $article->createdAt()->toDateTimeLocalString() !!}</td>
                                        <td>{!! $article->updatedAt()->toDateTimeLocalString() !!}</td>
                                        <td><a class="btn btn-link" href="{{ route('article.detail', $article) }}">Detail</a></td>
                                        <td>
                                            @auth()
                                                <a class="btn btn-link" href="{{ route('article.edit', $article) }}">Edit</a>
                                            @endif
                                        </td>
                                        <td>
                                            @auth()
                                                <form action="{{ route('article.delete', [$article]) }}" method="post">
                                                    @method("DELETE")
                                                    @csrf
                                                    <button class="btn btn-link" type="submit">Delete</button>
                                                </form>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{$articles->onEachSide(5)->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
