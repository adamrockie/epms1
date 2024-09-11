$(document).ready(function() {


/**Add Posting */

/**Ajax Upload */

    // Submit form data via Ajax
    $("#form_add_posting").on('submit', function(e){

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
            url: 'add_posting',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(result) {
                if(result.status == 'success'){
                   notif(true, result.msg);
                   $('#add_posting').modal('hide');
                   $('#form_add_posting')[0].reset();
                   $('#mcontents').load(document.URL +  ' #mcontents');
                    setTimeout(function(){
                        window.location.reload(1);
                    }, 3000);

                  }else{
                   notif(false, result.msg);
                  }
           }

        });

        e.preventDefault();
    });



/**Get Units*/

$('#new_office_id').on('change',function(){
    var office_id = $(this).val();
    if(office_id){
        $.ajax({
            type:'GET',
            url:'get_units/'+office_id,
            data:'office_id='+office_id,
            success:function(html){
                $('#new_unit_id').html(html);
            }
        }); 
    }else{
        $('#new_unit_id').html('<option value="">Select State first</option>');
    }
});


post_staff = function(id){

    $('#staff_id2').val(id);
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
            $('#eofficial_email').val(data.official_email);
            $('#eofficial_email1').val(data.personal_email);
            $('#ephone').val(data.phone);
            
            $('#etitle').val(data.title).attr('selected', 'selected').change();
            $('#esurname').val(data.surname);
            $('#elastname').val(data.lastname);
            $('#emiddlename').val(data.middlename);
            $('#erank').val(data.rank).attr('selected', 'selected').change();
            $('#egl').val(data.egl).attr('selected', 'selected').change();
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
    //beforeSend: function(){
        //$('.submitBtn').attr("disabled","disabled");
       // $('#form_add_employee').css("opacity",".5");
    //},
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


/**Delete Office */
delete_warning = function(id){

    $('#delete_employee').modal('show');
    let ippis = id;        
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
                url: 'delete_employee',
                type: 'POST',
                data: {ippis: ippis},
                dataType: 'json',
                success: function(result){
                    if(result.status == 'success'){
                        notif(true, result.msg);
                        $('#delete_employee').modal('hide');
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