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
    if(card.length === 8){
        $.ajax({
            type:'post',
            url:'/ajaxAttendance',
            data:{'c':card},
            success:function(data){
                $(".table").html(data.msg);
            }
        });

    }
    console.log(card);
}