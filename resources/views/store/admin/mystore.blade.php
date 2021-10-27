@extends('layouts.layout')
@section('title',"$Store->store_name Main Page")
@section('content')
    <div class="container">
        
        <div class="row" style="margin-top:45px">
        
            <div class="col-md-6 col-md-offset">
            
            <h1> {{$Store->store_name}}</h1>
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
                    <!-- @foreach($Store as $store)
                        {{$store}}
                    @endforeach -->
                    
                </div>
            </div>

        </div>
    </div>
@stop