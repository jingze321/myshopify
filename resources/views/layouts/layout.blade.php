<!doctype html>
<html>
<head>
   @include('partials.head')
</head>

<body>
<style>
.main-content{
    /* background-color: #f5f5f5; */
    padding-right: 20px;
    padding-top: 20px;
    min-height: calc(100vh - 50px);
}

</style>
<header >
      session_start();

       @include('partials.header')
</header>
<div class="container-fluid">
   <div id="main" class="row " >
           @include('partials.sidebar') 
           <main class="col-md-9 ms-sm-auto col-lg-10 px-md-3 main-content">
            @yield('content')
           </main>
   </div>
   <!-- <footer class="row">
   </footer> -->
    <!-- @yield('scripts') -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
   </div>
</body>
</html>