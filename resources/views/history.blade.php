@extends('template')

@section('title', '送信履歴｜社会の窓通知サービス')

@section('content')
<div class="container">
@if (count($inquiries)>0)
<h2>送信履歴</h2>
<table class="table">
  <tr>
    <th>ID</th>
    <th>お名前</th>
    <th>メールアドレス</th>
    <th>関係</th>
    <th>何か伝えたいこと</th>
    <th>送信日時</th>
  </tr>
  @foreach ($inquiries as $inquiry)
    <tr>
      <th>{{$inquiry->id}}</th>
      <th>{{$inquiry->name}}</th>
      <th>{{$inquiry->email}}</th>
      <th>{{$inquiry->relationship}}</th>
      <th>{!!nl2br(e($inquiry->content))!!}</th>
      <th>{{$inquiry->created_at}}</th>
    </tr>
  @endforeach
</table>
{{-- paginateメソッドのページャーを表示 --}}
{{$inquiries->links()}}
@endsection
@else
<h2>送信履歴はありません</h2>
</div>
@endif