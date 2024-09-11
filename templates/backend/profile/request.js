$(document).ready(function() {


/**Add Request */

    $("#form_add_request").on('submit', function(e){

        function notif(val,msg){
            if(val){
                PNotify.success({
                    title: 'Success!',
                    text: msg,
                  });
            }else{
                PNotify.error({
                    title: 'Error!',
                    text: msg,
                  });
            }
        }

        $.ajax({
            type: 'POST',
            url: 'add_requests',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(result) {
                if(result.status == 'success'){
                   notif(true, result.msg);
                   $('#add_request').modal('hide');
                   $('#form_add_request')[0].reset();
                   setTimeout(function(){
                    window.location.reload(1);
                    }, 2000);

                  }else{
                   notif(false, result.msg);
                  }
           }

        });

        e.preventDefault();
    });


/**Get Request details */
get_request = function(id){

    $.ajax({
        url: 'get_request/'+id,
        type: 'get',
        dataType: 'json',
        data: {id: id},
        success: (function(data){           
            $('#dis_title').html(data.title);
            $('#dis_content').html(data.content);
            $('#dis_status').html(data.req_status);    
        })       
    });
};

edit_request = function(id){

    $.ajax({
        url: 'get_request/'+id,
        type: 'get',
        dataType: 'json',
        data: {id: id},
        success: (function(data){
            $('#eetitle').val(data.title);
            $('#eecontent').val(data.content);
            $('#requniqid').val(data.uniqid);
            $('#reqstaff_id').val(data.staff_id);
            $('#req_status').val(data.req_status).attr('selected', 'selected').change();     
        })       
    });
};


/**Update Request */
$( "#form_edit_request" ).submit(function( event ) {

    let notif = (val,msg) => {
        if(val){
            PNotify.success({
                title: 'Success!',
                text: msg,
              });
        }else{
            PNotify.error({
                title: 'Error!',
                text: msg,
              });
        }
    };

$.ajax({
    type: 'POST',
    url: 'update_request',
    data: new FormData(this),
    dataType: 'json',
    contentType: false,
    cache: false,
    processData:false,
    //beforeSend: function(){
        //$('.submitBtn').attr("disabled","disabled");
       // $('#form_add_employee').css("opacity",".5");
    //},
    success: function(result) {
        if(result.status == 'success'){
           notif(true, result.msg);
           $('#edit_request').modal('hide');
           $('#form_edit_request')[0].reset();
           setTimeout(function(){
            window.location.reload(1);
            }, 2000);
          }else{
           notif(false, result.msg);
          }
   }

});

event.preventDefault();
});


/**Delete Upload */
delete_des_warning = function(id){

    $('#delete_discipline').modal('show');
    let uid = id;        
    delete_discipline = function(id){
        if(id == 'true'){

            let notif = (val, msg)  => {
                if (val) {
                    PNotify.success({
                        title: 'Success!',
                        text: msg,
                    });
                } else {
                    PNotify.error({
                        title: 'Error!',
                        text: msg,
                    });
                }
            };

            $.ajax({
                url: 'delete_discipline',
                type: 'POST',
                data: {id: uid},
                dataType: 'json',
                success: function(result){
                    if(result.status == 'success'){
                        notif(true, result.msg);
                        $('#delete_discipline').modal('hide');
                        setTimeout(function(){
                            window.location.reload(1);
                        }, 2000);
                    }else{
                     notif(false, result.msg);
                    }
                }
            });
        }
    };
};

 
});