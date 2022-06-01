var addButtonIngredient = $('.add_button_ingredient');
var wrapperIngredient = $('.field_wrapper_ingredient');

var addButtonCategory = $('.add_button_category');
var wrapperCategory = $('.field_wrapper_category');

var addButtonDirections = $('.add_button_directions');
var wrapperDirections = $('.field_wrapper_directions');

var fieldHTMLIngredient = '<div style="margin-top:6px"  class="row">' +
    '<div class="col-2"> <input type="number" value="0" name="quantity[]" class="form-control"/></div>' +
    '<div class="col-3">' +
    '<input type="text" value="g" name="unity[]" class="form-control"/></div>' +
    '<div class="col-5"> ' +
    '<input type="text" value="ingredient" name="name_ingredient[]" class="form-control"/></div>' +
    '<div class="col-2" style="margin-left:-18px">' +
    '<a href="javascript:void(0);" style="margin-left:1px" class="remove_button"> ' +
    '<img style="height:33px" src="../img/core-img/delete_icon.png"/></a></div></div>';

$(addButtonIngredient).click(function(){
    $(wrapperIngredient).append(fieldHTMLIngredient);
});

$(wrapperIngredient).on('click', '.remove_button', function(e){
    e.preventDefault();
    $(this).parent('div').parent('div').remove();
});

var fieldHTMLCategory = '<div style="margin-top:6px" class="row">' +
    '<div class="col-10"><input name="categories[]" class="form-control inline_block"> </div>' +
    '<div class="col-2" style="margin-left:-18px">' +
    '<a href="javascript:void(0);" style="margin-left:1px" class="remove_button">' +
    '<img style="height:33px" src="../img/core-img/delete_icon.png"/>' +
    '</a></div></div>';

$(addButtonCategory).click(function(){
    $(wrapperCategory).append(fieldHTMLCategory); //Add field html
});

$(wrapperCategory).on('click', '.remove_button', function(e){
    e.preventDefault();
    $(this).parent('div').parent("div").remove();
});


var fieldHTMLDirections = '<div style="margin-top:6px" class="row"><div class="col-10">' +
    '<textarea class="form-control" rows="5" name="directions[]"></textarea></div>' +
    '<div class="col-2" style="margin-left:-18px">' +
    '<a href="javascript:void(0);" style="margin-left:1px" class="remove_button">' +
    '<img style="height:33px" src="../img/core-img/delete_icon.png"/>' +
    '</a></div></div>';

$(addButtonDirections).click(function(){
    $(wrapperDirections).append(fieldHTMLDirections); //Add field html
});

$(wrapperDirections).on('click', '.remove_button', function(e){
    e.preventDefault();
    $(this).parent('div').parent("div").remove();
});