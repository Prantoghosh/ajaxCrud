$(document).ready(function () {
    $('#employeeTable').DataTable({
        "order": [[ 0, "desc" ]]
    });
    
});


$(document).ready(function () {

    $("#addEmployee").on("submit", function (e) {
        e.preventDefault();

        var form = $(this);
        var url  = form.attr("action");
        var type = form.attr("method");

        /*
        This Below lines are to prevent 422 ajax+laravel error. If anything is defined 
        required in controller(for example here "name" "email" "phone" is defined required in controller and "image" is
        not defined as required in controller) 
        it has to be handle in script.js like this. Otherwise it will give us an 422 error. so we handled name,email,phone here
        
        */

        var name=$("#name").val();
        var email=$("#email").val();
        var phone=$("#phone").val();
        var image=$("#image").val();

        //console.log(name);

        if(name==""){
            swal("Required","Name field can't be empty","error");
        }

        else if(email==""){
            swal("Required","Email field can't be empty","error");
        }


        else if(phone==""){
            swal("Required","Phone field can't be empty","error");
        }

      else{

                $.ajax({

                    url:url,
                    data: new FormData(this),
                    type:type,
                    dataType:"JSON",
                    contentType:false,
                    cache:false,
                    processData:false,
                    enctype: 'multipart/form-data',

                    beforeSend:function(){
                        $(".load").fadeIn();
                    },
                    success:function(){
                        swal("Submitted","Form submitted successfully","success");
                        $('#addEmployee').trigger("reset");
                        $('#exampleModal').modal("hide");
                        
                        return getEmployeeData();

                    },
                    complete:function(){
                        $(".load").fadeOut();
                    },

                    error:function(e){

                    $(".load").fadeOut();

                        

                        //below block is for printing the erros like list
                        
                    //     $('#validation-errors').html('');
                    //     $.each(e.responseJSON.errors, function(key,value) {
                    //       $('#validation-errors').append('<div class="alert alert-danger">'+value+'</div');
                    //       console.log(value);
                    //   }); 


                    //below block is for printing the erros like individual span -starts

                    

                    if(e.responseJSON.errors.name){
                        $('#error_name').html('<span style="color:red">'+ e.responseJSON.errors.name[0] + '</span>');
                    } 

                    if(!e.responseJSON.errors.name){
                        $('#error_name').html(' ');
                    } 


                    if(e.responseJSON.errors.email){
                        $('#error_email').html('<span style="color:red">'+ e.responseJSON.errors.email[0] + '</span>');
                    } 

                    if(!e.responseJSON.errors.email){
                        $('#error_email').html(' ');
                    } 


                    if(e.responseJSON.errors.phone){
                        $('#error_phone').html('<span style="color:red">'+ e.responseJSON.errors.phone[0] + '</span>');
                    } 

                    if(!e.responseJSON.errors.phone){
                        $('#error_phone').html(' ');
                    }
                    
                    
                    if(e.responseJSON.errors.image){
                        $('#error_image').html('<span style="color:red">'+ e.responseJSON.errors.image[0] + '</span>');
                    } 

                    if(!e.responseJSON.errors.image){
                        $('#error_image').html(' ');
                    } 
                    
                    //below block is for printing the erros like individual span -Ends
                    
                    //$('#error_image').html('<span style="color:red">'+ e.responseJSON.errors.image[0] + '</span>');


                        swal("Opps!","Form not submitted","error");
                        console.log((e.responseJSON.errors));
                        
                    }



                });

        }





    });


    function getEmployeeData(){

        var url=$("#getAllData").data("url");
        console.log(url);

        $.ajax({
            url:url,
            type:"get",
            dataType:"html",

            success:function(response){
             $("#showTableData").html(response);

            },

        });
    }

    $(document).on("click",".viewBtn",function(e){

        e.preventDefault();

        var id= $(this).data("id");
        var url= $(this).attr("href");

        console.log("success");

        $.ajax({

            url:url+"/"+id,
            type:"get",
            dataType:"JSON",

            success:function(response){
                console.log(response);
                $("#viewEmployeeModal").modal("show");

                $(".employeeDetailsHeader").text(response.name+"'s Details");
                $(".eImage").attr("src" , "http://127.0.0.1:8000/storage/"+response.image);
                $(".eName").text("Name: "+ response.name);
                $(".eEmail").text("Email: "+ response.email);
                $(".ePhone").text("Phone: "+ response.phone);
            }, 


        });


    });

});
