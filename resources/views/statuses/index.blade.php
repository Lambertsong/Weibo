@extends('layouts.default')
@section('title', '我的动态')

@section('css')
    <link rel="stylesheet" href="/css/wangEditor.css">
@stop

@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="col-md-12">
                <h3>我的动态</h3>
                @if (count($statuses) > 0)
                    <ol class="statuses">
                        @foreach ($statuses as $status)
                            @include('statuses._status')
                        @endforeach
                    </ol>
                    {!! $statuses->render() !!}
                @endif
            </div>
        </div>
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
