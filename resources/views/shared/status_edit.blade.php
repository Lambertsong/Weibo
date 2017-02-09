<form action="{{ route('status.update', $status->id) }}" method="POST">
    @include('shared.errors')
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <textarea class="form-control" rows="12" name="content" id="content">{{ $status->content }}</textarea>
    <br>
    <button type="submit" class="btn btn-primary pull-right">更新</button>
</form>