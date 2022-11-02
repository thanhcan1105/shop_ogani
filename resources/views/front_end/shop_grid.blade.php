@extends('front_end.layout')
@section('content')
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('front_end/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shop Grid</h2>
                        <div class="breadcrumb__option">
                            <a href="./">Home</a>
                            <span>Shop Grid</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Department</h4>
                            <ul>
                                @foreach ($categories_parent as $category)
                                    <div class="dropdown">
                                        <li class="dropbtn">{{ $category->name }}</li>
                                        @foreach ($category->subCategories as $subCat)
                                            @if ($subCat->count() > 0)
                                                <div class="dropdown-content" style="width: 100%">
                                                    <a href="./{{ $subCat->slug }}" class="btn dropchild"> -- {{ $subCat->name }}</a>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <section class="">
                        <div class="container">
                            @foreach ($cate as $cat)
                                <div class="row" style="padding-bottom: 30px">
                                    <div class="col-lg-12">
                                        <div class="">
                                            <h2>{{ $cat->name }}</h2>
                                        </div>
                                    </div>
                                </div>
                                @if ($cat->products->count() > 0)
                                    <div class="row">
                                        @foreach ($cat->products as $product)
                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                <div class="product__item">
                                                    <meta name="_token" content="{{ csrf_token() }}">
                                                    <div class="product__item__pic set-bg" data-setbg="{{ '/upload/' . $product->image }}">
                                                        <ul class="product__item__pic__hover">
                                                            <li><a data-url="{{ route('addToCart', ['id' => $product->id]) }}" class="add_to_cart"><i class="fa fa-shopping-cart"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="product__item__text">
                                                        <h6><a href="/shop-details/{{ $product->slug }}">{{ $product->name }}</a>
                                                        </h6>
                                                        <h5>{{ number_format($product->price) }}đ</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        @foreach ($cat->subCategories as $subCate)
                                            @foreach ($subCate->products as $product)
                                                <div class="col-lg-3 col-md-4 col-sm-6">
                                                    <div class="product__item">
                                                        <meta name="_token" content="{{ csrf_token() }}">
                                                        <div class="product__item__pic set-bg" data-setbg="{{ '/upload/' . $product->image }}">
                                                            <ul class="product__item__pic__hover">
                                                                <li><a data-url="{{ route('addToCart', ['id' => $product->id]) }}" class="add_to_cart"><i class="fa fa-shopping-cart"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="product__item__text">
                                                            <h6><a href="/shop-details/{{ $product->slug }}">{{ $product->name }}</a>
                                                            </h6>
                                                            <h5>{{ number_format($product->price) }}đ</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                @else
                                    <p>Hiện tại chưa có sản phẩm nào trong danh mục này!</p>
                                @endif
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection
