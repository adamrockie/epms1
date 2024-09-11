$(document).ready(function(){

    /**Add Education*/
    
        $( "#add_education" ).submit(function( event ) {
       
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
           url: 'add_education',
           type: 'post',
           dataType: 'json',
           data: $('#add_education').serialize(),
           success: function(result) {
               
                         if(result.status == 'success'){
                            notif(true, result.msg);
                            $('#add_education_info').modal('hide');
                            $('#add_education')[0].reset();
                            $('#emergency').load(document.URL +  ' #emergency');
    
                           }else{
                            notif(false, result.msg);
                           }
                    }
       });
    
       event.preventDefault();
     });
    
    /**Get Education details for update */
     get_edu = function(id){
    
        $.ajax({
            url: 'get_education/'+id,
            type: 'get',
            dataType: 'json',
            data: {id: id},
            success: (function(data){
                $('#einstitution').val(data.institution);
                $('#estart_date').val(data.start_date);
                $('#eend_date').val(data.end_date);
                $('#equalification').val(data.qualification);
                $('#egrade').val(data.grade);
                $('#eid').val(data.id);
            })       
        });
    };
    
    
    /**Update Education */
    $( "#update_education" ).submit(function( event ) {
    
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
        url: 'update_education',
        type: 'post',
        dataType: 'json',
        data: $('#update_education').serialize(),
        success: function(result) {
                      if(result.status == 'success'){
                         notif(true, result.msg);
                         $('#edit_education_info').modal('hide');
                         $('#update_education')[0].reset();
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
    
        $('#delete_education').modal('show');
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