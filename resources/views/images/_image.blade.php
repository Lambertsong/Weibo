<div class="col-md-3">
    <div class="thumbnail">
        <img src="{{ route('images.show', $image->id) }}" class="rec-image" alt="image-{{ $image->id }}">

        <button type="button" class="btn btn-sm btn-default" onclick="window.location.href='{{ route('images.show', $image->id) }}'">查看图片</button>
        @can('update', $image)
            <button type="button" class="btn btn-sm btn-info" onclick="window.location.href='{{ route('images.edit', $image->id) }}'">修改</button>
        @endcan
        @can('destroy', $image)
            <form action="{{ route('images.destroy', $image->id) }}" class="inline_form" method="POST" id="image-{{ $image->id }}-delete">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="button" class="btn btn-sm btn-danger image-delete-button" onclick="submitForm('image-{{ $image->id }}-delete', '确定删除这个图片吗？')">删除</button>
            </form>
        @endcan
    </div>
</div>