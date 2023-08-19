@extends('layouts.master')
@section('content')
<div class="row mb-5 mt-5">
    <div class="col-md-8 offset-2">
        <div class="card">
            <div class="card-header">
                <p id="addproducttitle">Add Product</p>
                <p id="updateproducttitle">Update Product</p>
            </div>
            <div class="card-body">
                <div id="errorMsg"></div>
                <!-- data add form  -->
                <form action="" method="post" id="ProductFrom" enctype="multipart/form-data">
                     @csrf
                    <div class ="row">
                        <div class="form-group mb-3 col-md-6">
                            <label for="productName">Product Name</label>
                            <input type="text" name="productName" id="productName" class="form-control">
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label for="brandName">Brand Name</label>
                            <input type="text" name="brandName" id="brandName" class="form-control">
                        </div>
                    </div>
                    <div class ="row">
                        <div class="form-group mb-3 col-md-6">
                            <label for="categoryName">Category Name</label>
                            <input type="text" name="categoryName" id="categoryName" class="form-control">
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label for="image">Product Image</label>
                            <input type="file" name="file" id="imageFile" class="form-control">
                        </div>
                    </div>
                
                    <div class="form-group">
                        <button type="submit" id="addProductBtn" class="btn btn-primary">Add Product</button>
                    </div>
                </form>
                <!-- update form  -->
                <form action="" method="post" id="ProductUpdateFrom" enctype="multipart/form-data">
                     @csrf
                    <div class ="row">
                        <input type="hidden" id="updateId" name="updateId">
                        <div class="form-group mb-3 col-md-6">
                            <label for="productName">Product Name</label>
                            <input type="text" name="productName" id="updateproductName" class="form-control">
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label for="brandName">Brand Name</label>
                            <input type="text" name="brandName" id="updatebrandName" class="form-control">
                        </div>
                    </div>
                    <div class ="row">
                        <div class="form-group mb-3 col-md-6">
                            <label for="categoryName">Category Name</label>
                            <input type="text" name="categoryName" id="updatecategoryName" class="form-control">
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label for="image">Product Image</label>
                            <input type="file" name="file"  class="form-control">
                            
                        </div>
                    </div>
                
                    <div class="form-group">
                        <button type="submit" id="updateProductBtn" class="btn btn-primary">Upade Product</button>
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
                <h3>Product List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <th>Sl</th>
                        <th>Brand Name</th>
                        <th>Category Name</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="tbody">
                        @foreach ($products as $key=> $product)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$product->brandName}}</td>
                                <td>{{$product->categoryName}}</td>
                                <td>{{$product->productName}}</td>
                                <td>
                                    <img src="{{asset('images/'.$product->image)}}" alt="" width="120px" height="80px">
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-success productEditBtn" data-id="{{$product->id}}">Edit</a>
                                    <a class="btn btn-sm btn-danger productDeleteBtn" data-id="{{$product->id}}" >Delete</a>
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
    <div class="modal fade" id="productEditModal" tabindex="-1" aria-labelledby="productEditModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="productEditModal">Update Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <form action="" method="POST" id="editProductFrom" enctype="multipart/form-data">
                            @csrf
                            <div class="errorMsg"></div>
                            <input type="hidden" id="up_product_id">
                            <div class="mb-3">
                                <label for="up_brand_name" class="form-label">Brand Name</label>
                                <input type="text" class="form-control" name="up_brand_name" id="up_brand_name">
                            </div>
                            
                            <button type="submit" class="btn btn-primary" id="upBrandBtn">Update Product</button>
                        
                        </form>
                    </div>
                </div>
            
            </div>
        </div>
    </div>


    <script type="text/javascript">
       
        $(document).ready(function(){
            $('#ProductUpdateFrom').hide();
            $('#updateproducttitle').hide();

            // ajax add request
            $('#ProductFrom').submit(function(e) {
                e.preventDefault();
    
                var formData = new FormData(this);
    
                $.ajax({
                    type:'POST',
                    url: "{{ route('products.store') }}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();
                        alert('File has been uploaded successfully');
                        location.reload();
                    },
                    error: function(data){
                        alert('field must not be empty');
                    }
                });
            });

  // ajax Edit request 

            $('.productEditBtn').on('click',function(){
                $('#addproducttitle').hide();
                $('#updateproducttitle').show();
                $('#ProductUpdateFrom').show();
                $('#ProductFrom').hide();

                var id = $(this).data('id');
                
                $.ajax({
                    url: "{{route('products.edit')}}",
                    type: 'GET',
                    data:{id:id},
                    success:function(res){
                        if(res){
                            
                            $('#updateId').val(res.data.id);
                            $('#updateproductName').val(res.data.productName);
                            $('#updatebrandName').val(res.data.brandName);
                            $('#updatecategoryName').val(res.data.categoryName);
                            
                        }
                    }
                });


               

                
            })

        //ajax update request   

        $('#ProductUpdateFrom').submit(function (e){
            e.preventDefault();
            var updateId = $(this).val('updateId');
            var updateFrom = new FormData(this);

                $.ajax({
                    type:'POST',
                    url: "{{ route('products.update') }}",
                    data: updateFrom,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();
                        alert('File has been updated successfully');
                        console.log(data);
                        location.reload();
                    },
                    error: function(data){
                        alert('field must not be empty');
                    }
                });

        });
            // ajax delete request 

            $(document).on('click','.productDeleteBtn', function(e){
                e.preventDefault();
                var id = $(this).data('id');
                var confirmation = confirm("are you sure you want to remove the item?");
               if(confirmation){
                    $.ajax({
                        url:"{{route('products.delete')}}",
                        type: 'get',
                        data:{id:id},
                        success: function(data){
                            location.reload();
                        }
                    })
               }
            } )


        });
        
    </script>
@endsection