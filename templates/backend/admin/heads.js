$(document).ready(function(){

/**Add Head */

    $( "#form_add_head" ).submit(function( event ) {
   
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
       url: 'add_head',
       type: 'post',
       dataType: 'json',
       data: $('#form_add_head').serialize(),
       success: function(result) {
                     if(result.status == 'success'){
                        notif(true, result.msg);
                        $('#add_head').modal('hide');
                        $('#form_add_head')[0].reset();
                        $('#mcontents').load(document.URL +  ' #mcontents');
                        window.location.reload();
                        
                       }else{
                        notif(false, result.msg);
                       }
                }
   });

   event.preventDefault();
 });

/**Get Head details for update */
 get_head = function(id){

    $.ajax({
        url: 'get_head/'+id,
        type: 'get',
        dataType: 'json',
        data: {id: id},
        success: (function(data){
            $('#edit_head').modal('show');
            $('#estaff').val(data.ippis).attr('selected', 'selected').change();
            $('#esite').val(data.office_id).attr('selected', 'selected').change();
            $('#eid').val(data.id);         
        })       
    });
};


/**Update Head */
$( "#form_update_head" ).submit(function( event ) {

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
    url: 'update_head',
    type: 'post',
    dataType: 'json',
    data: $('#form_update_head').serialize(),
    success: function(result) {
                  if(result.status == 'success'){
                     notif(true, result.msg);
                     $('#edit_head').modal('hide');
                     $('#form_update_head')[0].reset();
                     $('#mcontents').load(document.URL +  ' #mcontents');

                    }else{
                     notif(false, result.msg);
                    }
             }
});

event.preventDefault();
});

/**Delete Office */
delete_warning = function(id,token){

    $('#delete_head').modal('show');
    let head_id = id; 
    var tk = token;       
    delete_head = function(id){
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
                url: 'delete_head',
                type: 'POST',
                data: {
                    head_id: head_id,
                    token:tk
                },
                dataType: 'json',
                success: function(result){
                    if(result.status == 'success'){
                        notif(true, result.msg);
                        $('#delete_head').modal('hide');
                        //$('#mcontents').load(document.URL +  ' #mcontents');
                        //Location.reload();
                        location.reload();
                    }else{
                     notif(false, result.msg);
                    }
                }
            });
        }
    };
};

 
});