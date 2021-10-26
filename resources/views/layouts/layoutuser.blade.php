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
       @include('partials.headeruser')
</header>
   <div class="container-fluid">
      <div id="main" class="row " >
            <main class=" main-content">
               @yield('content1')
            </main>
      </div>
   
   </div>
</body>
</html>