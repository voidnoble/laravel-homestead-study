<?php

namespace App\Http\Middleware;

use App\Article;
use Closure;

class CanAccessArticle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        $articleId = $request->route('articles');

        if (!Article::whereId($articleId)->whereAuthorId($user->id)->exists() and !$user->isAdmin()) {
            flash()->error(trans('errors.forbidden') .":". trans('errors.forbidden_description'));

            return back();
        }

        return $next($request);
    }
}
