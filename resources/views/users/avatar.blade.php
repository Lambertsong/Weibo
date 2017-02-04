@extends('layouts.avatar')
@section('title', '更新头像')

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>更新头像</h5>
            </div>
            <div class="panel-body">
                @include('shared.errors')

                @if($user->avatar)
                    <div id="info">
                        <img src="{{ route('images.show', $user->avatar) }}" id="img">

                        <form method="POST" action="{{ route('images.update', $user->avatar) }}">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <input type="hidden" id="x" name="x" />
                            <input type="hidden" id="y" name="y" />
                            <input type="hidden" id="w" name="w" />
                            <input type="hidden" id="h" name="h" />

                            <br><br>
                            <button type="submit" class="btn btn-primary">裁剪图片</button>
                            <button type="button" class="btn btn-primary btn-info" id="changeAvatar">更换图像</button>
                        </form>
                    </div>
                @else
                    <form method="POST" action="{{ route('avatar.post', $user->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="file" name="image" class="dz-file-preview">
                        <button type="submit" class="btn btn-primary">上传头像</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@stop
