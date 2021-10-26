@extends('layouts.layout')
@section('title',"$Store->store_name order")
@section('content')

<?php
            $orders = DB::table('orders')
            ->select('orders.created_at','orders.id','orders.amount',
                    'order_items.quantity','order_items.amount as itemprice',
                    'order_items.quantity','stores.company_name',
                    'stores.store_name','stores.store_address',
                    'products.title'
            )
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('users','users.id','orders.user_id')
            ->join('products','products.product_id','order_items.product_id')
            ->join('stores','products.store_id','stores.id')
            ->where('orders.id',$Orders)
            ->get();
            // dd($orders)
?>

<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        
        <div class="col-md-8">
            <div class="p-3 bg-white rounded">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="text-uppercase">Invoice</h1>
                        <div class="billed"><span class="font-weight-bold text-uppercase">Billed:</span><span class="ml-1">{{$orders[0]->company_name}}</span></div>
                        <div class="billed"><span class="font-weight-bold text-uppercase">Date:</span><span class="ml-1">{{$orders[0]->created_at}}</span></div>
                        <div class="billed"><span class="font-weight-bold text-uppercase">Order ID:</span><span class="ml-1">#{{$orders[0]->id}}</span></div>
                    </div>
                    <div class="col-md-6 text-right mt-3">
                        <h4 class="text-danger mb-0">{{$orders[0]->store_name}}</h4><span>{{$orders[0]->store_address}}</span>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{$order->title}}</td>
                                    <td>{{$order->quantity}}</td>
                                    <td>{{$order->itemprice}}</td>
                                    <td>{{$order->itemprice*$order->quantity}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Total</td>
                                    <td>{{$order->amount}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-right mb-3"><a class="btn btn-danger btn-sm mr-5" href="/mystore/order">Back</a></div>
            </div>
        </div>
    </div>
</div>

@stop