@extends('layouts.default')
@section('title', '我的动态')
@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="col-md-12">
                <ol class="statuses">
                    @include('statuses._status')
                </ol>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="/js/layer/layer.js"></script>
    <script src="/js/dialog.js"></script>
@stop