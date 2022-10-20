@extends('front_end.layout')
@section('content')
    <style>
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

    </style>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('front_end/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row cart" data-url="{{ route('deleteCart') }}">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table class="table update_cart_url" data-url="{{ route('updateCart') }}">
                            <thead>
                                <tr>
                                    <th class="shoping__product" style="width: 40%">Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th style="width: 15%">Tổng</th>
                                    <th>Hành động</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="update_cart">
                                @php
                                    $total = 0;
                                    $qty = 0;
                                @endphp
                                @if ($carts)
                                    @foreach ($carts as $id => $cart)
                                        @php
                                            $total += $cart['price'] * $cart['quantity'];
                                            $qty += $cart['quantity'];
                                        @endphp
                                        <tr id='cart-{{ $cart['id'] }}'>
                                            {{-- <input type="hidden" value="{{ $cart['id'] }}"> --}}
                                            <td class="shoping__cart__item">
                                                <img src="{{ '/upload/' . $cart['image'] }}" alt="" style="width: 10%">
                                                <h5>{{ $cart['name'] }}</h5>
                                            </td>
                                            <td class="shoping__cart__price">
                                                {{ number_format($cart['price']) }} đ
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input class="quantity" type="number"
                                                            value="{{ $cart['quantity'] }}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="shoping__cart__total">
                                                {{ number_format($cart['price'] * $cart['quantity']) }} đ
                                            </td>
                                            <td><a href="" class="btn btn-primary cart-update"
                                                    data-id="{{ $cart['id'] }}">Cập
                                                    nhật</a></td>
                                            <td class="shoping__cart__item__close">
                                                <a href="" class="delete-cart" data-id="{{ $cart['id'] }}"><span
                                                        class="icon_close"></a></span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>Giỏ hàng rỗng</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="/" class="primary-btn cart-btn">TIẾP TỤC MUA SẮM</a>
                        {{-- <a href="" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Cập nhật giỏ hàng</a> --}}
                    </div>
                </div>
                <div class="col-lg-6">
                    {{-- <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div> --}}
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <ul>
                            {{-- <li>Subtotal <span>$454.98</span></li> --}}
                            <li>Tổng giỏ hàng: <span class="total">{{ number_format($total) }} đ</span></li>
                        </ul>
                        <ul class="checkoutbtn">
                            <a href="/checkout" class="primary-btn">Thanh toán</a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

            function cartUpdate(event) {
                event.preventDefault();
                let urlUpdateCart = $('.update_cart_url').data('url');
                let id = $(this).data('id');
                let quantity = $(this).parents('tr').find('input.quantity').val();
                var self = this;
                $.ajax({
                    type: "GET",
                    url: urlUpdateCart,
                    data: {
                        id: id,
                        quantity: quantity
                    },
                    success: function(data) {
                        data.cart_update.forEach(element => {
                            var cart_id = (element.cart_id);
                            $('#cart-' + cart_id).find('.quantity').val(element.quantity);
                            $('#cart-' + cart_id).find('.shoping__cart__total').html(element
                                .total_price);
                            $('.total').html(data.total);
                            $('.qty').html(data.qty);
                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "preventDuplicates": true,
                                "onclick": null,
                                "showDuration": "100",
                                "hideDuration": "1000",
                                "timeOut": "3000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "show",
                                "hideMethod": "hide"
                            };
                            toastr.success(data.message);
                        });
                    },
                });
            }

            function cartDelete(e) {
                e.preventDefault();
                let urlDeleteCart = $('.cart').data('url');
                let id = $(this).data('id');
                var self = this;
                $.ajax({
                    type: "GET",
                    url: urlDeleteCart,
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        $('#cart-' + id).remove();
                        $('.total').html(data.total);
                        $('.qty').html(data.qty);
                        if (data.qty == 0) {
                            $('.update_cart_url').find('.update_cart').html(
                                '<tr><td>Giỏ hàng rỗng</td></tr>');
                            $('.shoping-cart').find('.checkoutbtn').html(
                                '<a href="#" class="primary-btn">Thanh toán</a>')
                        };
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "preventDuplicates": true,
                            "onclick": null,
                            "showDuration": "100",
                            "hideDuration": "1000",
                            "timeOut": "3000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "show",
                            "hideMethod": "hide"
                        };
                        toastr.success(data.message);
                    },
                });
            }

            $(function() {
                $(document).on('click', '.cart-update', cartUpdate);
                $(document).on('click', '.delete-cart', cartDelete);
            });
        });
    </script>
@endsection
