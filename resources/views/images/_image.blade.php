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
        <form action="{{ route('images.destroy', $image->id) }}" class="inline_form" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-sm btn-danger status-delete-btn" onclick="return confirm('确定要删除图片吗？')">删除</button>
        </form>
    </div>
</div>