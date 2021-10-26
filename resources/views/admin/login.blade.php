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
            <h4>Admin Login</h4>
            <hr>
            <form action="{{route('admin.check')}}" method="post">
                @csrf
                @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{Session::get('fail') }}
                        </div>
                    @endif
                <div class="form-group">
                    <label for="email"> Email </label>
                    <input type="text" class="form-control" name="email" placeholder="Enter Email" value="{{old('email')}}"></input>
                    <span class="text danger"> @error('email') {{$message}} @enderror </span>
                </div>
                <div class="form-group">
                    <label for="password"> Password </label>
                    
                    <input type="password" class="form-control" name="password" placeholder="password"></input>
                    <span class="text danger"> @error('password') {{$message}} @enderror </span>
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">Login</button>
                </div>
                
                
                <div class="d-flex">
                    <div class="mr-auto p-2"><a href="admin_register"> Create an New Account</a></div>
                    <div class="p-2"><a href="login"> <p>User Login</p></a></div>
                </div>
            </form>
        </div>
    </div>
    @stop
<!-- </body>
</html> -->