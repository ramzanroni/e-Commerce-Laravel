@extends('admin.admin_layouts')
@section('coupon') active @endsection
@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <span class="breadcrumb-item active">Coupon</span>
      <span class="breadcrumb-item active">Edit</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="card">
                    <div class="card-header">Update Coupon</div>
                    <div class="card-body">
                      <form action="/admin/update_coupon" method="POST">
                        @csrf
                        <input type="text" name="id" hidden value="{{ $coupons['id'] }}">
                        <div class="form-group">
                            <label>Coupon Name</label>
                            <input type="text" class="form-control @error('coupon_name') is-invalid @enderror" id="coupon_name" name="coupon_name" value="{{ $coupons['coupon_name'] }}" placeholder="Enter Coupon Name"> 
                            @error('coupon_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label>Discount</label>
                            <input type="text" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" value="{{ $coupons['discount'] }}" placeholder="Enter discount"> 
                            @error('discount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        <button type="submit" class="btn btn-primary">Update Coupon</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection