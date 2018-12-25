@extends('layouts.master')

@section('content')
    <div class="page-header">
        ...
    </div>

    <div class="container__forum">
        <form action="{{ route('articles.store') }}" method="post" role="form" class="form__forum">
            {!! csrf_field() !!}

            @include('articles.partial.form')

            <div class="form-group">
                <p class="text-center">
                    <a href="{{ route('articles.create') }}" class="btn btn-default">
                        {!! icon('reset') !!} Reset
                    </a>
                    <button type="submit" class="btn btn-primary my-submit">
                        {!! icon('plane') !!} Post
                    </button>
                </p>
            </div>
        </form>
    </div>
@stop