@extends('admin.admin_layouts')
@section('brand') active @endsection
@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <span class="breadcrumb-item active">Dashboard</span>
      <span class="breadcrumb-item active">Brand</span>
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
                    <h6 class="card-body-title">Brand</h6>
          
                    <div class="table-wrapper">
                      <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                          <tr>
                            <th class="wd-15p">SL</th>
                            <th class="wd-15p">Brand Name</th>
                            <th class="wd-20p">Status</th>
                            <th class="wd-15p">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                            @php
                                $sl=1;
                            @endphp
                            @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td>{{ $brand['brand_name'] }}</td>
                                <td>
                                  @if ($brand['status']==1)
                                  <span class="badge badge-primary">Active</span>

                                  @else
                                  <span class="badge badge-warning">Deactive</span>
                                  @endif
                                </td>
                                <td>
                                  <a href="/admin/brand/edit/{{ $brand['id'] }}" class="btn btn-sm btn-primary">Edit</a>
                                  <a href="/admin/brand/delete/{{ $brand['id'] }}"" class="btn btn-sm btn-danger">Delete</i></a>
                                  @if ($brand['status']==1)
                                  <a href="/admin/brand/deactive/{{ $brand['id'] }}"" class="btn btn-sm btn-info">Deactive</i></a>
                                  @else
                                  <a href="/admin/brand/active/{{ $brand['id'] }}"" class="btn btn-sm btn-info">Active</i></a>
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
                    <div class="card-header">Add Brand</div>
                    <div class="card-body">
                      <form action="/admin/add_brand" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Brand Name</label>
                            <input type="text" class="form-control @error('brand_name') is-invalid @enderror" id="brand_name" name="brand_name" placeholder="Enter Category"> 
                            @error('brand_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection