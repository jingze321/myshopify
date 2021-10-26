@extends('layouts.layoutuser')
@section('title',"Profile")

@section('content1')

<?php
        $row=0;
        $Stores = DB::table('stores')
        ->get();
        // dd($Stores);
?>
<body>
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
                            <td>{{$LoggedUserInfo->last_name}}</td>
                            <td>{{$LoggedUserInfo->first_name}}</td>
                            <td>{{$LoggedUserInfo->email}}</td>
                            <td><a href="logout">Logout</a></td>
                        </tr>
                    </tbody>
                
                </table>
            </div>

            <div>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Store Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Country</th>
                        <th ></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Stores as $Store)
                            @php
                                $row++ ;
                            @endphp
                            <tr>
                                <th scope="row">{{$row}}</th>
                                <td>{{$Store->store_name}}</td>
                                <td>{{$Store->store_industry}}</td>
                                <td>{{$Store->country}}</td>
                                <td>
                                    <a href="//{{$Store->store_name}}.localhost:8000/mystore" class="btn btn-primary">Visit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
</html>