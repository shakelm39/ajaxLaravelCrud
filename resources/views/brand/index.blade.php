@extends('layouts.master')
@section('content')
<div class="row mb-5 mt-5">
    <div class="col-md-6 offset-3">
        <div class="card">
            <div class="card-header">
                <p>Add Brand</p>
            </div>
            <div class="card-body">
                <div id="errorMsg"></div>
                <form action="" method="post" id="brandFrom">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Brand Name</label>
                        <input type="text" name="name" id="brand_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="button" id="brandBtn" class="btn btn-primary">Add Brand</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3>Brand List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <th>Sl</th>
                        <th>Brand Name</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="tbody">
                        @foreach($brands as $key=> $brand)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$brand->name}}</td>
                            <td>
                                <button 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editModal"
                                    data-id = "{{$brand->id}}"
                                    data-name = "{{$brand->name}}" class="btn btn-sm btn-success editBtn" type="button" >Edit</button>
                                <button data-id = "{{$brand->id}}" class="btn btn-sm btn-danger deleteBtn" type="button" >Delte</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal  Start-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModal">Update Brand</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <form action="" method="POST" id="editbrandFrom">
                            @csrf
                            <div class="errorMsg"></div>
                            <input type="hidden" id="up_brand_id">
                            <div class="mb-3">
                                <label for="name" class="form-label">Brand Name</label>
                                <input type="text" class="form-control" name="up_brand_name" id="up_brand_name">
                            </div>
                            
                            <button type="submit" class="btn btn-primary" id="upBrandBtn">Update Brand</button>
                        
                        </form>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
@endsection