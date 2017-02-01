@extends('layouts.default')
@section('title', '图片编辑')

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>图片编辑</h5>
            </div>
            <div class="panel-body">
                @include('shared.errors')

                <form method="POST" action="{{ route('images.update', $image->id )}}">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name">名称：</label>
                        <input type="text" name="name" class="form-control" value="{{ $image->path }}">
                    </div>

                    <button type="submit" class="btn btn-primary">更新</button>
                </form>
            </div>
        </div>
    </div>
@stop