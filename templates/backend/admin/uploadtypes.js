$(document).ready(function(){

/**Add Type */

    $( "#add_type" ).submit(function( event ) {
   
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
       url: 'add_type',
       type: 'post',
       dataType: 'json',
       data: $('#add_type').serialize(),
       success: function(result) {
                     if(result.status == 'success'){
                        notif(true, result.msg);
                        $('#add_type_modal').modal('hide');
                        $('#add_type')[0].reset();
                        $('#typess').load(document.URL +  ' #typess');

                       }else{
                        notif(false, result.msg);
                       }
                }
   });

   event.preventDefault();
 });

/**Get Types for update */
 get_types = function(id){

    $.ajax({
        url: 'get_type/'+id,
        type: 'get',
        dataType: 'json',
        data: {id: id},
        success: (function(data){
            $('#edit_type_modal').modal('show');
            $('#ename').val(data.name);
            $('#edescription').val(data.description);
            $('#type_id').val(data.id);
            
        })       
    });
};


/**Update Types */
$( "#update_type" ).submit(function( event ) {

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
    url: 'update_type',
    type: 'post',
    dataType: 'json',
    data: $('#update_type').serialize(),
    success: function(result) {
                  if(result.status == 'success'){
                     notif(true, result.msg);
                     $('#edit_type_modal').modal('hide');
                     $('#update_type')[0].reset();
                     $('#typess').load(document.URL +  ' #typess');

                    }else{
                     notif(false, result.msg);
                    }
             }
});

event.preventDefault();
});

/**Delete Type */
delete_warning = function(id){

    $('#delete_type_modal').modal('show');
    let type_id = id;        
    delete_type = function(id){
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
                url: 'delete_type',
                type: 'POST',
                data: {type_id: type_id},
                dataType: 'json',
                success: function(result){
                    if(result.status == 'success'){
                        notif(true, result.msg);
                        $('#delete_type_modal').modal('hide');
                        $('#typess').load(document.URL +  ' #typess');
                    }else{
                     notif(false, result.msg);
                    }
                }
            });
        }
    };
};

 
});