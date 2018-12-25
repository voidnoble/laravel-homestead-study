@extends('layouts.master')

@section('content')
    <div class="page-header">
        <a class="btn btn-primary pull-right" href="{{ route('articles.create') }}">
            {!! icon('forum') !!} {{ trans('forum.create') }}
        </a>
        ...
    </div>

    <div class="row container__forum">
        <div class="col-md-3 sidebar__forum">
            <aside>
                @include('layouts.partial.search')
                @include('tags.partial.index')
            </aside>
        </div>

        <div class="col-md-9">
            <article>
                @forelse($articles as $article)
                    @include('articles.partial.article', ['article' => $article])
                @empty
                    <p class="text-center text-danger">{{ trans('errors.not_found_description') }}</p>
                @endforelse

                <div class="text-center">
                    {!! $articles->appends(Request::except('page'))->render() !!}
                </div>
            </article>
        </div>

    </div>
@stop