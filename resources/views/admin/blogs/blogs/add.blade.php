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
            <form action="{{ route('blog.add') }}" enctype="multipart/form-data" method="POST" class>
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Tiêu đề bài viết</label>
                        <input type="text" class="form-control" name="title" placeholder="Nhập tiêu đề" required>
                        @error('title')
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
                        </div>
                        @error('image')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Mô tả</label>
                        <input type="text" class="form-control" name="description" placeholder="Nhập mô tả" required>
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
                        <label for="categories">Danh mục</label>
                        <select class="form-control select2" style="width: 100%;" name="cate_blog_id">
                            <option selected="selected" disabled>Chọn danh mục</option>
                            @foreach ($blog_cate as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('cate_blog_id')
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
    {{-- <script>
        Dropzone.option.imageUpload = {
            maxFilesSize: 1,
            acceptedFiles: ".jpg,.jpeg,.png,.gif",

        }
    </script> --}}
@endsection
