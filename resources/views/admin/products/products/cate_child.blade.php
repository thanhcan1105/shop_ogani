@foreach ($cate_child as $cate)
    @if ($cate->parentCategory != null && $cate->parent_id == $cate->parentCategory->id)
        <option value="{{ $cate->id }}">-{{ $cate->name }}</option>
    @endif
@endforeach
