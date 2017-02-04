@extends('layouts.status')

@section('content')
    @if (Auth::check())
        <div class="row">
            <div class="col-md-8">
                <section class="status_form">
                    @if(isset($status))
                        @include('shared.status_edit')
                    @else
                        @include('shared.status_create')
                    @endif
                </section>
            </div>
            <aside class="col-md-4">
                <section class="user_info">
                    @include('shared.user_info', ['user' => Auth::user()])
                </section>
                <section class="stats">
                    @include('shared.stats', ['user' => Auth::user()])
                </section>
            </aside>
        </div>
    @endif
@stop