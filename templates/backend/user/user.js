$(document).ready(function(){

    /**Add User */

        $('#user_table').DataTable({
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": true,
        "bAutoWidth": true,
        "order": [[ 0, "desc" ]]
        });   

        $('#selected_names').on('change', function() {
        var ippis = this.value;
            $.ajax({
                url: 'get_user/'+ippis,
                type: 'get',
                dataType: 'json',
                data: {ippis: ippis},
                success: (function(data){ 
                    $('#uemail').val(data.official_email);
                    $('#location').val(data.office_name);
                    $('#office_id').val(data.office_id);                
                })       
            });
        });

        $('#confirm_password').on('keyup', function () {
            if ($('#password').val() == $('#confirm_password').val()) {
                $('#message').html('Matched').css('color', 'green');
            } else 
                $('#message').html('Not matched with Password').css('color', 'red');
        });

        $('#confirm_password').on('blur', function () {
            if ($('#password').val() == $('#confirm_password').val()) {
                $('#message').html('Matched').css('color', 'green');
            } else{
                $('#message').html('Not Matched').css('color', 'red');
                $('#confirm_password').val('');
            }
        });


    $( "#form_add_user" ).submit(function( event ) {
    
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
        url: 'add_user',
        type: 'post',
        dataType: 'json',
        data: $('#form_add_user').serialize(),
        success: function(result) {
                        if(result.status == 'success'){
                            notif(true, result.msg);
                            $('#add_user').modal('hide');
                            $('#form_add_user')[0].reset();
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


    /**Get User's details for update */
    get_user = function(id){

    $.ajax({
                url: 'get_user2/'+id,
                type: 'get',
                dataType: 'json',
                data: {id: id},
                success: (function(data){ 
                    $('#euemail').val(data.email);
                    $('#elocation').val(data.office_name);
                    $('#eoffice_id').val(data.office_id);
                    $('#erole').val(data.group_id).attr('selected', 'selected').change();
                    $('#eselected_names').val(data.ippis).attr('selected', 'selected').change();
                    $('#estatus').val(data.staff_status).attr('selected', 'selected').change();
                })       
            });
        };


    /**Update User */
    $( "#form_edit_user" ).submit(function( event ) {

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
        url: 'post_update_user',
        type: 'post',
        dataType: 'json',
        data: $('#form_edit_user').serialize(),
        success: function(result) {
                    if(result.status == 'success'){
                        notif(true, result.msg);
                        $('#form_edit_user_modal').modal('hide');
                        $('#form_edit_user')[0].reset();
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


    $('#econfirm_password').on('keyup', function () {
        if ($('#epassword').val() == $('#econfirm_password').val()) {
            $('#emessage').html('Matched').css('color', 'green');
        } else 
            $('#emessage').html('Not matched with Password').css('color', 'red');
    });

    $('#econfirm_password').on('blur', function () {
        if ($('#epassword').val() == $('#econfirm_password').val()) {
            $('#emessage').html('Matched').css('color', 'green');
        } else{
            $('#emessage').html('Not Matched').css('color', 'red');
            $('#econfirm_password').val('');
            //$('#econfirm_password').attr("required", true);
        }
    });


    /**Delete User */
    delete_warning = function(id){

        //$('#delete_user_modal').modal('show');
        let ippis = id;        
        delete_user = function(id){
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
                    url: 'delete_user',
                    type: 'POST',
                    data: {ippis: ippis},
                    dataType: 'json',
                    success: function(result){
                        if(result.status == 'success'){
                            notif(true, result.msg);
                            $('#delete_user_modal').modal('hide');
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


    // $(".select").select2({
    //     dropdownParent: $("#form_add_user"),
    //     allowClear: false,
    //         width: '100%',
    // });

    $(".select2").select2({
        dropdownParent: $("#form_edit_user"),
        allowClear: false,
            width: '100%',
    });

    $(".selectx").select2({
        dropdownParent: $("#form_add_user"),
        allowClear: false,
            width: '100%',
    });

 
});