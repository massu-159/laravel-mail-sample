<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BasicAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // 認証用ユーザー名・パスが送信されてこない時、dieメソッドを呼び出す
        if (! isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
            $this->die();
        }
        // .envのユーザー名・パスと一致しない時、dieメソッドを呼び出す
        if ($_SERVER['PHP_AUTH_USER']!== env('BASIC_USER')||$_SERVER['PHP_AUTH_PW']!== env('BASIC_PASS')) {
            $this->die();
        }
        return $next($request);
    }

    protected function die(){
        // WWW-Authenticateヘッダを出力
        header('WWW-Authenticate: Basic realm="Enter username and password."');
        // ステータスコード表示
        abort(401);
    }
}
