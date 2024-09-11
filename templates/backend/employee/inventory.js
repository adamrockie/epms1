$(document).ready(function() {


    /**Add Employee */
    
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
                url: 'add_employee',
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
        $("#upload").change(function() {
            var file = this.files[0];
            var fileType = file.type;
            var match = ['image/jpeg', 'image/png', 'image/jpg'];
            if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) )){
                alert('Sorry, JPG, JPEG, & PNG files are allowed to upload.');
                $("#upload").val('');
                return false;
            }
        });
       
    
    /**Get Employee details */
    edit_inventory = function(id){
    
        $.ajax({
            url: 'edit_inventory/'+id,
            type: 'get',
            dataType: 'json',
            data: {id: id},
            success: (function(data){
                $('#edit_employee').modal('show');
    
                $('#img_preview').attr("src","uploads//"+data.upload);
                $(".preview img").show();

                $('#einventory').val(data.inventory);
                $('#einventoryid').val(data.inventoryid);
                $('#estatus').val(data.cstatus).attr('selected', 'selected').change();
                $('#ewarranty').val(data.warranty).attr('selected', 'selected').change();
                $('#edate').val(data.date);
                $('#eupload').val(data.upload);               
                   
                
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
    dropdownParent: $("#edit_inventory"),
    allowClear: false,
        width: '100%',
        theme: "classic"
    });
     
    });