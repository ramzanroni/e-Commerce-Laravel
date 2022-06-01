@extends('admin.admin_layouts')
@section('category')
    active
@endsection
@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Starlight</a>
      <span class="breadcrumb-item active">Dashboard</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row">
            <div class="col-md-8 float-left">
              @if (session('success'))
              <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
              
              <div class="card pd-20 pd-sm-40">
                    <h6 class="card-body-title">Category</h6>
          
                    <div class="table-wrapper">
                      <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                          <tr>
                            <th class="wd-15p">SL</th>
                            <th class="wd-15p">Category Name</th>
                            <th class="wd-20p">Status</th>
                            <th class="wd-15p">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                            @php
                                $sl=1;
                            @endphp
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td>{{ $category['category_name'] }}</td>
                                <td>
                                  @if ($category['status']==1)
                                  <span class="badge badge-primary">Active</span>

                                  @else
                                  <span class="badge badge-warning">Deactive</span>
                                  @endif
                                </td>
                                <td>
                                  <a href="/admin/category/edit/{{ $category['id'] }}" class="btn btn-sm btn-primary">Edit</a>
                                  <a href="/admin/category/delete/{{ $category['id'] }}"" class="btn btn-sm btn-danger">Delete</i></a>
                                  @if ($category['status']==1)
                                  <a href="/admin/category/deactive/{{ $category['id'] }}"" class="btn btn-sm btn-info">Deactive</i></a>
                                  @else
                                  <a href="/admin/category/active/{{ $category['id'] }}"" class="btn btn-sm btn-info">Active</i></a>
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
                    <div class="card-header">Add Category</div>
                    <div class="card-body">
                      <form action="/admin/add_category" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name" placeholder="Enter Category"> 
                            @error('category_name')
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