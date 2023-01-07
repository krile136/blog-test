<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /**
     * ヘッダーのAccept Languageからユーザーの言語を設定する
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $accept_language = $request->header('Accept-Language');
        $languages = explode(',', $accept_language);
        $base_language = isset($languages[0]) ? substr($languages[0], 0, 2) : 'en';

        App::setLocale($base_language);

        return $next($request);
    }
}
