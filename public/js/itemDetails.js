$(document).ready(function(){
    $('#plus').click(function(e){
        // Get the field name
        var quantity = quantityValue();
        // If is not undefined
        $('#quantity').val(quantity + 1);
        // Increment

    });

    $('#minus').click(function(e){
        // Get the field name
        var quantity = quantityValue();
        // If is not undefined
        // Increment
        if(quantity>0){
            $('#quantity').val(quantity - 1);
        }
    });

});

function quantityValue() {
    if(isNaN(parseInt($('#quantity').val()))){
        return 0;
    }
    return parseInt($('#quantity').val());
}