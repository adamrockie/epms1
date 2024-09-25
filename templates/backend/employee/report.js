$(document).ready(function() {


/**Report */

/**Ajax Upload */

    // Submit form data via Ajax
    $("#form_add_employee").on('submit', function(e){

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
            url: 'postreport',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(result) {
                if(result.status == 'success'){
                   notif(true, result.msg);
                   $('#add_employee').modal('hide');
                   $('#form_add_employee')[0].reset();
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

    // File type validation
    $("#passport").change(function() {
        var file = this.files[0];
        var fileType = file.type;
        var match = ['image/jpeg', 'image/png', 'image/jpg'];
        if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) )){
            alert('Sorry, JPG, JPEG, & PNG files are allowed to upload.');
            $("#passport").val('');
            return false;
        }
    });


/**Get LGA Details */

$('#state_origin').on('change',function(){
    var stateID = $(this).val();
    if(stateID){
        $.ajax({
            type:'GET',
            url:'get_lga/'+stateID,
            data:'state_id='+stateID,
            success:function(html){
                $('#lga').html(html);
            }
        }); 
    }else{
        $('#lga').html('<option value="">Select State first</option>');
    }
});

$('#estate_origin').on('change',function(){
    var stateID = $(this).val();
    if(stateID){
        $.ajax({
            type:'GET',
            url:'get_lga/'+stateID,
            data:'state_id='+stateID,
            success:function(html){
                $('#elga').html(html);
            }
        }); 
    }else{
        $('#elga').html('<option value="">Select State first</option>');
    }
});


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
            $('#ephone').val(data.phone);
            
            $('#etitle').val(data.title).attr('selected', 'selected').change();
            $('#esurname').val(data.surname);
            $('#elastname').val(data.lastname);
            $('#emiddlename').val(data.middlename);
            $('#erank').val(data.rank).attr('selected', 'selected').change();
            $('#egl').val(data.gl).attr('selected', 'selected').change();
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


$(".select").select2({
    dropdownParent: $("#add_employee"),
    allowClear: false,
     width: '100%',
     theme: "classic"
});

$(".select_edit").select2({
dropdownParent: $("#edit_employee"),
allowClear: false,
    width: '100%',
    theme: "classic"
});
 
});