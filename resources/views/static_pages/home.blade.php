@extends('layouts.default')

@section('css')
    <link rel="stylesheet" href="/css/wangEditor.css">
@stop

@section('content')
    @if (Auth::check())
        <div class="row">
            <div class="col-md-8">
                <h3>微博列表</h3>
                @include('shared/feed')
            </div>
            <aside class="col-md-4">
                <section class="user_info">
                    @include('shared.user_info', ['user' => Auth::user()])
                </section>
                <section class="stats">
                    @include('shared.stats', ['user' => Auth::user()])
                </section>
            </aside>
        </div>
    @else
        <div class="jumbotron">
            <h1>Hello dear users~</h1>
            <p class="lead">
                你现在所看到的是 <a href="https://github.com/d4smart/Weibo">Weibo</a> 的项目主页。
            </p>
            <p>
                一切，将从这里开始。
            </p>
            <p>
                <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">现在注册</a>
            </p>
        </div>
    @endif
@stop

@section('js')
    <script src="/js/wangEditor.js"></script>
    <script src="/js/editors.js"></script>
    <script src="/js/comment.js"></script>
    <script src="/js/layer/layer.js"></script>
    <script src="/js/dialog.js"></script>
    <script src="/js/init.js"></script>
@stop
