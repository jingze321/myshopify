@extends('layouts.layout')
@section('title',"$Store->store_name Main Page")
@section('content')
<head>

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" integrity="sha512-WvVX1YO12zmsvTpUQV8s7ZU98DnkaAokcciMZJfnNWyNzm7//QRV61t4aEr0WdIa4pe854QHLTV302vH92FSMw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js" integrity="sha512-oQq8uth41D+gIH/NJvSJvVB85MFk1eWpMK6glnkg6I7EdMqC1XVkW7RxLheXwmFdG03qScCM7gKS/Cx3FYt7Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<style>
    	.dropzoneDragArea {
		    background-color: #fbfdff;
		    border: 1px dashed #c0ccda;
		    border-radius: 6px;
		    padding: 60px;
		    text-align: center;
		    margin-bottom: 15px;
		    cursor: pointer;
		}
		.dropzone{
			box-shadow: 0px 2px 20px 0px #f2f2f2;
			border-radius: 10px;
		}

		/* textarea {
			resize: none;
		} */
    </style>



<section class="bg-light mt-5">
        <div class="results">
                    @if(Session::get('success'))
                        <div class="alert alert-success">
                            {{Session::get('success') }}
                        </div>
                    @endif
                    @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{Session::get('fail') }}
                        </div>
                    @endif
        </div>
	<div class="d-flex container">
        <div class="row " >
            <div class="col-md-auto" >
                    <a class="btn btn-dark" href="/mystore/products/"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                    <h5 class="d-inline-block mt-4" style="margin-left:2rem">Add Product</h5>
            </div>
        </div>
    </div>
	
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2">
				<div class="form-wrapper py-5">
					<!-- form starts -->
					<form action="{{ route('product.data',[$Store->store_name]) }}" name="demoform" id="demoform" method="POST" class="dropzone" enctype="multipart/form-data">
						
						@csrf 
						<div class="form-group">
                            <input  type="hidden" class="store_id" name="store_id" id="store_id"  value="{{$Store->id}}">
							
                            <input  type="hidden" class="product_id" name="product_id" id="product_id" value="">
							
							<label for="name">Name</label>
							<input type="text" name="title" id="title" placeholder="Enter Product Name" class="form-control" required autocomplete="off">
						</div>
                        <div class="form-group">
							<label for="picture">Description</label>
							<textarea  type="text" name="description" id="description" rows="4" class="form-control" required autocomplete="off"></textarea>
							
						</div>

						<div class="form-group pt-3">
							<label for="picture">Media</label>

                  			<div id="dropzoneDragArea" class="dz-default dz-message dropzoneDragArea">
                  				<span>Upload file</span>
                                <div class="dropzone-previews"></div>
                  			</div>
                  			
                  		</div>
						  <div class="form-group row">
							<div class="col-sm-6">
								<label for="status"> Product Status </label>
								<select id="status" name="status" class="form-select" aria-label="Default select example">
									<option value="active" selected>Active</option>
									<option value="draft">Draft</option>

								</select>
							</div>
							<div class="col-sm-6">
								<label for="price">Price</label>
								<input type="text" name="price" id="price" placeholder="Enter Price" class="form-control" required autocomplete="off">
							</div>
						</div>
						<div class="form-group pt-3">
						<div class="form-group" >
                        <div class="alert alert-danger show-error-message" style="display:none">
                            <ul></ul>
                        </div>
                        <div class="alert alert-success show-success-message" style="display:none">
                            <ul></ul>
                        </div>
                        <label for="add_variant"> Variants </label>
                        <input class="show-check" type="checkbox" name="coupon_question" value="0" onchange="valueChanged()"/>
                        <table class="table table-bordered option" id="dynamic_field" style="display:none"> 
                            <tr>  
                                <td><input type="text" name="variant[]" placeholder="Enter variant" class="form-control name_list"  id="variant" list="variant"></td>
                                <datalist id="variant">
                                    <option>Size</option>
                                    <option>Title</option>
                                    <option>Color</option>
                                    <option>Material</option>
                                </datalist>
                            
                                <td><input type="text" name="detail[]" placeholder="Enter variant details" class="form-control name_list"  id="detail"></td>  
                                <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                            </tr>  
                        </table> 
                    </div>
                  			
                  		</div>
                  		<div class="form-group">
	        				<button type="submit" class="btn btn-md btn-primary">create</button>
	        			</div>
					</form>
					<!-- form end -->
				</div>
			</div>
		</div>
	</div>
</section>
            

<script src="{{ URL::asset('js/variant.js') }}" type="text/javascript"></script>
        
<!-- <script src="{{ URL::asset('js/dropzone.js') }}" type="text/javascript"></script> -->
<script>
Dropzone.autoDiscover = false;
// Dropzone.options.demoform = false;	
// alert($("#demoform").attr('action'));
var fileList = new Array;
var i = 0;
let token = $('meta[name="csrf-token"]').attr('content');
$(function() {
var myDropzone = new Dropzone("div#dropzoneDragArea", { 
	paramName: "file",
	url: "{{ url('/mystore/products/storeimgae') }}",
	previewsContainer: 'div.dropzone-previews',
	addRemoveLinks: true,
	autoProcessQueue: false,
	uploadMultiple: false,
	parallelUploads: 1,
	maxFiles: 1,
	params: {
        _token: token
    },
	 // The setting up of the dropzone
	init: function() {
	    var myDropzone = this;
	    //form submission code goes here
	    $("form[name='demoform']").submit(function(event) {
	    	//Make sure that the form isn't actully being sent.
	    	event.preventDefault();
	    	URL = $("#demoform").attr('action');
            ///mystore/products/storedata
	    	formData = $('#demoform').serialize();
	    	$.ajax({
	    		type: 'POST',
	    		url: URL,
	    		data: formData,
                
	    		success: function(result){
                    // alert(result)
	    			if(result.status == "success"){
	    				// fetch the useid 
	    				var product_id = result.product_id;
                        // alert('successful='+product_id);
						$("#product_id").val(product_id); 
	    				//process the queue
                        // alert('successful='+product_id);

	    				myDropzone.processQueue();
	    			}else{
	    				console.log("error");
	    			}
                    
	    		},
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }      
 
	    	});
	    });
	    //Gets triggered when we submit the image.
	    this.on('sending', function(file, xhr, formData){
        let product_id = document.getElementById('product_id').value;
		   formData.append('product_id', product_id);
        //    alert(product_id);

		});
		
	    this.on("success", function (file, response) {

            $('#demoform')[0].reset();
            $('.dropzone-previews').empty();
        });

	}
	});
});
</script>




@stop

