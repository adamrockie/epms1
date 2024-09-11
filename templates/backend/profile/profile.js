$(document).ready(function(){

/**Add Emergency */

    $( "#add_emergency" ).submit(function( event ) {
   
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
       url: 'add_emergency',
       type: 'post',
       dataType: 'json',
       data: $('#add_emergency').serialize(),
       success: function(result) {
           
                     if(result.status == 'success'){
                        notif(true, result.msg);
                        $('#emergency_contact_modal').modal('hide');
                        $('#add_emergency')[0].reset();
                        $('#emergency').load(document.URL +  ' #emergency');

                       }else{
                        notif(false, result.msg);
                       }
                }
   });

   event.preventDefault();
 });

/**Get Emergency details for update */
 get_emergency = function(id){

    $.ajax({
        url: 'get_emergency/'+id,
        type: 'get',
        dataType: 'json',
        data: {id: id},
        success: (function(data){
            //$('#add_emergency').modal('show');
            $('#emergency_names').val(data.names);
            $('#emergency_relationship').val(data.relationship);
            $('#emergency_phone_1').val(data.phone_1);
            $('#emergency_phone_2').val(data.phone_2);
            $('#emergency_type_1').val(data.type);
            $('#emergency_id').val(data.id);

            $('#emergency_names2').val(data.names2);
            $('#emergency_relationship2').val(data.relationship2);
            $('#emergency_phone_12').val(data.phone_12);
            $('#emergency_phone_22').val(data.phone_22);
            $('#emergency_type_12').val(data.type2);
            $('#emergency_id2').val(data.id2);

            $('#emergency_ippis').val(data.ippis);
            
        })       
    });
};


/**Update Emergency */
$( "#update_emergency" ).submit(function( event ) {

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
    url: 'update_emergency',
    type: 'post',
    dataType: 'json',
    data: $('#update_emergency').serialize(),
    success: function(result) {
                  if(result.status == 'success'){
                     notif(true, result.msg);
                     $('#update_emergency_contact_modal').modal('hide');
                     $('#update_emergency')[0].reset();
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


/**Get Employee details */
edit_employee = function(id){

    $.ajax({
        url: 'edit_employee/'+id,
        type: 'get',
        dataType: 'json',
        data: {id: id},
        success: (function(data){
            $('#edit_employee').modal('show');

            $('#img_preview').attr("src","uploads/profile_pic/"+data.passport);
            $(".preview img").show();
            $('#eofficial_email1').val(data.official_email);
            $('#epersonal_email2').val(data.personal_email);
            $('#ephone3').val(data.phone);
            
            $('#etitlep').val(data.title).attr('selected', 'selected').change();
            $('#esurname').val(data.surname);
            $('#elastname').val(data.lastname);
            $('#emiddlename').val(data.middlename);
            $('#erank').val(data.rank).attr('selected', 'selected').change();
            $('#eglp').val(data.gl).attr('selected', 'selected').change();
            $('#estep').val(data.step);
            $('#eippis').val(data.ippis);
            $('#eeippis').val(data.ippis);
            $('#efile_no').val(data.file_no);
            $('#esex').val(data.sex).attr('selected', 'selected').change();
            $('#edob').val(data.dob);
            $('#edate_of_1st_appt').val(data.date_of_1st_appt);
            $('#edate_of_confirmation').val(data.date_of_confirmation);
            $('#edate_of_pres_appt').val(data.date_of_pres_appt);  
            $('#estate_origin').val(data.state_origin).attr('selected', 'selected').change();
            //$('#elga').val(data.lga).attr('selected', 'selected').change();
            $('#elga').val(data.lga);
           
               
            
        })       
    });
};


/**Update Employee */
$( "#form_edit_employee" ).submit(function( event ) {

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
    url: 'update_employee',
    data: new FormData(this),
    dataType: 'json',
    contentType: false,
    cache: false,
    processData:false,
    success: function(result) {
        if(result.status == 'success'){
           notif(true, result.msg);
           $('#edit_employee').modal('hide');
           $('#form_edit_employee')[0].reset();
           $('#mcontents').load(document.URL +  ' #mcontents');
           setTimeout(function(){
                window.location.reload(1);
            }, 3000);

          }else{
           notif(false, result.msg);
          }
   }

});

event.preventDefault();
});



$(".select2").select2({
    dropdownParent: $("#form_edit_employee"),
    allowClear: false,
        width: '100%',
});

$(".selectx").select2({
    dropdownParent: $("#doc_upload"),
    allowClear: false,
        width: '100%',
});

 
});