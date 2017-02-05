@extends('layouts.default')
@section('title', '更新头像')

@section('css')
    <link rel="stylesheet" href="/css/jquery.Jcrop.css">
    <link rel="stylesheet" href="/css/dropzone.css">
@stop

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

@section('js')
    <script src="/js/jquery.Jcrop.js"></script>
    <script src="/js/dropzone.js"></script>
    <script type="text/javascript">
        $(function() {
            $('#img').Jcrop({
                aspectRatio: 1,
                onSelect: updateCoords
            });
        });

        function updateCoords(c) {
            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#w').val(c.w);
            $('#h').val(c.h);
        }

        function checkCoords() {
            if (parseInt($('#w').val())) return true;
            alert('Please select a crop region then press submit.');
            return false;
        }

        $("#changeAvatar").click(function () {
            document.getElementById('info').innerHTML =
                    '<form method="POST" action="{{ route('avatar.post', $user->id) }}" enctype="multipart/form-data">' +
                    '{{ csrf_field() }}' +
                    '<input type="file" name="image" class="dz-file-preview" id="image">' +
                    '<button type="submit" class="btn btn-primary">更改头像</button>' +
                    '</form>';
        });
    </script>
@stop
