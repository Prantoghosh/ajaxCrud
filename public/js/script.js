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

            error:function(){
                swal("Opps!","Form not submitted","error");
                
            }



        });




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

});