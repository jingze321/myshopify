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
</style>





    <div class="d-flex container">
        <div class="row " style="margin-top:50px">
            <div class="col-md-auto" >
                    <a class="btn btn-dark" href="/mystore/products/"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                    <h5 class="d-inline-block mt-4" style="margin-left:2rem">Add Product</h5>
            </div>
        </div>
    </div>
    
    <form action="{{ route('product.data',[$Store->store_name]) }}"name="demoform" id="demoform" method="post"  enctype="multipart/form-data">
    @csrf
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
    <div class="container ">
        <div class="row  justify-content-end" style="margin:2rem">

        <!-- row1 -->
            <!-- column 1 -->
            <div class="col-md-7 rounded bg-warning p-2" >
                <div class="col-md-11  m-auto " >

                        <input type="text" class="form-control col-6" id="store_id" name="store_id" value="{{$Store->id}}" style="display:none"></input>


                    <div class="form-group" >
                        <label for="title"> Title </label>
                        <input type="text" class="form-control col-6" name="title" placeholder="Enter Title"></input>
                        <span class="text danger"> @error('title') {{$message}} @enderror </span>
                    </div>
                    <div class="form-group" >
                        <label for="description"> Description </label>
                        
                        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                        
                        <span class="text danger"> @error('description') {{$message}} @enderror </span>
                    </div>
                </div>
                <!-- column 2 -->
                <div class="col-md-12 rounded bg-warning p-2" >
                    <div class="col-md-11  m-auto " >
                        <div class="form-group">
                        <label for="media"> Media </label>

                                <div id="dropzoneDragArea" class="dz-default dz-message dropzoneDragArea">
                                    <span>Upload file</span>
                                    <div class="dropzone-previews"></div>
                                </div>
                        </div>
                    </div>
                </div>
                <!-- column 3 -->
                <div class="col-md-11  m-auto  ">
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

                <div align="end">
                    <button id="submit-all" type="submit" class="btn btn-block btn-primary">Add Product</button>
                </div>

            </div>

            

        <!-- row2 -->
            <div class="col-md-4 p-1 ">
                <div class="col-md-12 rounded m-auto bg-success " >
                    <label for="status"> Product Status </label>
                    <select id="status" name="status" class="form-select" aria-label="Default select example">
                        <option value="active" selected>Active</option>
                        <option value="draft">Draft</option>

                    </select>
                    <span class="text danger"> @error('email') {{$message}} @enderror </span>
                </div> 
            </div>
            
    </div>
    </form>




<script src="{{ URL::asset('js/variant.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/dropzone.js') }}" type="text/javascript"></script>



@stop

