@extends('layouts.default')
@section('title', '图片库')

@section('content')
    <div>
        <h1>我的图片</h1>
        <ul class="images">
            @foreach ($images as $image)
                @include('images._image')
            @endforeach
        </ul>

        {!! $images->render() !!}
    </div>
@stop