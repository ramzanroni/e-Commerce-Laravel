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
                            <span>Orders</span>
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
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ $order->invoice_no }}</td>
                                        <td>{{ $order->subtotal }}</td>
                                        <td>{{ $order->total }}</td>
                                        <td>{{ $order->payment_type }}</td>
                                        <td>
                                            <a href="user/order-view/{{ $order->id }}" class="btn btn-sm btn-danger">View</a>
                                        </td>
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
