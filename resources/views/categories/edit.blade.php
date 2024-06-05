@extends('layouts.app')
@section('content')
    <div class="row justify-content-center ">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    EDIT CATEGORY
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
                            <form method="POST" action="{{ route('category.update', [$category]) }}">
                                {{ method_field("PUT") }}
                                @csrf
                                <div class="form-group">
                                    <label for="title">Name:</label><br>
                                    <input class="form-control" type="text" id="name" name="name" maxlength="10" value="{{ $category->name }}" required><br>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Send">
                                    <a href="{{route('category.list')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

