<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <!-- <title>Register</title> -->
</head>
<body>
    @extends('layouts.layout')
    @section('title',"Admin Register")
    @section('content')
    <div class="container">
        <div class="row" style="margin-top:45px">
            <h4>Register</h4>
            <hr>

            <form action="{{route('admin.create')}}" method="post">
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
                    <input type="password" class="form-control" name="password" placeholder="Enter Password "></input>
                    <span class="text danger"> @error('password') {{$message}} @enderror </span>
                </div>
                <div class="form-group">
                    <label for="firstname"> First Name </label>
                    <input type="text" class="form-control" name="firstname" placeholder="First Name"></input>
                    <span class="text danger"> @error('firstname') {{$message}} @enderror </span>
                </div>
                <div class="form-group">
                    <label for="lastname"> Last Name </label>
                    <input type="text" class="form-control" name="lastname" placeholder="Last Name"></input>
                    <span class="text danger"> @error('lastname') {{$message}} @enderror </span>
                </div>
                <div class="form-group">
                    <label for="address"> Address </label>
                    <input type="text" class="form-control" name="address" placeholder="Address"></input>
                    <span class="text danger"> @error('address') {{$message}} @enderror </span>
                </div>
                <div class="form-group">
                    <label for="apartment"> Apartment </label>
                    <input type="text" class="form-control" name="apartment" placeholder="Apartment"></input>
                    <span class="text danger"> @error('apartment') {{$message}} @enderror </span>
                </div>
                <div class="form-group">
                    <label for="postcode"> postcode </label>
                    <input type="text" class="form-control" name="postcode" placeholder="postcode"></input>
                    <span class="text danger"> @error('postcode') {{$message}} @enderror </span>
                </div>
                <!-- <div class="form-group">
                    <label for="state"> state </label>
                    <input type="text" class="form-control" name="state" placeholder="state"></input>
                    <span class="text danger"> @error('state') {{$message}} @enderror </span>
                </div>
                <div class="form-group">
                    <label for="country"> country </label>
                    <input type="text" class="form-control" name="country" placeholder="country"></input>
                    <span class="text danger"> @error('country') {{$message}} @enderror </span>
                </div> -->
                <div class="form-group">
                    <label for="country"> Country </label>
                    <select name="country" id="country" class="form-control input-lg dynamic" data-dependent="state">
                        <option value="">Select Country</option>
                        @foreach($country_list as $country)
                        <option value="{{ $country->country}}">{{ $country->country }}</option>
                        @endforeach
                    </select>
                    <span class="text danger"> @error('state') {{$message}} @enderror </span>
                </div>
                <div class="form-group">
                    <label for="state"> State </label>
                    <select name="state" id="state" class="form-control input-lg dynamic" data-dependent="city">
                        <option value="">Select State</option>
                    </select>
                    <span class="text danger"> @error('state') {{$message}} @enderror </span>
                </div>
                {{csrf_field()}}
                <div class="form-group">
                    <label for="phone"> phone </label>
                    <input type="tel" class="form-control" name="phone" placeholder="phone"></input>
                    <span class="text danger"> @error('phone') {{$message}} @enderror </span>
                </div>
                <hr>
                <div class="form-group">
                    <label for="storename"> Store Name </label>
                    <input type="text" class="form-control" name="storename" max=20 placeholder="Storename"></input>
                    <span class="text danger"> @error('storename') {{$message}} @enderror </span>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">Register</button>
                </div>
                <br>
                <a href="admin_login"> Already have an account</a>

            </form>
        </div>
    </div>

    @stop
<!-- </body>
</html> -->

<script>
$(document).ready(function(){

    $('.dynamic').change(function(){
    if($(this).val() != '')
    {
        var select = $(this).attr("id");
        var value = $(this).val();
        var dependent = $(this).data('dependent');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ route('dynamicdependent.fetch') }}",
            method:"POST",
            data:{select:select, value:value, _token:_token, dependent:dependent},
            success:function(result)
            {
            $('#'+dependent).html(result);
            }

        })
    }
    });

    $('#country').change(function(){
        $('#state').val('');
        $('#city').val('');
    });

    $('#state').change(function(){
        $('#city').val('');
    });
 

});
</script>