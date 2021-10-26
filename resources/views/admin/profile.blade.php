<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Login</title>
</head>
<body> -->
    @extends('layouts.layout')
    @section('title',"Admin Login")
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
                            <td>{{$LoggedAdminInfo->last_name}}</td>
                            <td>{{$LoggedAdminInfo->first_name}}</td>
                            <td>{{$LoggedAdminInfo->email}}</td>
                            <td><a href="admin_logout">Logout</a></td>
                        </tr>
                        
                    </tbody>       
                </table>

            </div>

        </div>
    </div>
    @stop
<!-- </body>
</html> -->