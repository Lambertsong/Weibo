<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Sample App')</title>

    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/jquery.Jcrop.css">
    <link rel="stylesheet" href="/css/dropzone.css">

    <script src="/js/app.js"></script>
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
            dictDefaultMessage: '<h3>Drop files here or click to upload.</h3>',
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
</head>
<body>
@include('layouts._header')

<div class="container">
    <div class="col-md-offset-1 col-md-10">
        @include('shared.messages')
        @yield('content')
        @include('layouts._footer')
    </div>
</div>

</body>
</html>