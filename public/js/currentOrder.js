$(document).ready(function () {
    var total = 0;
   $(".itemPrice").each(function () {
       var price =$(this).text();
        total+= parseFloat(price);
   });
   $("#price").html(total + ' €');
});