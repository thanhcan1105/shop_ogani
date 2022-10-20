@extends('admin.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    {{-- <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col --> --}}
                    {{-- <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div><!-- /.col --> --}}
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            {{-- # --}}
            <div class="tableDiv">
                <h1>Sản phẩm</h1>
                <hr>
                <div style="width: 100%;">
                    <button class="add"><a href="products/add" style="color: #ffffff;"><i
                                class="fas fa-plus"></i>Thêm sản phẩm</a></button>
                    {{-- <input class="add" type="button" value="Thêm sản phẩm"> --}}
                </div>
                <table class="table table-striped">
                    <tr>
                        <th>Mã sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Loại sản phẩm</th>
                        <th>Chi tiết</th>
                        <th>Xóa</th>
                    </tr>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if ($product->image == null)
                                    <img src="{{ '/upload/no_image.png' }}" alt="{{ $product->name }}">
                                @else
                                    <img src="{{ '/upload/' . $product->image }}" alt="{{ $product->name }}">
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->price) }}đ</td>
                            <td>{{ $product->nameCategory }}</td>
                            <td><a class="color" href="products/detail/{{ $product->slug }}"><i
                                        class="fas fa-info-circle"></i></a></td>
                            <td>
                                <form method="POST" action="/admin/products/delete/{{ $product->id }}"
                                    onsubmit="return ConfirmDelete( this )">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit">Delete</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </table>
                @if (count($products) >= 1)
                    {{ $products->links() }}
                @endif

            </div>
            <hr>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('script')
    <style>
        th {
            /* text-align: center; */
            background-color: #808080;
        }

        div.tableDiv {
            min-height: 500px;
            width: 100%;
            background-color: #e6e5e5;
        }

        .add {
            float: right;
            background-color: #00e600;
        }

        a.color {
            cursor: default;
            text-decoration: none;
            color: black;
        }

        img {
            width: 100px;
        }

    </style>
@endsection
