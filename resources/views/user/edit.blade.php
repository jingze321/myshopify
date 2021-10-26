@extends('layouts.layoutuser')
@section('title',"Edit Profile")

@section('content1')

<div class="container" style="margin-top:45px">
        <div class="row" >
            <h4>Edit</h4>
            <hr>
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
                <label for="email"> Avantar </label>
                <form action="{{route('auth.upload')}}" method="post" enctype="multipart/form-data">
                    @if ($LoggedUserInfo->profile_image)
                    <img src="/uploads/avantars/{{$LoggedUserInfo->profile_image}}" style="width:150px;height:150px;border-radius:50%"></img>
                    @else
                    <img src="/uploads/avantars/default.png" style="width:150px;height:150px;border-radius:50%"></img>
                    @endif
                    <input type="file" name="avatar" class="btn btn-success" id="avatar" onchange="javascript:this.form.submit();"/>
                    
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                </form>
                <form action="edit_profile/remove" method="post" >
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <button type="submit" name="remove"  class="btn btn-danger">Remove</button>
                </form>
            </div>
            <form action="{{route('auth.update')}}" method="post">
                @csrf

                <div class="form-group">
                    <label for="email"> Email </label>
                    <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{$LoggedUserInfo->email}}"  disabled></input>
                    <span class="text danger"> @error('email') {{$message}} @enderror </span>
                </div>

                <div class="form-group">
                    <label for="firstname"> First Name </label>
                    <input type="text" class="form-control" name="firstname" placeholder="First Name" value="{{$LoggedUserInfo->first_name}}"></input>
                    <span class="text danger"> @error('firstname') {{$message}} @enderror </span>
                </div>
                <div class="form-group">
                    <label for="lastname"> Last Name </label>
                    <input type="text" class="form-control" name="lastname" placeholder="Last Name" value="{{$LoggedUserInfo->last_name}}"></input>
                    <span class="text danger"> @error('lastname') {{$message}} @enderror </span>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">Update</button>
                </div>


            </form>
        </div>
    </div>


<!-- <script>
document.getElementById("avatar").onchange = function() {
    document.getElementById("upload_file").submit();
};
</script> -->
