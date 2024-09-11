$(document).ready(function(){

    /**Calculate total requested days*/
    $('#end_date').on('blur', function() {
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var date1 = new Date(start_date);
        var date2 = new Date(end_date);
        var timeDiff = Math.abs(date2.getTime() - date1.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
        $('#days').val(diffDays+1);
    });


    /**Add Leave*/

        $( "#form_add_leave" ).submit(function( event ) {
       
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
           url: 'add_leave',
           type: 'post',
           dataType: 'json',
           data: $('#form_add_leave').serialize(),
           success: function(result) {
               
                         if(result.status == 'success'){
                            notif(true, result.msg);
                            $('#add_leave_modal').modal('hide');
                            $('#form_add_leave')[0].reset();
                            //$('#emergency').load(document.URL +  ' #emergency');
                            location.reload();
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
    

    
    /**View Leave details */
    view_leave = function(id){

        $.ajax({
            url: 'get_leave_details/'+id,
            type: 'get',
            dataType: 'json',
            data: {id: id},
            success: (function(data){
    
                $('#mnames').html(data.leave.employee.surname +' '+ data.leave.employee.lastname +' '+ data.leave.employee.middlename);
                $('#mleave_type').html(data.leave.leavetype.name);
                $('#mlevel').html(data.leave.employee.gl);
                $('#mlocation').html(data.leave.office.name);
                $('#mstart').html(data.leave.start_date);
                $('#mend').html(data.leave.end_date);
                $('#mdays').html(data.leave.days);
                $('#mremark').html(data.leave.remark);
                $('#mstatus').html(data.leave.request_status);    
                $("#mpassport").attr("src",'uploads/profile_pic/'+data.leave.employee.passport); 
                $('#mcomment').html(data.comment.comment);     
                $('#mcomment_by').html(data.comment.author.names);
            })       
        });
    };


    /**Delete Emergency */
delete_lev_warning = function(lid){

    //$('#delete_leave12').modal('show');
    let leave_id = lid;        
    delete_leave = function(id){
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
                url: 'delete_leave',
                type: 'POST',
                data: {leave_id: leave_id},
                dataType: 'json',
                success: function(result){
                    if(result.status == 'success'){
                        notif(true, result.msg);
                        $('#warning').modal('hide');
                        $('#leave_table').load(document.URL +  ' #leave_table');
                        location.reload();
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