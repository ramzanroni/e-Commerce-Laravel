@extends('admin.admin_layouts')
@section('brand') active @endsection
@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <span class="breadcrumb-item active">Brand</span>
      <span class="breadcrumb-item active">Edit</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="card">
                    <div class="card-header">Add Brand</div>
                    <div class="card-body">
                      <form action="/admin/brand_category" method="POST">
                        @csrf
                        <input type="text" name="id" hidden value="{{ $brand_data['id'] }}">
                        <div class="form-group">
                            <label>Brand Name</label>
                            <input type="text" class="form-control @error('brand_name') is-invalid @enderror" id="brand_name" name="brand_name" value="{{ $brand_data['brand_name'] }}" placeholder="Enter Category"> 
                            @error('brand_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        <button type="submit" class="btn btn-primary">Update Brand</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection