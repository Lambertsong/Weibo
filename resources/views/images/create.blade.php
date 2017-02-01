@extends('layouts.default')
@section('title', '上传图片')

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>上传图片</h5>
            </div>
            <div class="panel-body">
                @include('shared.errors')

                <form method="POST" action="{{ route('images.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name">图片：</label>
                        <input type="file" name="image">
                    </div>

                    <button type="submit" class="btn btn-primary">上传</button>
                </form>
            </div>
        </div>
    </div>
@stop
