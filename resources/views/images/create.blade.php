@extends('layouts.default')
@section('title', '上传图片')

@section('css')
    <link rel="stylesheet" href="/css/jquery.Jcrop.css">
    <link rel="stylesheet" href="/css/dropzone.css">
@stop

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>上传图片</h5>
            </div>
            <div class="panel-body">
                @include('shared.errors')

                <form method="POST" action="{{ route('images.store') }}" class="dropzone" id="dropzone" enctype="multipart/form-data">
                    {{ csrf_field() }}
                </form>
                <br>
                <button id="SubmitAll" class="btn btn-primary">点击上传图片</button>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="/js/jquery.Jcrop.js"></script>
    <script src="/js/dropzone.js"></script>
    <script src="/js/init.js"></script>
@stop
