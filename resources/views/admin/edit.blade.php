    @extends('layouts.layout')
    @section('title',"Edit Profile")
    @section('content')

<div class="container">
        <div class="row" style="margin-top:45px">
            <h4>Edit</h4>
            <hr>

            <form action="{{route('admin.update')}}" method="post">
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
                    <input type="email" class="form-control" name="email" placeholder="Enter Email" value={{$LoggedAdminInfo->email}}></input>
                    <span class="text danger"> @error('email') {{$message}} @enderror </span>
                </div>

                <div class="form-group">
                    <label for="firstname"> First Name </label>
                    <input type="text" class="form-control" name="firstname" placeholder="First Name" value="{{$LoggedAdminInfo->first_name}}"></input>
                    <span class="text danger"> @error('firstname') {{$message}} @enderror </span>
                </div>
                <div class="form-group">
                    <label for="lastname"> Last Name </label>
                    <input type="text" class="form-control" name="lastname" placeholder="Last Name" value="{{$LoggedAdminInfo->last_name}}"></input>
                    <span class="text danger"> @error('lastname') {{$message}} @enderror </span>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">Update</button>
                </div>


            </form>
        </div>
</div>
    @stop