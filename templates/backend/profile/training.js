$(document).ready(function(){

    /**Add Training*/
    
        $( "#add_training_form" ).submit(function( event ) {
       
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
            url: 'add_training',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(result) {
                if(result.status == 'success'){
                notif(true, result.msg);
                $('#add_training_info').modal('hide');
                $('#add_training_form')[0].reset();
                //$('#uploadlistzz').load(document.URL +  ' #uploadlistzz');
                //location.reload();
                setTimeout(function(){
                    window.location.reload(1);
                }, 1000);

                }else{
                notif(false, result.msg);
                }
        }

        });
    
       event.preventDefault();
     });
    
    // /**Get Education details for update */
    //  get_edu = function(id){
    
    //     $.ajax({
    //         url: 'get_education/'+id,
    //         type: 'get',
    //         dataType: 'json',
    //         data: {id: id},
    //         success: (function(data){
    //             $('#einstitution').val(data.institution);
    //             $('#estart_date').val(data.start_date);
    //             $('#eend_date').val(data.end_date);
    //             $('#equalification').val(data.qualification);
    //             $('#egrade').val(data.grade);
    //             $('#eid').val(data.id);
    //         })       
    //     });
    // };
    
    
    // /**Update Education */
    // $( "#update_education" ).submit(function( event ) {
    
    //     let notif = (val,msg) => {
    //         if(val){
    //             PNotify.success({
    //                 title: 'Success!',
    //                 text: msg,
    //               });
    //         }else{
    //             PNotify.error({
    //                 title: 'Error!',
    //                 text: msg,
    //               });
    //         }
    //     };
    
    // $.ajax({
    //     url: 'update_education',
    //     type: 'post',
    //     dataType: 'json',
    //     data: $('#update_education').serialize(),
    //     success: function(result) {
    //                   if(result.status == 'success'){
    //                      notif(true, result.msg);
    //                      $('#edit_education_info').modal('hide');
    //                      $('#update_education')[0].reset();
    //                      $('#emergency').load(document.URL +  ' #emergency');
    
    //                     }else{
    //                      notif(false, result.msg);
    //                     }
    //              }
    // });
    
    // event.preventDefault();
    // });
    
    /**Delete Training */
    delete_t_warning = function(id){
    
        $('#delete_training').modal('show');
        let training_id = id;        
        delete_training = function(id){
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
                    url: 'delete_training',
                    type: 'POST',
                    data: {training_id: training_id},
                    dataType: 'json',
                    success: function(result){
                        if(result.status == 'success'){
                            notif(true, result.msg);
                            $('#delete_training').modal('hide');
                            setTimeout(function(){
                                window.location.reload(1);
                            }, 1000);

                        }else{
                         notif(false, result.msg);
                        }
                    }
                });
            }
        };
    };
    
    
    
    
     
    });