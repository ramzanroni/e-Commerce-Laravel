@extends('admin.admin_layouts')
@section('orders') active @endsection
@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <span class="breadcrumb-item active">Dashboard</span>
      <span class="breadcrumb-item active">Orders</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row">
            <div class="col-md-12 float-left">
              @if (session('success'))
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
              
              <div class="card pd-20 pd-sm-40">
                    <h6 class="card-body-title">Orders</h6>
          
                    <div class="table-wrapper">
                      <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                          <tr>
                            <th class="wd-15p">SL</th>
                            <th class="wd-15p">Invoice Number</th>
                            <th class="wd-15p">Payment Method</th>
                            <th class="wd-20p">Total</th>
                            <th class="wd-20p">Sub Total</th>
                            <th class="wd-20p">Order Time</th>
                            <th class="wd-20p">Discount</th>
                            <th class="wd-15p">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                            @php
                                $sl=1;
                            @endphp
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td>{{ $order['invoice_no'] }}</td>
                                <td>{{ $order['payment_type'] }}</td>
                                <td>{{ $order['total'] }}</td>
                                <td>{{ $order['subtotal'] }}</td>
                                <td>{{ $order['created_at'] }}</td>
                                <td>
                                  @if ($order['coupon_discount']!=null)
                                  <span class="badge badge-primary">Active</span>

                                  @else
                                  <span class="badge badge-warning">Deactive</span>
                                  @endif
                                </td>
                                <td>
                                  <a href="/admin/order/view/{{ $order['id'] }}" class="btn btn-sm btn-primary">View</a>
                                  <a href="/admin/coupon/delete/{{ $order['id'] }}"" class="btn btn-sm btn-danger">Delete</i></a>
                                  @if ($order['status']==1)
                                  <a href="/admin/coupon/deactive/{{ $order['id'] }}"" class="btn btn-sm btn-info">Deactive</i></a>
                                  @else
                                  <a href="/admin/coupon/active/{{ $order['id'] }}"" class="btn btn-sm btn-info">Active</i></a>
                                  @endif
                                </td>
                              </tr>
                            @endforeach
                          
                        </tbody>
                      </table>
                    </div><!-- table-wrapper -->
                  </div><!-- card -->
            </div>
        </div>
    </div>
</div>
@endsection