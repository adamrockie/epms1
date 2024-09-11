$(document).ready(function(){

    /**Change Password*/
    $( "#change_password" ).submit(function( event ) {
    
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
        url: 'post_change_password',
        type: 'post',
        dataType: 'json',
        data: $('#change_password').serialize(),
        success: function(result) {
                        if(result.status == 'success'){
                            notif(true, result.msg);
                            setTimeout(function(){ 
                                //window.location.reload(1);
                                window.location.href = "dashboard";
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


    $('#current_password').on('blur', function (event) {

        $.ajax({
            url: 'checkpassword',
            type: 'post',
            dataType: 'json',
            data: $('#change_password').serialize(),
            success: function(result) {
                //console.log(result);
                            if(result == false){
                                $('#cmessage').html('Wrong Password').css('color', 'red');
                                $('#current_password').val('');
                            }else{
                                $('#cmessage').html('Correct').css('color', 'green');
                            }
                        }
        });
    
        event.preventDefault();

    });



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