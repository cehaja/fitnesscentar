$(document).ready(function () {
    selectedCategory();
    selectedSubcategory();
    $("#image").change(function(){
        readURL(this);
    });
});
//selecting current category and subcategory of item
function selectedCategory() {
    $("#category").val(categoryID).prop('selected', true);
}
function selectedSubcategory() {
    $("#subcategory").val(subcategoryID).prop('selected', true);
}

//showing upload image in view
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#itemImage').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}