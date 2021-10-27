@extends('layouts.layout')
@section('title',"$Store->store_name Main Page")
@section('content')
<?php
    $row=0;
    $products = DB::table('products')
    ->leftjoin('gallery', 'products.product_id', '=', 'gallery.product_id')
    ->where('products.store_id',$Store->id)
    ->get();
// dd($products);

?>
<style>
    .current {
    border-style: solid;
    border-bottom-color: green;
    }
    .has-search .form-control {
    padding-left: 2.375rem;
    }

    .has-search .form-control-feedback {
        position: absolute;
        z-index: 2;
        display: block;
        width: 2.375rem;
        height: 2.375rem;
        line-height: 2.375rem;
        text-align: center;
        pointer-events: none;
        color: #aaa;
    }
</style>

    <div class="container">
        <div class="row ">
            <div class="col-md-12 " style="margin-top:50px">
                <div class="float-start">
                    <h1>Products</h1>
                </div>  
                <div class="float-end">
                <a class="btn btn-success" href="/mystore/products/new">Add Products</a>
                </div>  
            </div>
        </div>
        <div class="row  bg-light" style="margin-top:45px">
                <div class="col-md-12 col-md-offset rounded ">

                    
                    <button class="btn rounded-0 current ">ALL</button>
                    
                    <button class="btn shadow-none">Active</button>

                    <button class="btn shadow-none">{{$Store->store_name}}</button>
                        

                    
                </div>
                <form class="col-md-4 col-md-offset rounded mt-2 p-2" type="get" action="{{url('/mystore/products/search')}}">
                
                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="search" name="query" class="form-control" placeholder="search">
                    </div>
                </form>

                <div class="container mt-5">
                    <div class="row">
                        <div class="col d-flex justify-content-center">
                            @foreach($products as $product)
 
                                <div class="card col-lg-3 mb-2">
                                    <div align=center class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                        <img
                                        src="/uploads/images/{{$product->picture}}"
                                        class="img-fluid"
                                        />
                                        <a href="#!">
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$product->title}}</h5>
                                        <p class="card-text">
                                            {{$product->description}}
                                        </p>
                                        <!-- <a href="#!" class="btn btn-primary">Button</a> -->
                                    </div>
                                </div>
                            @endforeach
                            
                            
                        </div>
                    </div>
                </div>
            
        </div>
        
    </div>
@stop