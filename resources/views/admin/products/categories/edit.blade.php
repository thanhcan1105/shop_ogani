@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Thêm danh mục sản phẩm</h3>
            </div>

            <form action="{{ url('ogani-admin/categories/edit' . '/' . $category->slug) }}" method="POST">
                @method('POST')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Tên danh mục</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}">
                        @error('name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="categories">Thuộc danh mục</label>
                        <select class="form-control select2" style="width: 100%;" name="parent_id">
                            <option value="0">Không có</option>
                            @foreach ($categories as $cat)
                                <option @if($category->parent_id == $cat->id) selected @endif  value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
        </form>
    </div>
@stop
