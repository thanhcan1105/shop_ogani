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
                <h1>Danh mục sản phẩm({{ count($categories) }})</h1>
                <hr>
                <div style="width: 100%;">
                    <button class="add"><a href="categories/add" style="color: #ffffff;"><i
                                class="fas fa-plus"></i>Thêm sản phẩm</a></button>
                    {{-- <input class="addProduct" type="button" value="Thêm sản phẩm"> --}}
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên danh mục</th>
                            <th>Danh mục cha</th>
                            <th style="width: 90px">Chi tiết</th>
                            <th style="width: 10px">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($categories) >= 1)
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->parentCategory != null ? $category->parentCategory->name : 'Không có'  }}</td>
                                    <td><a class="color" href="categories/detail/{{ $category->slug }}"><i
                                                class="fas fa-info-circle"></i></a></td>

                                    <td>
                                        <form method="POST" action="/admin/categories/delete/{{ $category->id }}"
                                            onsubmit="return ConfirmDelete( this )">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn-dnger">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" style="text-align: center;">Không có dữ liệu</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{-- @if (count($categories) >= 1)
                    {{ $categories->links() }}
                @endif --}}
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
