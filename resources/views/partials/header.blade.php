<style>
        .navbar
        {
            border-bottom:1px solid grey;
        }
</style>
<?php
use App\Models\Admin;
      $allstores =NULL;
      // echo $LoggedAdminInfo;
      $LoggedAdminInfo=admin::where('id','=',session('LoggedAdmin'))->first();
      if($LoggedAdminInfo){
        // $LoggedAdminInfo=session()->has('LoggedAdmin');
        $allstores =DB::table('stores')
        ->selectRaw('store_name')
        ->whereRaw('admin_id="'.$LoggedAdminInfo->id.'"')
        ->get();
        
      }
      // dd($allstores);


?> 

<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <div class="container-fluid">
        
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
        
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100">
                <li class="nav-item ">

                    @if(session()->has('LoggedAdmin'))
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(isset ($store_name))
                      {{$store_name}}
                    @else
                      Store
                    @endif
                      
                    </a>
                  <div class="dropdown-menu">
                    @if(!$allstores ==NULL)
                      @foreach($allstores as $store)           
                        <a class="dropdown-item" href="//{{$store->store_name}}.localhost:8000/mystore"> {{$store->store_name}} </a>
                      @endforeach
                    @endif 
                    <a class="dropdown-item" href="/admin_profile"> profile </a>
                  </div>
                </li>

                    @else
                      Shopify
                    @endif
                    
                  </a>
                  
                </li>
                <li class="nav-item flex-fill">

                </li>
                <li class="nav-item flex-fill">
                <form class="form-inline">
                  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                  <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
                </form>
                </li>
                <li class="nav-item flex-fill">

                </li>
                @if($LoggedAdminInfo)
                <li class="nav-item dropdown mr-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{$LoggedAdminInfo->first_name}}  
                  </a>
                  <div class="dropdown-menu" >
                  <a class="dropdown-item" href="admin_edit">Setting</a>
                    <a class="dropdown-item" href="/admin_logout">Logout</a>
                  </div>
                </li>
                @else
                <a class="nav-link px-3" href="/admin_login">Login</a>
                @endif
              
            </li>
            
          </ul>
        </div>
      </div>
    </nav>
<header>
<!-- <script>
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
</script> -->

