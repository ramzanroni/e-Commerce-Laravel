@extends('layouts.front_master')

@section('font_content')
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('fontend') }}/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Orders</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>Order View</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-md-4 float-left">
                    @include('pages.profile.user_menu_sidebar')
                </div>
                <div class="col-md-8 float-left">
                    <div class="card">
                        <div class="card-header">
                            Orders
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover table-sm table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Invoice No</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Payment Type</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ $order->invoice_no }}</td>
                                        <td>{{ $order->subtotal }}</td>
                                        <td>{{ $order->total }}</td>
                                        <td>{{ $order->payment_type }}</td>
                                      </tr>
                                  
                                  
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2 float-left">
                    <div class="card">
                        <div class="card-header">
                            Shipping Address
                        </div>
                        <div class="card-body" style="overflow: scroll;">
                            <table class="table table-striped table-hover table-sm table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">State</th>
                                    <th scope="col">Post Code</th>
                                    <th scope="col">Order Date</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ $shipping->shipping_first_name }}</td>
                                        <td>{{ $shipping->shipping_last_name }}</td>
                                        <td>{{ $shipping->shipping_email }}</td>
                                        <td>{{ $shipping->shipping_phone }}</td>
                                        <td>{{ $shipping->address }}</td>
                                        <td>{{ $shipping->state }}</td>
                                        <td>{{ $shipping->post_code }}</td>
                                        <td>{{ $shipping->created_at }}</td>
                                      </tr>
                                  
                                  
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-2 float-left">
                    <div class="card">
                        <div class="card-header">
                            Products
                        </div>
                        <div class="card-body" style="overflow: scroll;">
                            <table class="table table-striped table-hover table-sm table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Quantity</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_items as $item)
                                        <tr>
                                            <td>
                                                <img width="10%" src="{{ asset($item->product->product_img_1) }}" alt="">
                                            </td>
                                            <td>{{ $item->product->product_name }}</td>
                                            <td>{{ $item->product_qty }}</td>
                                        </tr>
                                      @endforeach
                                  
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
