$(document).ready(function(){

/**Add Role */

    $( "#form_add_role" ).submit(function( event ) {
   
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
       url: 'add_role',
       type: 'post',
       dataType: 'json',
       data: $('#form_add_role').serialize(),
       success: function(result) {
                     if(result.status == 'success'){
                        notif(true, result.msg);
                        $('#add_role').modal('hide');
                        $('#form_add_role')[0].reset();
                        $('#rolelist').load(document.URL +  ' #rolelist');

                       }else{
                        notif(false, result.msg);
                       }
                }
   });

   event.preventDefault();
 });



/**Update ROle */
$( "#form_update_role" ).submit(function( event ) {

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
    url: 'update_role',
    type: 'post',
    dataType: 'json',
    data: $('#form_update_role').serialize(),
    success: function(result) {
                  if(result.status == 'success'){
                     notif(true, result.msg);
                     $('#edit_role').modal('hide');
                     $('#form_update_role')[0].reset();
                     //$('#userslist').load(document.URL +  ' #userslist');
                     location.reload();

                    }else{
                     notif(false, result.msg);
                    }
             }
});

event.preventDefault();
});


/**Delete Role */
delete_role = function(id){

    $('#modal_delete_role').modal('show');
    let group_id = id;        
    delete_role = function(id){
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
                url: 'delete_role',
                type: 'POST',
                data: {group_id: group_id},
                dataType: 'json',
                success: function(result){
                    if(result.status == 'success'){
                        notif(true, result.msg);
                        $('#modal_delete_role').modal('hide');
                        //$('#mcontents').load(document.URL +  ' #mcontents');
                        location.reload();
                    }else{
                     notif(false, result.msg);
                    }
                }
            });
        }
    };
};


/** Add Permission */
$( "#form_permission" ).submit(function( event ) {
   
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
    url: 'add_permission',
    type: 'post',
    dataType: 'json',
    data: $('#form_permission').serialize(),
    success: function(result) {
                  if(result.status == 'success'){
                     notif(true, result.msg);
                     $('#view_role').modal('hide');
                     $('#form_permission')[0].reset();
                     //$('#rolelist').load(document.URL +  ' #rolelist');
                     location.reload();

                    }else{
                     notif(false, result.msg);
                    }
             }
});

event.preventDefault();
});

 
});