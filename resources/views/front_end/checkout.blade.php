@if ($carts)
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
                            <h2>Checkout</h2>
                            <div class="breadcrumb__option">
                                <a href="./index.html">Home</a>
                                <span>Checkout</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->

        <!-- Checkout Section Begin -->
        <section class="checkout spad">
            <div class="container">
                <div class="row">
                    {{-- <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div> --}}
                </div>
                <div class="checkout__form">
                    <h4>Thông tin thanh toán</h4>
                    <form action="{{ route('order') }}" method="POST">
                        @method("POST")
                        @csrf
                        <div class="row">
                            <div class="col-lg-8 col-md-6">
                                <div class="checkout__input">
                                    <p>1. Thông tin người mua:<span>*</span></p>
                                    <input type="text" name="full_name" placeholder="Họ và tên" style="margin-bottom: 20px">
                                    <input type="number" name="phone" placeholder="Số điện thoại"
                                        style="margin-bottom: 20px">
                                    <input type="text" name="email" placeholder="Địa chỉ email">
                                </div>
                                <div class="checkout__input">
                                    <p>2. Địa chỉ:<span>*</span></p>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <select class="form-control" name="provinces" id="provinces">
                                                <option value="" disabled selected>Tỉnh/Thành phố</option>
                                                @foreach ($provinces as $key => $province)
                                                    <option value="{{ $province->id }}">{{ $province->_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <select class="form-control" name="districts" id="districts"
                                                disabled="disabled">
                                                <option value="" disabled selected>Quận/Huyện</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="wards" id="wards" disabled>
                                            <option value="" disabled selected>Xã/Phường/Thị trấn</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="address" id="address" placeholder="Số nhà, tên đường*">
                                    </div>
                                </div>
                                <div class="checkout__input">
                                    <p>Ghi chú</p>
                                    <input type="text_aria" name="note"
                                        placeholder="Notes about your order, e.g. special notes for delivery.">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="checkout__order">
                                    <h4>Đơn hàng của bạn</h4>
                                    <table class="table-striped">
                                        <tr>
                                            <th style="width: 70%">Sản phẩm</th>
                                            <th>Đơn giá</th>
                                        </tr>
                                        @foreach ($carts as $key => $cart)
                                            <tr>
                                                <input type="hidden" name="product_id[]" value="{{ $cart['id'] }}">
                                                <input type="hidden" name="quantity[]" value="{{ $cart['quantity'] }}">
                                                <td>{{ $cart['name'] }} (x{{ $cart['quantity'] }})</td>
                                                <td>{{ number_format($cart['price'] * $cart['quantity']) }}đ</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    <div class="checkout__order__total">Tổng tiền <span>{{ number_format($total) }}
                                            đ</span>
                                    </div>
                                    <button type="submit" class="site-btn">Thanh toán</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- Checkout Section End -->
    @endsection
    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#provinces').change(function() {
                    $('#districts').removeAttr("disabled");
                    $('#wards').html("<option value disabled selected>Xã/Phường/Thị trấn</option>");
                    var id = $("#provinces option:selected").val();
                    $.ajax({
                        type: "GET",
                        url: "/checkout/district",
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            if (data.code === 200) {
                                $('#districts').html(data.select_district);
                            }
                        }
                    });
                });
                $('#districts').change(function() {
                    $('#wards').removeAttr("disabled")
                    var id = $("#districts option:selected").val();
                    $.ajax({
                        type: "GET",
                        url: "/checkout/ward",
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            if (data.code === 200) {
                                $('#wards').html(data.select_ward);
                            }
                        }
                    });
                });
            });
        </script>
    @endsection
@else
    @include('front_end.cart')
@endif
