<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{csrf_token()}}" />

    <title>@yield('title', 'Sample App')</title>

    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/wangEditor.css">
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

<script src="/js/app.js"></script>
<script src="/js/wangEditor.js"></script>
<script type="text/javascript">
    var editor = new wangEditor('content');

    editor.config.uploadImgUrl = '/images/upload';

    editor.create();
</script>
</body>
</html>