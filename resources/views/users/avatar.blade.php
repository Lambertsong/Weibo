@extends('layouts.default')
@section('title', '更新头像')

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>更新头像</h5>
            </div>
            <div class="panel-body">
                @include('shared.errors')

                <form method="POST" action="{{ route('avatar.post') }}">
                    {{ csrf_field() }}

                    <img src="{{ route('') }}"

                    <button type="submit" class="btn btn-primary">提交</button>
                </form>
            </div>
        </div>
    </div>
@stop
