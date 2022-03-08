<?php
?php
include('database.php');
$limit = 4;
$sql = "SELECT COUNT(id) FROM user_data";
$rs_result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($rs_result);
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PHP Pagination AJAX</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Employees</b>Add New Employee</span></a>
						<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons"></i> <span>Delete</span></a>
					</div>
                </div>
            </div>
			<div id="target-content">loading...</div>

			<div class="clearfix">

					<ul class="pagination">
                    <?php

					if(!empty($total_pages)){
						for($i=1; $i<=$total_pages; $i++){
								if($i == 1){
									?>
								<li class="pageitem active" id="<?php echo $i;?>"><a href="JavaScript:Void(0);" data-id="<?php echo $i;?>" class="page-link" ><?php echo $i;?></a></li>

								<?php
								}
								else{
									?>
								<li class="pageitem" id="<?php echo $i;?>"><a href="JavaScript:Void(0);" class="page-link" data-id="<?php echo $i;?>"><?php echo $i;?></a></li>
								<?php
								}
						}
					}
								?>
					</ul>
               </ul>
            </div>
        </div>
    </div>
	<script>
	$(document).ready(function() {
		$("#target-content").load("pagination.php?page=1");
		$(".page-link").click(function(){
			var id = $(this).attr("data-id");
			var select_id = $(this).parent().attr("id");
			$.ajax({
				url: "pagination.php",
				type: "GET",
				data: {
					page : id
				},
				cache: false,
				success: function(dataResult){
					$("#target-content").html(dataResult);
					$(".pageitem").removeClass("active");
					$("#"+select_id).addClass("active");

				}
			});
		});
    });
</script>



 //var recipes = JSON.stringify(<?php echo $recipes_json; ?>);
            var recipes="toto";
            $("#target-content").load("pagination.php", {page:1, recipes:recipes});
            $(".page-link").click(function(){
                var id = $(this).attr("data-id");
                var select_id = $(this).parent().attr("id");
                $.ajax({
                    url: "pagination.php",
                    type: "POST",
                    data: {
                        page : id,
                        recipes : recipes
                    },
                    dataType: 'json',
                    cache: false,
                    success: function(dataResult){
                        $("#target-content").html(dataResult);
                        $(".pageitem").removeClass("active");
                        $("#"+select_id).addClass("active");

                    }
                });
            });








            $k = $limit+$start_from;
for($i=$start_from;$i<$k;$i++){
?>
<div class='col-12 col-sm-6 col-lg-4'>
    <div class='single-best-recipe-area mb-30'>
        <img src=<?php echo $recipes[$i]->getUrlPic();?> width='210' height='210' alt=''>
        <div class='recipe-content'>
            <a href='recipe-post.php'>
                <h5><?php echo $recipes[$i]->getName();?></h5>
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

</body>
</html>