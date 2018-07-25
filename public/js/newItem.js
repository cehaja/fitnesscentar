$(document).ready(function(){
    changeSubcategories();
    //on everey change of category remove previous options and add new
    $("#category").change(function () {
        changeSubcategories();
    });
});
//changing subcategory dropdown values so they match category that was picked
function changeSubcategories() {
    $("#subcategory").children().remove();
    $.each(subcategories, function (i,subcategory) {
        if (subcategory[1]==$("#category").val()) {
            $("#subcategory").append($('<option>', {
                value: subcategory[0],
                text: subcategory[2]
            }));
        }
    });
}