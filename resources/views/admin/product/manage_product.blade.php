@extends('admin.admin_layouts')
@section('add_product')
    active show-sub
@endsection
@section('manage_product')
    active
@endsection
@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <span class="breadcrumb-item active">Dashboard</span>
      <span class="breadcrumb-item active">Manage Product</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row">
            <div class="col-md-12 float-left"> 
              <div class="card pd-20 pd-sm-40">
                    <h6 class="card-body-title">Product</h6>
          
                    <div class="table-wrapper" >
                    @if (session('success'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                      {{ session('success') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @endif
                      <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                          <tr>
                            <th class="wd-15p">SL</th>
                            <th class="wd-15p">Image</th>
                            <th class="wd-20p">Product Name</th>
                            <th class="wd-15p">Price</th>
                            <th class="wd-15p">Quantity</th>
                            <th class="wd-15p">Category</th>
                            <th class="wd-15p">Brand</th>
                            <th class="wd-15p">Status</th>
                            <th class="wd-15p">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                            @php
                                $sl=1;
                            @endphp
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td><img src="{{ asset($product['product_img_1']) }}" width="50px" height="50px" alt="Product Image"></td>
                                <td>{{ $product['product_name'] }}</td>
                                <td>{{ $product['price'] }}</td>
                                <td>{{ $product['product_quantity'] }}</td>
                                <td>{{ $product['category']->category_name }}</td>
                                <td>{{ $product['brand']->brand_name }}</td>
                                <td>
                                  @if ($product['status']==1)
                                  <span class="badge badge-primary">Active</span>

                                  @else
                                  <span class="badge badge-warning">Deactive</span>
                                  @endif
                                </td>
                                <td>
                                  <a href="/admin/product/edit/{{ $product['id'] }}" class="btn btn-sm btn-primary">Edit</a>
                                  <a href="/admin/product/delete/{{ $product['id'] }}"" class="btn btn-sm btn-danger">Delete</i></a>
                                  @if ($product['status']==1)
                                  <a href="/admin/product/deactive/{{ $product['id'] }}"" class="btn btn-sm btn-info">Deactive</i></a>
                                  @else
                                  <a href="/admin/product/active/{{ $product['id'] }}"" class="btn btn-sm btn-info">Active</i></a>
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