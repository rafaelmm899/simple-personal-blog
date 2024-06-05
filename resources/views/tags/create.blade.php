@extends('layouts.app')
@section('content')
    <div class="row justify-content-center ">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    CREATE TAG
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if ($errors->any())
                                <x-alert :errors="$errors" />
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('tag.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Name:</label><br>
                                    <input class="form-control" type="text" maxlength="10" id="name" name="name"><br>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Send">
                                    <a href="{{route('tag.list')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

