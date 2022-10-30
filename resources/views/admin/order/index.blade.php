@extends('admin.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            {{-- # --}}
            <div class="tableDiv">
                <h1>Đơn đặt hàng({{ count($orders) }})</h1>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            {{-- <th>Địa chỉ</th> --}}
                            <th style="width: 90px" colspan="2">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($orders) >= 1)
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->full_name }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td><a class="addProduct" href="order/detail/order-{{ $order->id }}" style="color: #ffffff;"><i
                                        class="fas fa-info-circle"></i>Chi tiết</a></td>

                                    <td>

                                        <form method="POST" action="/ogani-admin/order/delete/{{ $order->id }}"
                                            onsubmit="return ConfirmDelete( this )">
                                            @method('DELETE')
                                            @csrf
                                            <a class="color" href=""><i class="fas fa-window-close">Xóa</i></a>
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
@stop
