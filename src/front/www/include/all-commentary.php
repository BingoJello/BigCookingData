<div class="modal fade" id="allCommentaryIHM" tabindex="-1" role="dialog" aria-labelledby="allCommentaryIHM" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button id="close-btn" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Commentaires (<?php echo count($assessed_recipe)?>)</h4>
            </div>
            <div class="modal-body">
            <?php
                foreach($assessed_recipe as $assess){
                    ?>
                    <div class="commentary">
                        <div class="name-rating-container">
                            <div class="name-rating">
                                <div class="pseudo">
                                    <p class="name-pseudo"><?php echo $assess->getPseudo();?></p>
                                </div>
                                <div class="rating-commentary">
                                <?php
                                    $rating = $assess->getScore();

                                    for($i=0; $i<5; $i++){
                                        if($rating > 0){?>
                                            <i class="fa fa-star" style="color:yellowgreen" aria-hidden="true"></i>
                                    <?php
                                            $rating--;
                                        }else{?>
                                            <i class="fa fa-star" style="color:grey" aria-hidden="true"></i>
                                    <?php
                                        }
                                    }?>
                                    <label><?php echo $assess->getScore();?>/5</label>
                                </div>
                            </div>
                        </div>
                        <div class="date-commentary">
                            <p class="date-commentary-font"><?php echo $assess->getDate();?></p>
                        </div>
                        <div class="commentary-text">
                            <p class="commentary-text-font"><?php echo $assess->getCommentary();?></p>
                        </div>
                    </div>
                    <hr>
            <?php
                }
            ?>
            </div>
        </div>
    </div>
</div>