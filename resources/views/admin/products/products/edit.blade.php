{{-- <form action="{{ url('admin/products/edit'.'/'. $product->slug) }}" method="POST">
    @method('POST')
    @csrf
    <div>
        <input type="text" name="name" value="{{ $product->name }}">
    </div>
    <button type="submit">Sua</button>
</form> --}}

@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Sửa sản phẩm</h3>
            </div>

            <form action="{{ url('admin/products/edit'.'/'. $product->slug) }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
                        @error('name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Giá</label>
                        <input type="number" class="form-control" name="price" value="{{ $product->price }}" required>
                        @error('name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <input type="text" class="form-control" name="description" required>
                        @error('description')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Nội dung</label>
                        <textarea id="summernote" name="content" required></textarea>
                        @error('content')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Hình ảnh</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" id="image">
                                <label class="custom-file-label" for="selectImage">Chọn hình</label>
                            </div>
                            {{-- <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div> --}}
                        </div>
                        @error('image')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="categories">Danh mục</label>
                        <select class="form-control select2" style="width: 100%;" name="category_id">
                            <option selected="selected" disabled>Chọn danh mục</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
    @stop
