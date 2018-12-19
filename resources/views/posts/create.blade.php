@extends('master')

@section('content')
    <h1>New post</h1>
    <hr>
    <form action="/posts" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div>
            <label for="title">Title :</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}">
            {!! $errors->first('title', '<span>:message</span>') !!}
        </div>

        <div>
            <label for="body">Body :</label>
            <textarea name="body" id="body" value="{{ old('body') }}">{{ old('body') }}</textarea>
            {!! $errors->first('body', '<span>:message</span>') !!}
        </div>

        <div>
            <button type="submit">Create new post</button>
        </div>
    </form>
@endsection