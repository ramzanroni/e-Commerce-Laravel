@extends('admin.admin_layouts')
@section('coupon') active @endsection
@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <span class="breadcrumb-item active">Dashboard</span>
      <span class="breadcrumb-item active">Coupon</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row">
            <div class="col-md-8 float-left">
              @if (session('success'))
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
              
              <div class="card pd-20 pd-sm-40">
                    <h6 class="card-body-title">Coupon</h6>
          
                    <div class="table-wrapper">
                      <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                          <tr>
                            <th class="wd-15p">SL</th>
                            <th class="wd-15p">Coupon Name</th>
                            <th class="wd-15p">Discount</th>
                            <th class="wd-20p">Status</th>
                            <th class="wd-15p">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                            @php
                                $sl=1;
                            @endphp
                            @foreach ($coupons as $coupon)
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td>{{ $coupon['coupon_name'] }}</td>
                                <td>{{ $coupon['discount'] }}</td>
                                <td>
                                  @if ($coupon['status']==1)
                                  <span class="badge badge-primary">Active</span>

                                  @else
                                  <span class="badge badge-warning">Deactive</span>
                                  @endif
                                </td>
                                <td>
                                  <a href="/admin/coupon/edit/{{ $coupon['id'] }}" class="btn btn-sm btn-primary">Edit</a>
                                  <a href="/admin/coupon/delete/{{ $coupon['id'] }}"" class="btn btn-sm btn-danger">Delete</i></a>
                                  @if ($coupon['status']==1)
                                  <a href="/admin/coupon/deactive/{{ $coupon['id'] }}"" class="btn btn-sm btn-info">Deactive</i></a>
                                  @else
                                  <a href="/admin/coupon/active/{{ $coupon['id'] }}"" class="btn btn-sm btn-info">Active</i></a>
                                  @endif
                                </td>
                              </tr>
                            @endforeach
                          
                        </tbody>
                      </table>
                    </div><!-- table-wrapper -->
                  </div><!-- card -->
            </div>
            <div class="col-md-4 float-left">
                <div class="card">
                    <div class="card-header">Add Coupon</div>
                    <div class="card-body">
                      <form action="/admin/add_coupon" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Coupon Name</label>
                            <input type="text" class="form-control @error('coupon_name') is-invalid @enderror" id="coupon_name" name="coupon_name" placeholder="Enter Coupon Name"> 
                            @error('coupon_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label>Discount</label>
                            <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" placeholder="Enter Discount"> 
                            @error('discount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        <button type="submit" class="btn btn-primary">Add Coupon</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection