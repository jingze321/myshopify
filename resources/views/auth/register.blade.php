<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="row" style="margin-top:45px">
            <h4>Register</h4>
            <hr>

            <form action="{{route('auth.create')}}" method="post">
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
                <div class="form-group">
                    <label for="email"> Email </label>
                    <input type="email" class="form-control" name="email" placeholder="Enter Email"></input>
                    <span class="text danger"> @error('email') {{$message}} @enderror </span>
                </div>
                <div class="form-group">
                    <label for="password"> Password </label>
                    <input type="password" class="form-control" name="password" placeholder="Enter Email"></input>
                    <span class="text danger"> @error('password') {{$message}} @enderror </span>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="firstname"> First Name </label>
                        <input type="text" class="form-control" name="firstname" placeholder="First Name"></input>
                        <span class="text danger"> @error('firstname') {{$message}} @enderror </span>
                    </div>
                    <div class="col-sm-6">
                        <label for="lastname"> Last Name </label>
                        <input type="text" class="form-control" name="lastname" placeholder="Last Name"></input>
                        <span class="text danger"> @error('lastname') {{$message}} @enderror </span>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">Register</button>
                </div>
                <br>
                <a href="login"> Already have an account</a>

            </form>
        </div>
    </div>
</body>
</html>