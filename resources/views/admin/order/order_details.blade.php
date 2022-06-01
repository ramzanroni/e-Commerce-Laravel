@extends('admin.admin_layouts')
@section('orders') active @endsection
@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <span class="breadcrumb-item active">Dashboard</span>
      <span class="breadcrumb-item active">Order View</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row">
            <div class="card pd-20 pd-sm-40  mt-4">
                <h6 class="card-body-title">Shipping Address</h6>
      
                <div class="form-layout">
                  <div class="row mg-b-25">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label">Firstname: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="firstname" value="{{ $shipping['shipping_first_name'] }}" placeholder="Enter firstname">
                      </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label">Lastname: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="lastname" value="{{ $shipping['shipping_last_name'] }}" placeholder="Enter lastname">
                      </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label">Email address: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="email" value="{{ $shipping['shipping_email'] }}" placeholder="Enter email address">
                      </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Phone Number: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="email" value="{{ $shipping['shipping_phone'] }}" placeholder="Enter email address">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Shipping Address: <span class="tx-danger">*</span></label>
                          <textarea class="form-control" id="" rows="3">{{ $shipping['address'] }}</textarea>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">State: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="email" value="{{ $shipping['state'] }}" placeholder="Enter email address">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Post Code: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="email" value="{{ $shipping['post_code'] }}" placeholder="Enter email address">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Phone Number: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="email" value="{{ $shipping['shipping_phone'] }}" placeholder="Enter email address">
                        </div>
                    </div><!-- col-4 -->
                </div><!-- form-layout -->
              </div><!-- card -->
            </div>
            <div class="card pd-20 pd-sm-40  mt-4">
                <h6 class="card-body-title">Order Details</h6>
      
                <div class="form-layout">
                  <div class="row mg-b-25">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label">Invoice No: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="firstname" value="{{ $order['invoice_no'] }}">
                      </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label">Payment Type: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="lastname" value="{{ $order['payment_type'] }}" placeholder="Enter lastname">
                      </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label">Total: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="email" value="{{ $order['total'] }}" >
                      </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Sub Total: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="email" value="{{ $order['subtotal'] }}" placeholder="Enter email address">
                        </div>
                    </div><!-- col-4 -->
                    @if ($order['coupon_discount'] != null)
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Coupon Discount: <span class="tx-danger">*</span></label>
                          <input class="form-control" id="" value="{{ $order['coupon_discount'] }}">
                        </div>
                    </div><!-- col-4 -->                        
                    @endif
                </div><!-- form-layout -->
              </div><!-- card -->
            </div>
            <div class="card pd-20 pd-sm-40 mt-4" >
                <h6 class="card-body-title">Product Info</h6>
      
                <div class="form-layout">
                  <div class="row mg-b-25">
                    <div class="col-lg-12">
                      <table class="table table-hover table-striped">
                          <thead>
                              <tr>
                                  <th>Image</th>
                                  <th>Product Name</th>
                                  <th>Quantity</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($orderItems as $item)
                                  <tr>
                                    <td>
                                        <img src="{{ asset($item->product->product_img_1) }}" alt="" width="10%">
                                    </td>
                                    <td>{{ $item->product->product_name }}</td>
                                  
                                    <td>{{ $item->product_qty }}</td>
                                </tr>
                              @endforeach
                          </tbody>
                      </table>
                    </div>
              </div><!-- card -->
            </div>
        </div>
    </div>
</div>
@endsection