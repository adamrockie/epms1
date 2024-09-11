$(document).ready(function(){

    /**Add Next of Kin */
    
        $( "#add_nok" ).submit(function( event ) {
       
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
           url: 'add_nok',
           type: 'post',
           dataType: 'json',
           data: $('#add_nok').serialize(),
           success: function(result) {
               
                         if(result.status == 'success'){
                            notif(true, result.msg);
                            $('#family_info_modal').modal('hide');
                            $('#add_nok')[0].reset();
                            $('#emergency').load(document.URL +  ' #emergency');
    
                           }else{
                            notif(false, result.msg);
                           }
                    }
       });
    
       event.preventDefault();
     });
    
    /**Get NOK details for update */
     get_nok = function(id){
    
        $.ajax({
            url: 'get_nok/'+id,
            type: 'get',
            dataType: 'json',
            data: {id: id},
            success: (function(data){
                $('#enok_names').val(data.names);
                $('#enok_relationship').val(data.relationship);
                $('#enok_dob').val(data.dob);
                $('#enok_phone').val(data.phone_1);
                $('#enok_phone2').val(data.phone_2);
                $('#enok_email').val(data.email);
                $('#enok_address').val(data.address);
            })       
        });
    };
    
    
    /**Update NOK */
    $( "#update_nok" ).submit(function( event ) {
    
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
        url: 'update_nok',
        type: 'post',
        dataType: 'json',
        data: $('#update_nok').serialize(),
        success: function(result) {
                      if(result.status == 'success'){
                         notif(true, result.msg);
                         $('#update_family_info_modal').modal('hide');
                         $('#update_nok')[0].reset();
                         $('#emergency').load(document.URL +  ' #emergency');
    
                        }else{
                         notif(false, result.msg);
                        }
                 }
    });
    
    event.preventDefault();
    });
    
    /**Delete Emergency */
    delete_warning = function(id){
    
        $('#delete_department').modal('show');
        let office_id = id;        
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
                    data: {office_id: office_id},
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