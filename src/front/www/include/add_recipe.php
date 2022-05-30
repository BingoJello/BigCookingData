<div class="modal fade" id="addRecipe" tabindex="-1" role="dialog" aria-labelledby="addRecipe" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 1000px" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button id="close-btn" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Ajoutez une recette</h4>
                </button>
            </div>
            <div class="modal-body">
                <div class="calculator_form">
                    <form class="form-horizontal condensed_form" id="calculator_form" action="./index.php" method="POST">
                        <input type="hidden" name="add_recipe" value="true"/>
                        <fieldset>
                            <div class="form-group row">
                                <label for="name_recipe" class="col-12 col-sm-4 col-form-label">Nom</label>
                                <div class="inline_block col-12 col-sm-7 col-md-7 col-lg-7" id="name">
                                    <input id="name_recipe" name="name" value="" class="form-control inline_block" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-10 col-sm-4 col-form-label label-password-login">Catégorie</label>
                                <div class="inline_block col-12 col-sm-7 col-md-7 col-lg-7 field_wrapper_category">
                                    <div class="row">
                                        <div class="col-10">
                                            <input name="categories[]" value="" class="form-control inline_block">
                                        </div>
                                        <div class="col-2" style="margin-left:-18px">
                                            <a href="javascript:void(0);" style="margin-left:5px" class="add_button_category">
                                                <img src="../img/core-img/add_icon.png" style="height:23px"/>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="url_recipe" class="col-12 col-sm-4 col-form-label label-password-login">Image de la recette (URL)</label>
                                <div class="inline_block col-12 col-sm-7 col-md-7 col-lg-7" id="url_pic">
                                    <input type="url" id="url_recipe" name="url_pic" value="" class="form-control inline_block">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="prep_time_recipe" class="col-12 col-sm-4 col-form-label label-password-login">Temps de préparation</label>
                                <div class="inline_block col-12 col-sm-7 col-md-7 col-lg-7" id="prep_time">
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="number" min="0" value="" name="prep_time1" class="form-control"/>
                                        </div>
                                        <div class="col-2" style="margin-left:-18px">
                                            <label style="margin-top:9px" >heures</label>
                                        </div>
                                        <div class="col-4" style="margin-left:10px">
                                            <input type="number" min="0" max="60" value="" name="prep_time2" class="form-control"/>
                                        </div>
                                        <div class="col-2" style="margin-left:-18px">
                                            <label style="margin-top:9px" >minutes</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cook_time_recipe" class="col-12 col-sm-4 col-form-label label-password-login">Temps de cuisson</label>
                                <div class="inline_block col-12 col-sm-7 col-md-7 col-lg-7" id="cook_time">
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="number" min="0" value="" name="cook_time1" class="form-control"/>
                                        </div>
                                        <div class="col-2" style="margin-left:-18px">
                                            <label style="margin-top:9px" >heures</label>
                                        </div>
                                        <div class="col-4" style="margin-left:10px">
                                            <input type="number" min="0" max="60" value="" name="cook_time2" class="form-control"/>
                                        </div>
                                        <div class="col-2" style="margin-left:-18px">
                                            <label style="margin-top:9px" >minutes</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="break_time_recipe" class="col-12 col-sm-4 col-form-label">Temps de repos</label>
                                <div class="inline_block col-12 col-sm-7 col-md-7 col-lg-7" id="break_time">
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="number" min="0" value="" name="break_time1" class="form-control"/>
                                        </div>
                                        <div class="col-2" style="margin-left:-18px">
                                            <label style="margin-top:9px" >heures</label>
                                        </div>
                                        <div class="col-4" style="margin-left:10px">
                                            <input type="number" min="0" max="60" value="" name="break_time2" class="form-control"/>
                                        </div>
                                        <div class="col-2" style="margin-left:-18px">
                                            <label style="margin-top:9px" >minutes</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="break_time_recipe" class="col-12 col-sm-4 col-form-label">Ingrédients</label>
                                <div class="inline_block col-12 col-sm-7 col-md-7 col-lg-8 field_wrapper_ingredient" id="ingredients">
                                    <div class="row">
                                        <div class="col-2">
                                            <input type="number" min="0" value="" name="quantity[]" class="form-control"/>
                                        </div>
                                        <div class="col-3">
                                            <input type="text" value="g" name="unity[]" class="form-control"/>
                                        </div>
                                        <div class="col-5">
                                            <input type="text" value="ingredient" name="name_ingredient[]" class="form-control"/>
                                        </div>
                                        <div class="col-2" style="margin-left:-18px">
                                            <a href="javascript:void(0);" style="margin-left:5px" class="add_button_ingredient">
                                                <img src="../img/core-img/add_icon.png" style="height:23px"/>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="directions_recipe" class="col-12 col-sm-4 col-form-label">Préparations</label>
                                <div class="inline_block col-12 col-sm-7 col-md-7 col-lg-7 field_wrapper_directions">
                                    <div class="row">
                                        <div class="col-10">
                                            <textarea class="form-control" value="" name="directions[]" rows="5"></textarea>
                                        </div>
                                        <div class="col-2" style="margin-left:-18px">
                                            <a href="javascript:void(0);" style="margin-left:5px" class="add_button_directions">
                                                <img src="../img/core-img/add_icon.png" style="height:23px"/>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="offset-sm-2 col-12 col-sm-8 top_spacer bottom_spacer">
                                <button class="btn btn-lg btn-block btn-orange" id="calculate_button">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    Soumettre
                                </button>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>