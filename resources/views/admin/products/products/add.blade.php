@extends('admin.layout')
@section('style')
    <link href="{{ asset('adminlte/plugins/dropzone/min/dropzone.min.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Thêm sản phẩm</h3>
            </div>
            <form action="{{ route('products.add') }}" enctype="multipart/form-data" method="POST" class="dropzone">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name" placeholder="Nhập tên" required>
                        @error('name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Giá</label>
                        <input type="number" class="form-control" name="price" placeholder="Giá" required>
                        @error('name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <input type="text" class="form-control" name="description" placeholder="Nhập mô tả" value=""
                            required>
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
                        <label for="avatar">Hình ảnh</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="avatar" id="avatar" required>
                                <label class="custom-file-label" for="selectImage">Chọn hình</label>
                            </div>
                            @error('avatar')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" multiple="true" name="image[]" id="image"
                                    required>
                                <label class="custom-file-label" for="selectImage">Chọn một hoặc nhiều hình</label>
                            </div>
                        </div>
                        @error('image')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="categories">Danh mục</label>
                        <select class="form-control select2" style="width: 100%;" name="category_id" required>
                            <option selected="selected" disabled>Chọn danh mục</option>
                            @foreach ($categories as $category)
                                @if ($category->parent_id == 0)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @foreach ($cate_child as $cate)
                                        @if ($cate->parentCategory != null && $cate->parent_id == $category->id)
                                            <option value="{{ $cate->id }}">--{{ $cate->name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                        @error('category_id')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm</button>
        </div>
        </form>
    </div>

    </div>
@stop
@section('script')
    <script href="{{ asset('adminlte/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script>
        Dropzone.option.imageUpload = {
            maxFilesSize: 1,
            acceptedFiles: ".jpg,.jpeg,.png,.gif",

        }
    </script>
@endsection
