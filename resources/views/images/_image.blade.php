<div class="col-md-3">
    <div class="thumbnail">
        <a href="{{ route('images.show', $image->id) }}" title="{{ $image->id }}">
            <img src="{{ route('images.show', $image->id) }}" class="rec-image">
        </a>

        <p></p>

        <form action="{{ route('images.edit', $image->id) }}" class="inline_form" method="get">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-sm btn-default">修改</button>
        </form>
        <form action="{{ route('images.destroy', $image->id) }}" class="inline_form" method="POST" id="image-{{ $image->id }}-delete">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="button" class="btn btn-sm btn-danger image-delete-button" onclick="submitForm('image-{{ $image->id }}-delete', '确定删除这个图片吗？')">删除</button>
        </form>
    </div>
</div>