<script>
    $(document).ready(function(){
        $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
<script>
   $(document).ready(function(){
        $(document).on('click','#brandBtn', function(e){
            e.preventDefault();

            let name = $('#brand_name').val();

            $.ajax({
                url: "{{route('brands.store')}}",
                type: 'POST',
                data: {name: name},
                success: function(res){
                    if(res.status=='success'){
                        $('#brandFrom')[0].reset();
                        $('.table').load(location.href+' .table');
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                            })
                    }
                },error:function(err){
                    let error  = err.responseJSON;
                    $.each(error.errors,function(key,val){
                        $('#errorMsg').append('<span class="text-danger">'+val+'</span>');
                    });
                }
            })

        });

        //Edit function

        $(document).on('click', '.editBtn', function(){
            let id  = $(this).data('id');
            let name  = $(this).data('name');
            //console.log(id,name);

            $('#up_brand_id').val(id);
            $('#up_brand_name').val(name);
        });

// update function 

        $(document).on('click','#upBrandBtn',function(e){
            e.preventDefault();
            let up_brand_id = $('#up_brand_id').val();
            let up_brand_name = $('#up_brand_name').val();

            $.ajax({
                url: "{{route('brands.update')}}",
                type: 'POST',
                data : {up_brand_id:up_brand_id, up_brand_name:up_brand_name},
                success: function(data){
                    if(data.status == 'success'){
                        $('#editModal').modal('hide');
                        $('#editbrandFrom')[0].reset();
                        $('.table').load(location.href+' .table');
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Your work has been updated',
                            showConfirmButton: false,
                            timer: 1500
                            })
                        
                    }
                },error:function(err){
                    let error = err.responseJSON;
                    $.each(error.errors, function(key, val){
                        $('.errorMsg').append('<span class="text-danger">'+val+'</span>');
                    });
                }
            });
        });
//Delete 

        $(document).on('click','.deleteBtn', function(){
            let brand_id = $(this).data('id');
            $.ajax({
                url: "{{route('brands.delete')}}",
                type : 'get',
                data: { brand_id: brand_id},
                success: function(data){
                    if(data.status == 'success'){
                        $('.table').load(location.href+' .table');
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Your work has been deleted',
                            showConfirmButton: false,
                            timer: 1500
                            })
                    }
                }
            })
        });






   });
</script>






<!-- immage upload script  -->
  <!-- <script>
    if($file('image')){
        const reader = new FileReader();
        reader.onload = (e)=>{
            Swal.fire({
                imageUrl:e.target.result,
                imageAlt:'The uploaded picture'
            });
            reader.readAsDataURL(file)
        }
    }
  </script> -->