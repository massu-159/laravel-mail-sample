@extends('template')

@section('title', '送信内容の確認！社会の窓通知サービス')
@section('content')
<div class="jumbotron">
  <div class="container">
    <h1 class="display-5">送信内容の確認</h1>
    <p class="lead">以下の内容でメールを送信します。<br>内容を確認し、大丈夫そうな場合のみ送信してください。</p>
  </div>
</div>
<div class="container">
  <form action="{{route('confirm')}}" method="post">
    @csrf
    <table class="table table-bordered">
      <tbody>
        <tr>
          <th scope="row">from</th>
          <td>{{config('mail.from.name')}}&lt;{{config('mail.from.address')}}&gt;</td>
        </tr>
        <tr>
          <th scope="row">to</th>
          <td>{{session('inquiry.email')}}</td>
        </tr>
        <tr>
          <th scope="row">件名</th>
          <td>{{session('inquiry.name')}}さんにお知らせがあります</td>
        </tr>
        <tr>
          <th scope="row">本文</th>
          {{-- nl2brはphpの標準関数で、改行をbrタグに変換して出力するものだが、htmlタグを{{ nl2br($message) }}の様にして出力してしまうと
          Laravelのエスケープ機能によって、htmlタグが画面にそのまま表示される。
          これを防ぐため、{!! <変数> !!} というエスケープさせない記法で出力 --}}
          <td>{!!nl2br($message)!!}</td>
        </tr>
      </tbody>
    </table>

    <div class="form-group text-center">
      <button class="btn btn-primary" type="submit">送信する</button>
      <a href="{{route('index')}}" class="btn btn-secondary">戻る</a>
    </div>
  </form>
</div>
@endsection