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
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                @include('shared/feed')

                <div style="text-align: center;">
                    <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">了解更多？</a>
                </div>
            </div>
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
