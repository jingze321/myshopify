@extends('layouts.layout')
@section('title',"$AllStore->store_name Main Page")
@section('content')
<head>

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" integrity="sha512-WvVX1YO12zmsvTpUQV8s7ZU98DnkaAokcciMZJfnNWyNzm7//QRV61t4aEr0WdIa4pe854QHLTV302vH92FSMw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js" integrity="sha512-oQq8uth41D+gIH/NJvSJvVB85MFk1eWpMK6glnkg6I7EdMqC1XVkW7RxLheXwmFdG03qScCM7gKS/Cx3FYt7Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<style>
.dz-image img {
    width: 100%;
    height: 100%;
}
.dropzone.dz-started .dz-message {
	display: block !important;
}
.dropzone {
	border: 2px dashed #028AF4 !important;;
}
.dropzoneDragArea .dz-preview.dz-complete .dz-success-mark {
    opacity: 1;
}
.dropzoneDragArea .dz-preview.dz-error .dz-success-mark {
    opacity: 0;
}
.dropzone .dz-preview .dz-error-message{
	top: 144px;
}
</style>





<div class="container">
    <h2 class="text-center p-4 bg-dark text-white">Attach <span>Documents </span></h2>

    <form action="/donee_doc_upload" class="dropzone" id="dropzonewidget" method="POST" enctype="multipart/form-data">
        @csrf
    
        <input hidden name="documents" id="documents" type="text" />
    </form>    
    <input type="submit" id="submit-all"></input>
</div>

            

        
<script>
 
var segments = location.href.split('/');
var action = segments[4];
// alert(action);
if (action == 'products') {
    var acceptedFileTypes = "image/*, .psd"; //dropzone requires this param be a comma separated list
    var fileList = new Array;
    var i = 0;
    var callForDzReset = false;
    $("#dropzonewidget").dropzone({
  
        url: "/mystore/products/store",
        addRemoveLinks: true,
        autoProcessQueue: false,
        maxFiles: 4,
        acceptedFiles: 'image/*',
        maxFilesize: 5,
        autoProcessQueue:false,
        init: function () {
            var submitButton =document.querySelector("#submit-all")
            myDropzone = this;
            submitButton.addEventListener('click',function(){
                myDropzone.processQueue();
                this.on("success", function (file, serverFileName) {
                file.serverFn = serverFileName;
                fileList[i] = {
                    "serverFileName": serverFileName,
                    "fileName": file.name,
                    "fileId": i
                };
                i++;
            });
            })

        }
    });
}
</script>



@stop

