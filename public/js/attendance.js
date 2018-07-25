$(document).ready(function(){
    $("#cardNumber").on("input", function() {
        checkCardNumber();
    });
});
function checkCardNumber() {
    var card = $("#cardNumber").val();
    if(card.length === 8){
        $("form#form").submit();
    }
    console.log(card.length);
}