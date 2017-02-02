<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Sample App')</title>

    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/jquery.Jcrop.css">

    <script src="/js/app.js"></script>
    <script src="/js/jquery.Jcrop.js"></script>
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
        };

        function checkCoords() {
            if (parseInt($('#w').val())) return true;
            alert('Please select a crop region then press submit.');
            return false;
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