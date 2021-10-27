@extends('layouts.layout')
@section('title',"$Store->store_name order")
@section('content')

<?php
  $row=0;
  $orders = DB::table('orders')
  // ->join('order_items', 'order_items.order_id', '=', 'orders.id')
  ->select('orders.*','orders.id as order_id','orders.created_at as order_created_at','users.*')
  ->join('users','users.id','orders.user_id')
  ->where('orders.store_id',$Store->id)
  ->get();
// dd($orders)
?>

<div class="container" style="margin-top:45px">
  <h1>Order</h1>
<!--Table-->
  <table class="table table-hover table-fixed" >

    <!--Table head-->
    <thead>
      <tr>
        <th>#</th>
        <th>Order ID</th>
        <th>Customer ID</th>
        <th>Customer Name</th>
        <th>Total Amount</th>
        <th>Purchase Date</th>
        <th></th>
      </tr>
    </thead>
    <!--Table head-->
    
    <!--Table body-->
    <tbody class="align-middle">
      @foreach($orders as $order)
        <tr>
          <th scope="row ">
          @php
              $row++ ;
          @endphp
          {{$row}}
          </th>
            <td>{{$order->order_id}}</td>
            <td>{{$order->user_id}}</td>
            <td>{{$order->first_name}} {{$order->last_name}}</td>
            <td>{{$order->amount}}</td>
            <td>{{$order->order_created_at}}</td>
          <td>
            <a href="/order_details/{{$order->order_id}}" class="btn btn-info">View</a>
          </td>

        </tr>
      @endforeach
    </tbody>
    <!--Table body-->

  </table>
<!--Table-->

</div>

@stop