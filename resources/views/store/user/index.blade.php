@extends('layouts.layoutuser')
@section('title',"$Store->store_name Index")
@section('content1')
<?php
use App\Models\Admin;
    //   $allstores =NULL;
      // echo $LoggedAdminInfo;
    //   $LoggedAdminInfo=admin::where('id','=',session('LoggedAdmin'))->first();
      if($Store){
        // $LoggedAdminInfo=session()->has('LoggedAdmin');
        $products =DB::table('products')
        ->leftjoin('gallery', 'products.product_id', '=', 'gallery.product_id')
        ->whereRaw('store_id="'.$Store->id.'"')
        ->get();
      }
      
?> 
<style>
.card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
}
</style>
    <div class="container d-flex justify-content-center">
        
        <div class="row" style="margin-top:45px">
        
            <div class="col ">

                    <h1>{{$Store->store_name}} </h1>

                        @foreach ($products as $product)
                        <div class="col d-flex justify-content-center">

                        <div class="card m-2" style="width: 18rem;" id="{{$product->product_id}}">
                        <img class="card-img-top" src="uploads/images/{{$product->picture}}" alt="Card image cap" />
                            <div class="card-body">
                                <h5 class="card-title text-center">{{$product->title}}</h5>
                                <p class="card-text">
                                    @if(strlen($product->description)>=100)
                                        {{ substr($product->description, 0,  100) }}
                                        <span style="color:blue">click to see more...</span>
                                    @else
                                        {{$product->description}}
                                    @endif
                                </p>
                                <a href="/product/{{$product->product_id}}" class="btn btn-primary">See More</a>
                            </div>
                    </div>

                                
                            
            
                        @endforeach

                    </div>
            </div>

        </div>
    </div>
@stop

                        <!-- <?php
                                    $product_img =DB::table('gallery')
                                    ->whereRaw('product_id="'.$product->product_id.'"')
                                    ->get()->first();
                        ?>        -->