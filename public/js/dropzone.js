Dropzone.autoDiscover = false;
// Dropzone.options.demoform = false;	
// alert($("#demoform").attr('action'));
var fileList = new Array;
var i = 0;
let token = $('meta[name="csrf-token"]').attr('content');
$(function() {
var myDropzone = new Dropzone("div#dropzoneDragArea", { 
	paramName: "file",
	url: "{{ url('/mystore/products/storeimgae') }}",
	previewsContainer: 'div.dropzone-previews',
	addRemoveLinks: true,
	autoProcessQueue: false,
	uploadMultiple: false,
	parallelUploads: 1,
	maxFiles: 1,
	params: {
        _token: token
    },
	 // The setting up of the dropzone
	init: function() {
	    var myDropzone = this;
	    //form submission code goes here
	    $("form[name='demoform']").submit(function(event) {
	    	//Make sure that the form isn't actully being sent.
	    	event.preventDefault();
	    	URL = $("#demoform").attr('action');
            ///mystore/products/storedata
	    	formData = $('#demoform').serialize();
	    	$.ajax({
	    		type: 'POST',
	    		url: URL,
	    		data: formData,
                
	    		success: function(result){
                    // alert(result)
	    			if(result.status == "success"){
	    				// fetch the useid 
	    				var product_id = result.product_id;
                        // alert('successful='+product_id);
						$("#product_id").val(product_id); 
	    				//process the queue
                        // alert('successful='+product_id);

	    				myDropzone.processQueue();
	    			}else{
	    				console.log("error");
	    			}
                    
	    		},
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }      
 
	    	});
	    });
	    //Gets triggered when we submit the image.
	    this.on('sending', function(file, xhr, formData){
        let product_id = document.getElementById('product_id').value;
		   formData.append('product_id', product_id);
        //    alert(product_id);

		});
		
	    this.on("success", function (file, response) {

            $('#demoform')[0].reset();
            $('.dropzone-previews').empty();
        });

	}
	});
});