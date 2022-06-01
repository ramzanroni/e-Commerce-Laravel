@extends('admin.admin_layouts')
@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <span class="breadcrumb-item active">Category</span>
      <span class="breadcrumb-item active">Edit</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="card">
                    <div class="card-header">Add Category</div>
                    <div class="card-body">
                      <form action="/admin/update_category" method="POST">
                        @csrf
                        <input type="text" name="id" hidden value="{{ $category_data['id'] }}">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name" value="{{ $category_data['category_name'] }}" placeholder="Enter Category"> 
                            @error('category_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        <button type="submit" class="btn btn-primary">Update Category</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection