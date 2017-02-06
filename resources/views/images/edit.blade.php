@extends('layouts.default')
@section('title', '图片编辑')

@section('css')
    <link rel="stylesheet" href="/css/jquery.Jcrop.css">
    <link rel="stylesheet" href="/css/dropzone.css">
@stop

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>图片编辑</h5>
            </div>
            <div class="panel-body">
                @include('shared.errors')

                <img src="{{ route('images.show', $image->id) }}" id="img">
                <br>

                <form method="POST" action="{{ route('images.update', $image->id )}}">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}

                    <input type="hidden" id="x" name="x" />
                    <input type="hidden" id="y" name="y" />
                    <input type="hidden" id="w" name="w" />
                    <input type="hidden" id="h" name="h" />

                    <button type="submit" class="btn btn-primary">裁剪图片</button>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="/js/jquery.Jcrop.js"></script>
    <script src="/js/dropzone.js"></script>
    <script src="/js/init.js"></script>
@stop
