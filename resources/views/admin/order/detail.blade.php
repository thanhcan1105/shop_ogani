@extends('admin.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        {{-- ------------------------------------------------------------------------------------------------------------------------------ --}}
        <!-- Main content -->
        <section class="content">
            {{-- # --}}
            {{-- @dd($category->slug) --}}

            <div class="container-fluid style">
                    <h3 class="title">Thông tin</h3>
                    @foreach ($order as $o)
                        <div>Tên: {{ $o->full_name }}</div>
                        <div>Điện thoại: {{ $o->phone }}</div>
                        <div>Email: {{ $o->email }}</div>
                        <div>Địa chỉ: {{ $o->address }}, {{ $o->ward->_name }}, {{ $o->district->_name }},
                            {{ $o->province->_name }}</div>
                    @endforeach
                    <br>
                    <div>Đơn hàng đã đặt:</div>
                    <hr>
                    <table class="table-striped center">
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Ghi chú</th>
                            <th>Ngày đặt hàng</th>
                        </tr>
                        @php
                            $total = 0;
                        @endphp
                        @dd($product_list)
                        @foreach ($product_list as $prod)
                            {{-- @php
                                $total += $prod->product[price] * $prod->quantity;
                            @endphp --}}
                            <tr>
                                <td>{{ $prod->product->name }}</td>
                                <td>{{ $prod->quantity }}</td>
                                <td>{{ number_format($prod->product->price * $prod->quantity) }}đ</td>
                                <td>{{ $prod->order->note }}</td>
                                <td>{{ $prod->updated_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                    <hr>
                    <h5 style="text-align: right;"><span class="total">Tổng cộng: </span>
                        {{ number_format($total) }}đ</h5>
            </div>
            <div style="width: 100%;">
                <button class="checked"><a href="products/add" style="color: #ffffff;"><i
                            class="fas fa-check"></i>Xác nhận</a></button>
                {{-- <input class="addProduct" type="button" value="Thêm sản phẩm"> --}}
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script')
    <style>
        .style {
            background-color: #ffffff;
            width: 90%;
            min-height: 500px;
        }

        .title {
            text-align: center;
        }

        .img {
            width: 100%;
        }

        .edit {
            float: right;
            background-color: #00e600;
        }

        .center {
            width: 100%;
        }

        .total {
            font-weight: bold;
        }

        .checked {
            float: right;
            background-color: #00e600;
        }

    </style>
@endsection
