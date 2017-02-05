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
                <button id="SubmitAll" class="btn btn-primary">点击上传所有图片</button>
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

        Dropzone.options.dropzone = {
            paramName: "image",
            maxFilesize: 2,
            acceptedFiles: ".jpg,.png,.gif,.bmp",
            dictDefaultMessage: '<h3>拖动文件至此即可上传</h3>',
            autoProcessQueue: false,
            init: function() {
                var submitButton = document.querySelector("#SubmitAll");
                myDropzone = this; // closure

                submitButton.addEventListener("click", function() {
                    myDropzone.processQueue(); // Tell Dropzone to process all queued files.
                });

                this.on("success", function(file, result) {
                    file.previewTemplate.appendChild(document.createTextNode(result.message));
                });
            }
        };
    </script>
@stop
