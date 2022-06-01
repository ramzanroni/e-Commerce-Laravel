@extends('layouts.front_master')
@section('font_content')
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All Categorys</span>
                    </div>
                    <ul>
                        @php
                        $categories=App\Models\Category::where('status',1)->latest()->get();
                    @endphp
                    @foreach ($categories as $category)
                    <li><a href="#">{{ $category->category_name }}</a></li>
                    @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('fontend') }}/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shopping Cart</h2>
                    <div class="breadcrumb__option">
                        <a href="/">Home</a>
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
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    @if (session('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                    @endif
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($carts as $item)
                                
                            
                            <tr>
                                <td class="shoping__cart__item">
                                    <img style="height: 70px; width: 70px;" src="{{ asset($item->product->product_img_1) }}" alt="">
                                    <h5>{{ $item->product->product_name }}</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    ${{ $item->price }}
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <form action="/update_product_quantity/{{ $item->id }}" method="POST">
                                            @csrf
                                            <div class="pro-qty">
                                                <input type="text" name="item_quantity" value="{{ $item->qty }}" min="1">
                                            </div>
                                            <input type="submit" class="btn btn-sm btn-success" value="Update">
                                        </form>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    ${{ $item->qty*$item->price }}
                                </td>
                                <td class="shoping__cart__item__close">
                                    <a href="/cart_item_delete/{{ $item->id }}"><i class="fas fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="/" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    {{-- <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                        Upadate Cart</a> --}}
                </div>
            </div>

            <div class="col-lg-6">
            @if (Session::has('coupon'))
            <div class="shoping__discount">
                <h5>Applied Coupon Code Successfully</h5>
            </div>
            @else
            
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>
                        <form action="/coupon-apply" method="POST">
                            @csrf
                            <input type="text" name="coupon_name" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">APPLY COUPON</button>
                        </form>
                    </div>
                </div>
            
            @endif
                
        </div>

            
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        @if (Session::has('coupon'))
                        <li>Subtotal <span>${{ $subtotal }}</span></li>
                        <li>Coupon <span>{{ session()->get('coupon')['coupon_name'] }} <a href="/cart/remove-coupon"><i class="fas fa-times btn btn-sm btn-danger"></i></a></span></li>
                        <li>Discount <span>${{ session()->get('coupon')['coupon_discount'] }}%({{ session()->get('coupon')['coupon_amount'] }} tk )</span></li>
                        
                        <li>Total <span>${{ $subtotal-session()->get('coupon')['coupon_amount'] }}</span></li>
                        @else
                        <li>Total <span>${{ $subtotal }}</span></li>
                        @endif
                        
                    </ul>
                    <a href="/checkout" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection