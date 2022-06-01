
@extends('layouts.front_master')
@section('font_content')
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('fontend') }}/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
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
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="place-order" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input class="@error('shipping_first_name') is-invalid @enderror" type="text" name="shipping_first_name" value="{{ Auth::user()->name }}">
                                        @error('shipping_first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input class="@error('shipping_last_name') is-invalid @enderror" type="text" name="shipping_last_name">
                                        @error('shipping_last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add @error('address') is-invalid @enderror" name="address">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input class="@error('state') is-invalid @enderror" type="text" name="state">
                                @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input class="@error('post_code') is-invalid @enderror" type="text" name="post_code">
                                @error('post_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input class="@error('shipping_phone') is-invalid @enderror" type="text" name="shipping_phone">
                                        @error('shipping_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" class="@error('shipping_email') is-invalid @enderror" name="shipping_email" value="{{ Auth::user()->email }}">
                                        @error('shipping_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @foreach ($carts as $item)
                                    <li>{{ $item->product->product_name }}({{ $item->qty }}) <span>${{ $item->qty*$item->price }}</span></li>
                                    @endforeach
                                </ul>
                                
                                @if (Session::has('coupon'))
                                <div class="checkout__order__total">Total <span>${{ $subtotal-session()->get('coupon')['coupon_amount'] }}</span></div>
                                <input type="text" hidden name="subtotal" value="{{ $subtotal }}">
                                <input type="text" hidden name="total" value="{{ $subtotal-session()->get('coupon')['coupon_amount'] }}">
                                <input type="text" hidden name="coupon_discount" value="{{ session()->get('coupon')['coupon_discount'] }}">
                                @else
                                <div class="checkout__order__subtotal">Subtotal <span>${{ $subtotal }}</span></div>
                                <input type="text" hidden name="subtotal" value="{{ $subtotal }}">
                                <input type="text" hidden name="total" value="{{ $subtotal }}">
                                @endif
                                <h5 class="m-2">Select Payment Method</h5>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Cash On Delivery
                                        <input type="checkbox" id="payment" value="Cash On Delivery" name="payment_type">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal" name="payment_type">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection