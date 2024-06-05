@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-10 offset-lg-1">
            @if ($errors->any())
                <x-alert :errors="$errors" />
            @endif
        </div>
    </div>
    <div class="row justify-content-center ">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    TAGS
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 offset-lg-10 ">
                            <a class="btn btn-primary btn-lg btn-block float-end" href="{{ route('tag.create') }}">Create</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col" colspan="2">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>{!! $tag->id!!}</td>
                                        <td>{!! $tag->name !!}</td>
                                        <td>
                                            @auth()
                                                <a href="{{ route('tag.edit', [$tag]) }}">Edit</a>
                                            @endif
                                        </td>
                                        <td>
                                            @auth()
                                                <form action="{{ route('tag.delete', [$tag]) }}" method="post">
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
                                {{$tags->onEachSide(5)->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
