@extends('layouts.layout')
@section('title',"$AllStore->store_name Main Page")
@section('content')

    <div class="container">
        <div class="row" style="margin-top:45px">
            <div class="col-md-6 col-md-offset">
                
                <table class="table table-hover">
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                    </thead>
                    <tbody>
                        <tr>
                            @if(session()->has('LoggedAdmin'))
                            <td>{{$LoggedAdminInfo->last_name}}</td>
                            <td>{{$LoggedAdminInfo->first_name}}</td>
                            <td>{{$LoggedAdminInfo->email}}</td>
                            <td><a href="admin_logout">Logout</a></td>
                            @endif
                        </tr>
                    </tbody>
                </table>
                <div>
                    <!-- @foreach($AllStore as $store)
                        {{$store}}
                    @endforeach -->
                    {{$AllStore->store_name}}
                </div>
            </div>

        </div>
    </div>
@stop