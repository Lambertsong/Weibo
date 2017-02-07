@extends('layouts.default')
@section('title', '图片库')

@section('content')
    <div>
        <h1>我的图片</h1>
        <div>
            @foreach ($images as $image)
                @include('images._image')
            @endforeach
        </div>

        {!! $images->render() !!}
    </div>
@stop

@section('js')
    <script src="/js/layer/layer.js"></script>
    <script src="/js/dialog.js"></script>
@stop
