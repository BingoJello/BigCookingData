<div class="modal fade" id="postCommentaryIHM" tabindex="-1" role="dialog" aria-labelledby="postCommentaryIHM" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button id="close-btn" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Evaluation</h4>
            </div>
            <div class="modal-body">
                <?php if(true == hasAlreadyRatingRecipe($client->getId(), $recipe->getId())) { ?>
                <div class="row">
                    <div class="col-12">
                        <div class="section-heading text-left">
                            <h3>Vous avez déjà évalué cette recette</h3>
                        </div>
                    </div>
                </div>
                <?php }else{ ?>
                <div class="row">
                    <div class="col-12">
                        <div class="section-heading text-left">
                            <h3>Donnez une note</h3>
                        </div>
                    </div>
                </div>
                <form action='./recipe-post.php' method='POST'>
                    <div class=" row opinion-content">
                        <div class="star-widget">
                            <input type="hidden" name="date" value=<?php echo date("d/m/Y");?>>
                            <input type="hidden" name="recipe" value=<?php echo $recipe->getId();?>>
                            <input class="input-star" type="radio" name="rate" id="rate-5" value="5">
                            <label for="rate-5" class="fas fa-star"></label>
                            <input class="input-star" type="radio" name="rate" id="rate-4" value="4">
                            <label for="rate-4" class="fas fa-star"></label>
                            <input class="input-star" type="radio" name="rate" id="rate-3" value="3">
                            <label for="rate-3" class="fas fa-star"></label>
                            <input class="input-star" type="radio" name="rate" id="rate-2" value="2">
                            <label for="rate-2" class="fas fa-star"></label>
                            <input class="input-star" type="radio" name="rate" id="rate-1" value="1">
                            <label for="rate-1" class="fas fa-star"></label>
                            <div class="header-star"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="section-heading text-left">
                                <h3>Laisser un commentaire</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="contact-form-area">
                                <div class="row">
                                    <div class="col-12">
                                        <textarea name="commentary" class="form-control" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn delicious-btn mt-30" type="submit">Post Comments</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php } ?>
        </div>
    </div>
</div>