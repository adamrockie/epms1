$(document).ready(function() {


/**Add Discipline */

    $("#form_add_query").on('submit', function(e){

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
            url: 'add_discipline',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(result) {
                if(result.status == 'success'){
                   notif(true, result.msg);
                   $('#add_query').modal('hide');
                   $('#form_add_query')[0].reset();
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


/**Get Discipline details */
get_discipline = function(id){

    $.ajax({
        url: 'get_discipline/'+id,
        type: 'get',
        dataType: 'json',
        data: {id: id},
        success: (function(data){           
            $('#dis_title').html(data.title);
            $('#dis_content').html(data.content);
            $('#dis_status').html(data.dis_status);    
        })       
    });
};

edit_discipline = function(id){

    $.ajax({
        url: 'get_discipline/'+id,
        type: 'get',
        dataType: 'json',
        data: {id: id},
        success: (function(data){
            $('#eetitle').val(data.title);
            $('#eecontent').val(data.content);
            $('#euniqid').val(data.uniqid);
            $('#eestatus').val(data.dis_status).attr('selected', 'selected').change();     
        })       
    });
};


/**Update Discipline */
$( "#form_edit_query" ).submit(function( event ) {

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
    url: 'update_discipline',
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
           $('#edit_discipline').modal('hide');
           $('#form_edit_query')[0].reset();
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
delete_des_warning = function(id){

    $('#delete_discipline').modal('show');
    let uid = id;        
    delete_discipline = function(id){
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
                url: 'delete_discipline',
                type: 'POST',
                data: {id: uid},
                dataType: 'json',
                success: function(result){
                    if(result.status == 'success'){
                        notif(true, result.msg);
                        $('#delete_discipline').modal('hide');
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