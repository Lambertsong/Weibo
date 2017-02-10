@extends('layouts.default')
@section('title', '所有用户')

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <h1>所有用户</h1>
        <ul class="users">
            @foreach ($users as $user)
                @include('users._user')
            @endforeach
        </ul>

        {!! $users->render() !!}
    </div>
@stop

@section('js')
    <script src="/js/wangEditor.js"></script>
    <script src="/js/editors.js"></script>
    <script src="/js/comment.js"></script>
    <script src="/js/layer/layer.js"></script>
    <script src="/js/dialog.js"></script>
    <script src="/js/init.js"></script>
@stop
