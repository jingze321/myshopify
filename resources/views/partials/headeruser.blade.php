<style>
        .navbar
        {
            border-bottom:1px solid grey;
        }
</style>
<?php
use App\Models\User;
      // $Allstores =null;
      // dd($store);
      // echo $LoggedAdminInfo;
      $LoggedUserInfo=user::where('id','=',session('LoggedUser'))->first();
      if(isset($LoggedUserInfo)&&isset($Store->id)){
        $carts = DB::table('carts')
        ->join('users', 'carts.user_id', '=', 'users.id')
        ->join('cart_details', 'cart_details.cart_id', '=', 'carts.cart_id')
        ->join('products', 'cart_details.product_id', '=', 'products.product_id')
        ->Where ('users.id',$LoggedUserInfo->id)
        ->Where ('products.store_id',$Store->id)
        ->get();
      }

      // if($LoggedUserInfo){
      //   // $LoggedAdminInfo=session()->has('LoggedAdmin');
      //   $Allstores =DB::table('stores')
      //   ->selectRaw('store_name')
      //   ->whereRaw('admin_id="'.$LoggedAdminInfo->ID.'"')
      //   ->get();
      // }

      // dd($AllStore);

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

                    <li class="nav-item ">
                    <a class="nav-link " href="/cart" >
                    @if (isset($Store))
                      {{$Store->store_name}}
                      @if (isset($carts))
                      <span class="badge bg-danger badge-pill">
                      

                        {{count($carts)}}
                      @endif
                      </span><i class="fas fa-shopping-cart pl-0"></i>
                      
                    @else
                      Shopify
                    @endif
                    </a>

                </li>

                    
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
                @if($LoggedUserInfo)
                <li class="nav-item dropdown mr-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{$LoggedUserInfo->first_name}}  
                  </a>
                  

                  <div class="dropdown-menu" >
                  <a class="dropdown-item" href="edit_profile">Setting</a>
                    <a class="dropdown-item" href="logout">Logout</a>
                  </div>
                </li>
                @else
                <a class="nav-link px-3" href="admin_login">Login</a>
                @endif
              
            </li>
            
          </ul>
        </div>
      </div>
    </nav>
<header>