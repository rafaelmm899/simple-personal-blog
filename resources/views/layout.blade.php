@php use Illuminate\Support\Facades\Auth; @endphp
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .container {
            margin-top: 10%;
        }
    </style>
</head>
<body>
<header>
    <h1>Simple Personal Blog</h1>
    <nav>
        <a href="{{route('article.list')}}">Home</a>
        @auth()
            <a href="{{route('article.create')}}">Create Article</a>
        @endif
        <a href="{{route('about-me')}}">About me</a>
        <a href="{{route('category.list')}}">Categories</a>
        <a href="{{route('tag.list')}}">Tags</a>
        @auth()
            <form method="POST" action="{{route('logout')}}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{route('register')}}">Register</a>
            <a href="{{route('login')}}">Login</a>
        @endif
    </nav>
</header>
<div class="container">
    @yield('content')
</div>
</body>
</html>
