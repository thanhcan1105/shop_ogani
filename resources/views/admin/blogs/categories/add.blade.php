@extends('admin.layout')
@section('style')
<link href="{{asset('adminlte/plugins/dropzone/min/dropzone.min.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Thêm sản phẩm</h3>
            </div>
            <form action="{{ route('blog_cate.add') }}" enctype="multipart/form-data" method="POST" class="dropzone">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Tiêu đề bài viết</label>
                        <input type="text" class="form-control" name="name" placeholder="Nhập tiêu đề" required>
                        @error('title')
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
    <script href="{{asset('adminlte/plugins/dropzone/min/dropzone.min.js')}}"></script>
    <script>
        Dropzone.option.imageUpload = {
            maxFilesSize : 1,
            acceptedFiles: ".jpg,.jpeg,.png,.gif",

        }
    </script>
@endsection
