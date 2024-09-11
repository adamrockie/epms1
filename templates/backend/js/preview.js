

$(document).ready(function(){

    var selected_bdcode = $("#bank").val();

    $.ajax({
        url:"https://api.paystack.co/bank",
        contentType: "application/json",
        dataType: 'json',    
      }).done(function(result) {
            var banks = result.data;   
            $.each(banks, function( index, value ) {
                var bcode = value.code;
                var bname = value.name;
                if(selected_bdcode === bcode){
                    $('#bank').val(bname);
                }
                
            });     
      }).fail(function(result) {
            alert("We are sorry, Eazyteller could not fetch Bank list");
      });

});


function currencyFormat(num) {
    return 'N' + num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}


$("#amount_number").ready( function(){

var s1000 = $("#qty1000").val() *1000;
var s500  = $("#qty500").val()  *500;
var s200  = $("#qty200").val()  *200;
var s100  = $("#qty100").val()  *100;
var s50   = $("#qty50").val()   *50;
var s20   = $("#qty20").val()   *20;
var s10   = $("#qty10").val()   *10;
var s5    = $("#qty5").val()    *5;

var total = s1000 + s500 + s200 + s100 + s50 + s20 + s10 +s5;

//alert(s50);
tsum = currencyFormat(total);
$("#amount_number").val(tsum);

var word = numberToWords.toWords(total);
var formatedword = word + ' naira only';
    $("#amount_word").val(formatedword);
    $("#amount_word").css("text-transform", "capitalize");

});


var s1000 = $("#qty1000").val();
if(isNaN(s1000) || s1000<1){
    $("#jq1000").hide(); 
}
var s500 = $("#qty500").val();
if(isNaN(s500) || s500<1){
    $("#jq500").hide(1000); 
}
var s200 = $("#qty200").val();
if(isNaN(s200) || s200<1){
    $("#jq200").hide(1000); 
}
var s100 = $("#qty100").val();
if(isNaN(s100) || s100<1){
    $("#jq100").hide(1000); 
}
var s50 = $("#qty50").val();
if(isNaN(s50) || s50<1){
    $("#jq50").hide(1000); 
}
var s20 = $("#qty20").val();
if(isNaN(s20) || s20<1){
    $("#jq20").hide(1000); 
}
var s10 = $("#qty10").val();
if(isNaN(s10) || s10<1){
    $("#jq10").hide(1000); 
}
var s5 = $("#qty5").val();
if(isNaN(s5) || s5<1){
    $("#jq5").hide(1000); 
}