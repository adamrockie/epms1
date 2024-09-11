$(document).ready(function(){

/**Add Office */

    $( "#add_office" ).submit(function( event ) {
   
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
       url: 'add_office',
       type: 'post',
       dataType: 'json',
       data: $('#add_office').serialize(),
       success: function(result) {
                     if(result.status == 'success'){
                        notif(true, result.msg);
                        $('#add_department').modal('hide');
                        $('#add_office')[0].reset();
                        $('#mcontents').load(document.URL +  ' #mcontents');
                        Location.reload();

                       }else{
                        notif(false, result.msg);
                       }
                }
   });

   event.preventDefault();
 });

/**Get Office details for update */
 edit_office = function(id){

    $.ajax({
        url: 'edit_office/'+id,
        type: 'get',
        dataType: 'json',
        data: {id: id},
        success: (function(data){
            $('#edit_department').modal('show');
            $('#ename').val(data.name);
            $('#ebranch_code').val(data.branch_code);
            $('#office_id').val(data.office_id);
            
        })       
    });
};


/**Update Office */
$( "#edit_office" ).submit(function( event ) {

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
    url: 'update_office',
    type: 'post',
    dataType: 'json',
    data: $('#edit_office').serialize(),
    success: function(result) {
                  if(result.status == 'success'){
                     notif(true, result.msg);
                     $('#edit_department').modal('hide');
                     $('#edit_office')[0].reset();
                     $('#mcontents').load(document.URL +  ' #mcontents');

                    }else{
                     notif(false, result.msg);
                    }
             }
});

event.preventDefault();
});

/**Delete Office */
delete_warning = function(id, token){

    $('#delete_department').modal('show');
    let office_id = id; 
    let tk = token;       
    delete_office = function(id){
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
                url: 'delete_office',
                type: 'POST',
                data: {
                    office_id: office_id,
                    token: tk
                },
                dataType: 'json',
                success: function(result){
                    if(result.status == 'success'){
                        notif(true, result.msg);
                        $('#delete_department').modal('hide');
                        $('#mcontents').load(document.URL +  ' #mcontents');
                    }else{
                     notif(false, result.msg);
                    }
                }
            });
        }
    };
};

 
});