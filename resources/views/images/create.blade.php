@extends('layouts.image')
@section('title', '上传图片')

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
                <button id="SubmitAll" class="btn btn-primary">点击上传所有图片</button>
            </div>
        </div>
    </div>
@stop
