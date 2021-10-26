
$(document).ready(function(){      
    var url = "{{ url('/mystore/products/variant') }}";
    var i=1;  
    $('#add').click(function(){  
        var variant = $("#variant").val();
        var detail = $("#detail").val();
        i++;  
        $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="variant[]" placeholder="Enter variant" class="form-control name_list" value="'+variant+'" list="variant"/></td><td><input type="text" name="detail[]" placeholder="Enter variant detail" class="form-control name_list" value="'+detail+'" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
        
    });  
    $(document).on('click', '.btn_remove', function(){  
        var button_id = $(this).attr("id");   
        $('#row'+button_id+'').remove();  
    });  
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#submit').click(function(){    
        
        $.ajax({  
        url:"{{ url('/mystore/products/variant') }}",  
        method:"POST",  
        data:$('#add_name').serialize(),
        type:'json',
        success:function(data)  
        {
            if(data.error){

                display_error_messages(data.error);
            }else{
                i=1;
                $('.dynamic-added').remove();
                $('#add_name')[0].reset();
                $(".show-success-message").find("ul").html('');
                $(".show-success-message").css('display','block');
                $(".show-error-message").css('display','none');
                $(".show-success-message").find("ul").append('<li> Successfully Inserted</li>');
            }
        },  
            error:function(xhr){
                console.log(xhr.responseText);
            }
        });  
    });  
    function display_error_messages(msg) {
            $(".show-error-message").find("ul").html('');
            $(".show-error-message").css('display','block');
            $(".show-success-message").css('display','none');
            $.each( msg, function( key, value ) {
                $(".show-error-message").find("ul").append('<li>'+value+'</li>');
            });
        }
});  


// check box
function valueChanged()
{
    if($('.show-check').is(":checked"))   
        $(".option").show();
    else
        $(".option").hide();
}


