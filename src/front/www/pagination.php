<?php
    include('../../back/utils/constants.php');

    $limit = LIMIT_PAGINATION;

    if (isset($_POST["page"])) {
        $page  = $_POST["page"];
    } else {
    $page=1;
    }

    $start_from = ($page-1) * $limit;

    if (isset($_POST["recipes"])) {
        $recipes = html_entity_decode($_POST["recipes"]);
        $recipes = json_decode($recipes);
    }

    $k = $limit+$start_from;

    for($i=$start_from;$i<$k;$i++){
        if(!isset($recipes[$i])){
            break;
        }
        ?>
        <div class='col-12 col-sm-6 col-lg-4'>
            <div class='single-best-recipe-area mb-30'>
                <img src=<?php echo $recipes[$i]->url_pic;?> width='210' height='210' alt=''>
                <div class='recipe-content'>
                    <a href='recipe-post.php'>
                        <h5><?php echo $recipes[$i]->name;?></h5>
                    </a>
                    <div class='ratings'>
                        <i class='fa fa-star' aria-hidden='true'></i>
                        <i class='fa fa-star' aria-hidden='true'></i>
                        <i class='fa fa-star'' aria-hidden='true'></i>
                        <i class='fa fa-star' aria-hidden='true''></i>
                        <i class='fa fa-star-o' aria-hidden='true'></i>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>
