<form action="{{ route('status.store') }}" method="POST">
    @include('shared.errors')
    {{ csrf_field() }}
    <textarea class="form-control" rows="12" name="content" id="content">{{ old('content') }}</textarea>
    <br>
    <button type="submit" class="btn btn-primary pull-right">发布</button>
</form>