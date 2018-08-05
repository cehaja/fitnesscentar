$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
    $("#cardNumber").on("input", function() {
        checkCardNumber();
    });
});
function checkCardNumber() {
    var card = $("#cardNumber").val();
    //if card number length is 8 auto do ajax
    if(card.length === 8 ){
        $.ajax({
            type:'post',
            url:'/ajaxAttendance',
            data:{'c':card},
            success:function(data){
                if (data.msg == 'error'){
                    $("#error").html('Inserted card number does not exist!!');
                }
                else {
                    $(".table").html(data.msg);
                }
            }
        });

    }
}