
$("#account_number").blur(function(){
    
    var bank    = $("#bank").val();
    var account = $("#account_number").val();

   var theurl = 'https://api.paystack.co/bank/resolve?account_number='+account+'&bank_code='+bank;

    $.ajax({
      url: theurl,
      contentType: "application/json",
      dataType: 'json',    
      headers: {
        Authorization: 'Bearer sk_live_6c30c925cee99f76a3e49ed624e9933ab9f708ba'
      }

    }).done(function(result) {
        $("#account_name").val(result.data.account_name);
    }).fail(function(result) {
      alert("Invalid Account Number or Bank, Please check and try again");
       $("#account_number").val('');
       $("#account_name").val('');

    });
     
}); 

$(document).ready(function(){
    $.ajax({
        url:"https://api.paystack.co/bank",
        contentType: "application/json",
        dataType: 'json',    
      }).done(function(result) {
            var banks = result.data;   
            $.each(banks, function( index, value ) {
                var bcode = value.code;
                var bname = value.name;
                $('#bank').append('<option value="'+bcode+'">'+bname+'</option>');
            });     
      }).fail(function(result) {
            alert("We are sorry, Eazyteller could not fetch Bank list");
      });

});


function currencyFormat(num) {
  return 'N' + num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}



var n1000, n500, n200, n100, n50, n20, n10, n5, 
s1000, s500, s200, s100, s50, s20, s10, s5;

$("#qty1000").ready(function(){
  $("#qty1000").val(0);
});

$("#qty500").ready(function(){
  $("#qty500").val(0);
});

$("#qty200").ready(function(){
  $("#qty200").val(0);
});

$("#qty100").ready(function(){
  $("#qty100").val(0);
});

$("#qty50").ready(function(){
  $("#qty50").val(0);
});

$("#qty20").ready(function(){
  $("#qty20").val(0);
});

$("#qty10").ready(function(){
  $("#qty10").val(0);
});

$("#qty5").ready(function(){
  $("#qty5").val(0);
});



$("#qty1000").blur(function(){

    n1000 = parseInt($("#qty1000").val());
    if (isNaN(n1000)) {
        alert("Only numbers are allowed");
        $("#qty1000").val(0);
        $("#n1000").val(0);
        s1000 = 0;

    }else{
        s1000 = 1000 * n1000;
        $("#n1000").val(s1000);
        
        var fvalue = currencyFormat(s1000);
        $("#n1000").val(fvalue);
        
    }
});

$("#qty500").blur(function(){

  n500 = parseInt($("#qty500").val());
  if (isNaN(n500)) {
      alert("Only numbers are allowed");
      $("#qty500").val(0);
      $("#n500").val(0);
      s500 = 0;

  }else{
      s500 = 500 * n500;
      $("#n500").val(s500);

      var fvalue = currencyFormat(s500);
      $("#n500").val(fvalue);
      
  }
});

$("#qty200").blur(function(){

  n200 = parseInt($("#qty200").val());
  if (isNaN(n200)) {
      alert("Only numbers are allowed");
      $("#qty200").val(0);
      $("#n200").val(0);
      s200 = 0;

  }else{
      s200 = 200 * n200;
      $("#n200").val(s200);

      var fvalue = currencyFormat(s200);
      $("#n200").val(fvalue);

  }
});

$("#qty100").blur(function(){

  n100 = parseInt($("#qty100").val());
  if (isNaN(n100)) {
      alert("Only numbers are allowed");
      $("#qty100").val('');
      $("#n100").val(0);
      s100 = 0;

  }else{
      s100 = 100 * n100;
      $("#n100").val(s100);

      var fvalue = currencyFormat(s100);
      $("#n100").val(fvalue);
  }
});

$("#qty50").blur(function(){

  n50 = parseInt($("#qty50").val());
  if (isNaN(n50)) {
      alert("Only numbers are allowed");
      $("#qty50").val('');
      $("#n50").val(0);
      s50 = 0;

  }else{
      s50 = 50 * n50;
      $("#n50").val(s50);

      var fvalue = currencyFormat(s50);
      $("#n50").val(fvalue);
  }
});

$("#qty20").blur(function(){

  n20 = parseInt($("#qty20").val());
  if (isNaN(n20)) {
      alert("Only numbers are allowed");
      $("#qty20").val('');
      $("#n20").val(0);
      s20 = 0;

  }else{
      s20 = 20 * n20;
      $("#n20").val(s20);

      var fvalue = currencyFormat(s20);
      $("#n20").val(fvalue);
  }
});

$("#qty10").blur(function(){

  n10 = parseInt($("#qty10").val());
  if (isNaN(n10)) {
      alert("Only numbers are allowed");
      $("#qty10").val('');
      $("#n10").val(0);
      s10 = 0;

  }else{
      s10 = 10 * n10;
      $("#n10").val(s10);

      var fvalue = currencyFormat(s10);
      $("#n10").val(fvalue);
  }
});

$("#qty5").blur(function(){

  n5 = parseInt($("#qty5").val());
  if (isNaN(n5)) {
      alert("Only numbers are allowed");
      $("#qty5").val('');
      $("#n5").val(0);
      s5 = 0;

  }else{
      s5 = 5 * n5;
      $("#n5").val(s5);

      var fvalue = currencyFormat(s5);
      $("#n5").val(fvalue);
  }
});






