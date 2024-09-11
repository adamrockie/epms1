$(document).ready(function() {


/**Add Employee */


/**Ajax Upload */

    // Submit form data via Ajax
    $("#doc_upload").on('submit', function(e){

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
            url: 'doc_upload',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(result) {
                if(result.status == 'success'){
                   notif(true, result.msg);
                   $('#upload_doc').modal('hide');
                   $('#doc_upload')[0].reset();
                   $('#uploadlistzz').load(document.URL +  ' #uploadlistzz');
                   //location.reload();
                   setTimeout(function(){
                    window.location.reload(1);
                }, 2000);

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



/**Get Employee details */
edit_upload = function(id){

    $.ajax({
        url: 'get_upload/'+id,
        type: 'get',
        dataType: 'json',
        data: {id: id},
        success: (function(data){
            $('#edit_doc').modal('show');            
            $('#etitle').val(data.title);
            $('#eippis').val(data.ippis);
            $('#etype_id').val(data.type_id).attr('selected', 'selected').change();
            $('#edescription').val(data.description);
            $('#uid').val(data.id);
            $('#img_preview').attr("src","uploads/documents/"+data.doc);
            $(".preview img").show();     
        })       
    });
};


/**Update Upload */
$( "#form_edit_doc" ).submit(function( event ) {

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
    url: 'update_upload',
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
           $('#edit_doc').modal('hide');
           $('#form_edit_doc')[0].reset();
           $('#uploadlistzz').load(document.URL +  ' #uploadlistzz');
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


/**Delete Upload */
delete_warning = function(id){

    $('#delete_upload').modal('show');
    let uid = id;        
    delete_upload = function(id){
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
                url: 'delete_upload',
                type: 'POST',
                data: {id: uid},
                dataType: 'json',
                success: function(result){
                    if(result.status == 'success'){
                        notif(true, result.msg);
                        $('#delete_upload').modal('hide');
                        $('#uploadlist').load(document.URL +  ' #uploadlist');
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

/**Toggle Documents */

//$('#toggle').html('<i class="fa fa-bars"></i>');
$('#grids').hide();

$('#toggle').click(function(e){
    $("#uploadlistzz").toggle(
        function(){
            $('#grids').toggle();
            //$('#toggle').html('<i class="fa fa-th"></i>');
        }
    );
    e.preventDefault();

});

/**Search Thumbnails*/
$("#gridsearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".g-body").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });

});