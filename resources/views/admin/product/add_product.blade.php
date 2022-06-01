@extends('admin.admin_layouts')
@section('add_product')
    active show-sub
@endsection
@section('add_product_sub')
    active
@endsection
@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <span class="breadcrumb-item active">Dashboard</span>
      <span class="breadcrumb-item active">Add product</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Add Product</h6>      
                <div class="form-layout">
                  @if (session('success'))
                  <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                 @endif
                  <form action="/admin/store_product" method="POST" enctype="multipart/form-data">
                    @csrf
                  <div class="row mg-b-25">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="product_name" value="{{ old('product_name') }}" placeholder="Enter Product Name">
                        @error('product_name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                      </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="product_code" value="{{ old('product_code') }}" placeholder="Enter Product Code">
                        @error('product_code')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                      </div>
                    </div><!-- col-4 -->
                    
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label">Price: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="price" value="{{ old('price') }}" placeholder="Enter Product Price">
                        @error('price')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                      </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Product Quantity: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="number" name="product_quantity" value="{{ old('product_quantity') }}"  placeholder="Enter Product Quantity">
                        @error('product_quantity')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                      </div>
                    </div><!-- col-8 -->
                    <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                        <select class="form-control select2" data-placeholder="Choose Category" name="category_id">
                          <option label="Choose Product Category"></option>
                          @foreach ($categories as $category)
                              <option value="{{ $category['id'] }}">{{ $category['category_name'] }}</option>
                          @endforeach
                        </select>
                        @error('category_id')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                      </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                          <select class="form-control select2" data-placeholder="Choose Brand" name="brand_id">
                            <option label="Choose Product Brand"></option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                            @endforeach
                          </select>
                          @error('brand_id')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        </div>
                      </div><!-- col-4 -->
                      <div class="col-lg-12">
                          <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Sort Description: <span class="tx-danger">*</span></label>
                              <textarea name="sort_description" id="sort_description" value="{{ old('sort_description') }}"></textarea>
                              @error('sort_description')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                          </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Long Description: <span class="tx-danger">*</span></label>
                            <textarea name="long_description" id="long_description"  value="{{ old('long_description') }}"></textarea>
                            @error('long_description')
                            <strong class="text-danger">{{ $message }}</strong>
                             @enderror
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Thambnil Image: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="file" name="product_image_1" value="{{ old('product_image_1') }}" >
                          @error('product_image_1')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Extra Image(1): <span class="tx-danger">*</span></label>
                          <input class="form-control" type="file" name="product_image_2" value="{{ old('product_image_2') }}">
                          @error('product_image_2')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Extra Image(2): <span class="tx-danger">*</span></label>
                          <input class="form-control" type="file" name="product_image_3" value="{{ old('product_image_3') }}">
                          @error('product_image_3')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        </div>
                      </div>
                      <div class="form-layout-footer">
                        <input type="submit" class="btn btn-info mg-r-5" value="Add Product">
                      </div><!-- form-layout-footer -->
                    </form>
                  </div><!-- row -->
      
                  
                </div><!-- form-layout -->
              </div><!-- card -->
        </div>
    </div>
</div>



@endsection