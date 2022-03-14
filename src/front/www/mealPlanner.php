<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- Title -->
    <title>Delicioso! | Meal Planner</title>
    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.ico">
    <!-- Core Stylesheet -->
	<link rel="stylesheet" href="../css/etm1.css">
	<link rel="stylesheet" href="../css/css_libs1.css">
	<link rel="stylesheet" href="../css/style_meal_planner.css">
</head>

<body>
	 <!-- Preloader -->
    <div id="preloader">
        <i class="circle-preloader"></i>
        <img src="../img/core-img/salad.png" alt="">
    </div>

    <!-- Search Wrapper -->
    <div class="search-wrapper">
        <!-- Close Btn -->
        <div class="close-btn"><i class="fa fa-times" aria-hidden="true"></i></div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="./recipes.php" method="post">
                        <input type="search" name="search" placeholder="Tapez un mot-clé...">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

   <?php include("./include/header.php");?>
	
	<!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(../img/bg-img/breadcumb1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Meal Planner</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
    <section class="best-recipe-area section-padding-80 container">
        <div class="container">			
			<div class="row">
				<div class="generator_header col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
					<div class="preset_selector-div">
						<ul class="mt-4 nav nav-pills preset_selector no-gutters text-center">
							<li style="border-radius:30px;" id="li-anything" class="nav-item col-3 col-sm-2" data-value="anything">
								<a class="nav-link" href="javascript:void(0);" onclick="anything()">
									<img src="../img/meal-planner-img/sandwich.png"  width="45" height="45" alt="">
									<label id="label-anything" style="width:70px">Anything</label>
								</a>
							</li>
							<li style="border-radius:30px;" class="nav-item col-3 col-sm-2" id="li-paleo" data-value="paleo">
								<a class="nav-link" href="javascript:void(0);" onclick="paleo()">
									<img src="../img/meal-planner-img/paleo.png"  width="45" height="45" alt="">
									<label id="label-paleo">Paleolithic</label>
								</a>
							</li>			
							<li style="border-radius:30px;" class="nav-item col-3 col-sm-2" id="li-vegetarian" data-value="vegetarian">
								<a class="nav-link" href="javascript:void(0);" onclick="vegetarian()">
									<img src="../img/meal-planner-img/vegetarian.png"  width="45" height="45" alt="">
									<label id="label-vegetarian">Vegetarian</label>
								</a>
							<li style="border-radius:30px;" class="nav-item col-3 col-sm-2" id="li-veganism" data-value="vegan">
								<a class="nav-link" href="javascript:void(0);" onclick="veganism()">
									<img src="../img/meal-planner-img/vegan.png"  width="45" height="45" alt="">
									<label id="label-veganism" style="width:70px">Veganism</label>
								</a>
							</li>
							<li style="border-radius:30px;" class="nav-item col-3 col-sm-2" id="li-ketogenic" data-value="ketogenic">
								<a class="nav-link" href="javascript:void(0);" onclick="ketogenic()">
									<img src="../img/meal-planner-img/ketogenic.png"  width="45" height="45" alt="">
									<label id="label-ketogenic" style="width:70px">Ketogenic</label>
								</a>
							</li>					
							<li style="border-radius:30px;" class="nav-item col-3 col-sm-2" id="li-cretois" data-value="mediterranean">
								<a class="nav-link" href="javascript:void(0);" onclick="cretois()">
									<img src="../img/meal-planner-img/mediterranean.png"  width="45" height="45" alt="">
									<label id="label-cretois" style="width:70px">Crétois</label>
								</a>
							</li>
						</ul>
					</div>
					<div class="row form-group small_top_spacer" style="margin-top:2em">
						<label class="col-12 col-sm-3 col-md-4 col-lg-5 text-alignement col-form-label text-sm-right">
							I want to eat
						</label>
						<div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
							<input id="cal_input" class="form-control calorie-input text-md-right" type="number" min="0" max="20000" step="100" 
								placeholder="###" value="1152">
							<label id="cal-input-label" for="cal_input">Calories</label>
							<a href="#" data-toggle="modal" data-target="#nutritionIHM" id="not_sure_button" class="orange_link">
								<i class="fa fa-calculator" aria-hidden="true"></i>
								Not sure ?
							</a>
						</div>
					</div>
					<div class="row form-group">
						<label class="col-12 col-sm-3 col-md-4 col-lg-5 text-sm-right col-form-label" for="num_meals_selector">In</label>
						<div class="col-12 col-sm-9 col-md-6 col-lg-6 col-xl-5">
							<select id="num_meals_selector" class="form-control num_meals_selector">
								<option value="1">1 meal </option>
								<option value="2">2 meals </option>
								<option value="3">3 meals </option>
								<option value="4">4 meals </option>
								<option value="5">5 meals </option>
								<option value="6">6 meals </option>
								<option value="7">7 meals </option>
								<option value="8">8 meals </option>
							</select>
						</div>
					</div>				
					<div class="row form-group small_top_spacer">
						<div class="col-12 col-md-3 offset-md-4 offset-lg-5">
							<button class="btn btn-lg btn-block btn-orange gen_button" id="generate-btn" type="submit" data-loading-text="Generate">
								Generate
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container day_plan_container show_meals_as_cards" style="margin-top:30px">
			<div class="row">
				<div class="col-10 offset-1 col-md-8 offset-md-2 offset-lg-1 col-lg-6" style="margin:0 auto">
					<div class="row">
						<div class="day_header col-12">
							<div class="row">
								<div class="day_title col-auto mr-auto">
									Today's meal plan
								</div>
								<div class="day_icons col-auto">
									<div class="day_refresh_button svg-button inline-block" style="vertical-align: middle;" data-original-title="" >
										<span style="cursor:pointer;">Regenerate</span>
										<i class="fa fa-refresh" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
						
						<div class="wrapper">

						<div class="single_day_view col-12">
							<div class="workspace_area">
								<div class="workspace_stats">
									<div>
										<div class="row">
											<div id="details_nutrition_meal_planner" class="plan_stats_popover col-12" data-original-title="" title="" aria-describedby="popover799577">
												<div class="plan_spark_chart" style="padding: 0px; position: relative;">
													<canvas id="myChart"></canvas>
												</div>
												<div class="plan_calories text-medium"> 1200 calories</div>
												<div class="view_nutrition">
													<i class="fa fa-info-circle" aria-hidden="true"></i>
													<span>Details</span>
												</div>
											</div>
										</div>
										<div id="popover645179" class="popover fade bs-popover-right show" 
											 style="z-index: 1039; will-change: transform; position: absolute; display:none;transform: translate3d(293px, 5px, 0px); top: 0px; left: 0px;"
											 role="tooltip" 
											 x-placement="right">
											 
											 <div class="arrow" style="top: 15px;"></div>
											 <div class="popover-body">
												<div class="close-stats-popover">
													<button id="close-popover" class="close" onclick="closePopover()"
															type="button"
															aria-hidden="true">x
													</button>
												</div>
												<div class="row">
													<div class="col text-center cumulative_graph_header"> 
														Percent calories from
													</div>
												</div>
												<div class="cumulative_graph" style="padding: 0px;">
													<canvas id="myChart2"></canvas>
												</div>	
												<div class="row nutrition-row">
													<div class="col-7 col-xl-6 current-stats-col pr-0 px-xl-3">
														<div class="row">
															<div class="col-12 nutrition-header text-center small_bottom_spacer">
																Current totals
															</div>
														</div>
														<div class="row calories-row">
															<div class="col-auto mr-auto">Calories</div>
															<div class="col-auto">1269</div>
														</div>
														<div class="row carbs-col">
															<div class="col-auto mr-auto pr-0">Carbs</div>
															<div class="col-auto pl-0">163.3g</div>
														</div>
														<div class="row fats-col">
															<div class="col-auto mr-auto">Fat</div>
															<div class="col-auto">58.8g</div>
														</div>
														<div class="row proteins-col">
															<div class="col-auto mr-auto">Protein</div>
															<div class="col-auto">37.2g</div>
														</div>
														<div class="row nutrient-row small_top_spacer">
															<div class="col-auto mr-auto">Fiber</div>
															<div class="col-auto">41.7g</div>
														</div>
														<div class="row nutrient-row">
															<div class="col-auto mr-auto">Net carbs</div>
															<div class="col-auto">121.6g</div>
														</div>
														<div class="row nutrient-row small_top_spacer">
															<div class="col-auto mr-auto">Sodium</div>
															<div class="col-auto">2254mg</div>
														</div>
														<div class="row nutrient-row">
															<div class="col-auto mr-auto">Cholesterol</div>
															<div class="col-auto">8mg</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="meal_list meal_list_border col-12">
										<div>
											<div class="meal_box meal_container row">
												<div class="col-12 meal_header align-items-center">
													<div class="row">
														<div class="col-auto">
															<div class="row">
																<div class="col-auto text-dark-gray text-large text-strong print_meal_title wrap_or_truncate pr-0">
																	Breakfast
																</div>
															</div>
															<div class="row">
																<div class="col-auto meal_stats">
																	<div>
																		<span class="cal_amount text-small text-light-gray" 
																			  data-original-title=""
																			  title="">
																			592 Calories
																		</span>
																	</div>
																</div>
															</div>
														</div>
														<div class="ml-auto col-auto meal_bar meal_icons">
															<div class="meal_refresh_btn inline-block" title="Regenerate this meal">
																<div class="svg-button">
																	<i class="fa fa-refresh" aria-hidden="true"></i>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="meal_content col-12">
													<div class="row meal_foods_row">
														<ul class="meal_foods col-12 collection-list" tabindex="0">
															<li class="diet_draggable" id="toogle000001">
																
																<div class="food_box col-12">
																	<div class="row food_object_row align-items-center">
																		<div class="food_image_column">
																			<div class="food_image" style=";background-size:auto 50px;">
																				<img src="../img/core-img/salad.png" alt="">
																			</div>
																		</div>
																		<div class="food_right_column">
																			<div class="row">
																				<div class="food_name col-12">
																					<div class="print_name">
																						Poulet sauté à l'ail et au persil du canada
																					</div>
																				</div>
																				<div class="food_units col-12">
																					<span class="amount_input">2 bowls</span>
																				</div>
																			</div>
																			<div class="food_buttons_col">
																				<div class="food_refresh svg-button" title="Regenerate this food">
																					<i class="fa fa-refresh" aria-hidden="true"></i>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</li>
														</ul>					
													</div>
												</div>
												<div class="col-12 meal_note"></div>
											</div>
											
											<div class="meal_box meal_container row">
												<div class="col-12 meal_header align-items-center">
													<div class="row">
														<div class="col-auto">
															<div class="row">
																<div class="col-auto text-dark-gray text-large text-strong print_meal_title wrap_or_truncate pr-0">
																	Lunch
																</div>
															</div>
															<div class="row">
																<div class="col-auto meal_stats">
																	<div>
																		<span class="cal_amount text-small text-light-gray" 
																			  data-original-title=""
																			  title="">
																			592 Calories
																		</span>
																	</div>
																</div>
															</div>
														</div>
														<div class="ml-auto col-auto meal_bar meal_icons">
															<div class="meal_refresh_btn inline-block" title="Regenerate this meal">
																<div class="svg-button">
																	<i class="fa fa-refresh" aria-hidden="true"></i>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="meal_content col-12">
													<div class="row meal_foods_row">
														<ul class="meal_foods col-12 collection-list" tabindex="0">
															<li class="diet_draggable" data-model-cid="c1563" data-original-title="" title="">
																<div class="food_box col-12">
																	<div class="row food_object_row align-items-center">
																		<div class="food_image_column">
																			<div class="food_image" style=";background-size:auto 50px;">
																				<img src="../img/bg-img/bg6.jpg" alt="">
																			</div>
																		</div>
																		<div class="food_right_column">
																			<div class="row">
																				<div class="food_name col-12">
																					<div class="print_name">
																						Pates carbonara
																					</div>
																				</div>
																				<div class="food_units col-12">
																					<span class="amount_input">2 bowls</span>
																				</div>
																			</div>
																			<div class="food_buttons_col">
																				<div class="food_refresh svg-button" title="Regenerate this food">
																					<i class="fa fa-refresh" aria-hidden="true"></i>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</li>
														</ul>					
													</div>
												</div>
												<div class="col-12 meal_note"></div>
											</div>
											
											<div class="meal_box meal_container row">
												<div class="col-12 meal_header align-items-center">
													<div class="row">
														<div class="col-auto">
															<div class="row">
																<div class="col-auto text-dark-gray text-large text-strong print_meal_title wrap_or_truncate pr-0">
																	Dinner
																</div>
															</div>
															<div class="row">
																<div class="col-auto meal_stats">
																	<div>
																		<span class="cal_amount text-small text-light-gray" 
																			  data-original-title=""
																			  title="">
																			592 Calories
																		</span>
																	</div>
																</div>
															</div>
														</div>
														<div class="ml-auto col-auto meal_bar meal_icons">
															<div class="meal_refresh_btn inline-block" title="Regenerate this meal">
																<div class="svg-button">
																	<i class="fa fa-refresh" aria-hidden="true"></i>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="meal_content col-12">
													<div class="row meal_foods_row">
														<ul class="meal_foods col-12 collection-list" tabindex="0">
															<li class="diet_draggable" data-model-cid="c1563" data-original-title="" title="">
																<div class="food_box col-12">
																	<div class="row food_object_row align-items-center">
																		<div class="food_image_column">
																			<div class="food_image" style=";background-size:auto 50px;">
																				<img src="../img/core-img/salad.png" alt="">
																			</div>
																		</div>
																		<div class="food_right_column">
																			<div class="row">
																				<div class="food_name col-12">
																					<div class="print_name">
																						Burger maison
																					</div>
																				</div>
																				<div class="food_units col-12">
																					<span class="amount_input">2 bowls</span>
																				</div>
																			</div>
																			<div class="food_buttons_col">
																				<div class="food_refresh svg-button" title="Regenerate this food">
																					<i class="fa fa-refresh" aria-hidden="true"></i>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</li>
															
															<li class="diet_draggable" data-model-cid="c1563" data-original-title="" title="">
																<div class="food_box col-12">
																	<div class="row food_object_row align-items-center">
																		<div class="food_image_column">
																			<div class="food_image" style=";background-size:auto 50px;">
																				<img src="../img/core-img/salad.png" alt="">
																			</div>
																		</div>
																		<div class="food_right_column">
																			<div class="row">
																				<div class="food_name col-12">
																					<div class="print_name">
																						Tarte aux pommes
																					</div>
																				</div>
																				<div class="food_units col-12">
																					<span class="amount_input">2 bowls</span>
																				</div>
																			</div>
																			<div class="food_buttons_col">
																				<div class="food_refresh svg-button" title="Regenerate this food">
																					<i class="fa fa-refresh" aria-hidden="true"></i>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</li>
														</ul>					
													</div>
												</div>
												<div class="col-12 meal_note"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>								
	</section>	
	<div class="modal fade" id="nutritionIHM" tabindex="-1" role="dialog" aria-labelledby="printNutritionIHM" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				 <div class="modal-header">
					<button id="close-btn" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">Nutrition calculator</h4>
					</button>
				</div>
				<div class="modal-body">
					<div class="calculator_form">
						<form class="form-horizontal condensed_form" id="calculator_form">
							<fieldset>
								<div class="col-12 alert alert-primary text-small" role="alert">
									<p>
										This calculator uses a standard BMR equation (the Mifflin-St Jeor formula) to estimate your Calorie
										needs. We also make some rough macronutrient suggestions, but you're free to
										completely customize these values when you create a free account.
									</p>
									<p class="pb-0 mb-0">
										<strong>Keep in mind that this is a general estimate.</strong> 
										For best results, consult your healthcare provider.
									</p>
								</div>
											
								<div class="form-group row">
									<label for="current-preset-diet" class="col-sm-4 col-form-label">Current diet type</label>
									<div class="col-sm-8" style="margin-top: 8px" id="current-preset-diet">
										<span> vegan </span>
									</div>
								</div>
								<div class="form-group row">
									<label for="goal-radio" class="col-12 col-sm-4 col-form-label">I want to</label>
									<div class="col-12 col-sm-8">
										<div class="row">
											<div class="goal_help_tooltip left_form_tooltip" data-original-title="" title="">
												<i class="fa fa-question-circle-o" aria-hidden="true"></i>
											</div>
											<div class="col-12 three-segment-radio" data-editors="goal" id="goal-radio">
												<div id="c59_goal" class="btn-group btn-group-toggle" name="goal" data-toggle="buttons">
													<label for="c59_goal-0" class="btn btn-selector-primary">
														<input type="radio" name="goal" value="L" id="c59_goal-0" checked="">Lose weight
													</label>
													<label for="c59_goal-1" class="btn btn-selector-primary  active">
														<input type="radio" name="goal" value="M" id="c59_goal-1">Maintain
													</label>
													<label for="c59_goal-2" class="btn btn-selector-primary">
														<input type="radio" name="goal" value="G" id="c59_goal-2">Build muscle
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group row">
									<label for="units-radio" class="col-12 col-sm-4 col-form-label">Preferred units</label>
									<div class="col-12 col-sm-8 two-segment-radio" data-editors="units" id="units-radio">
										<div id="c59_units" class="btn-group btn-group-toggle" name="units" data-toggle="buttons">
											<label for="c59_units-0" class="btn btn-selector-primary active">
												<input type="radio" name="units" value="I" id="c59_units-0" checked="">U.S. Standard
											</label>
											<label for="c59_units-1" class="btn btn-selector-primary ">
												<input type="radio" name="units" value="M" id="c59_units-1">Metric
											</label>
										</div>
									</div>
								</div>

								<div class="form-group row">
									<label for="gender-radio" class="col-12 col-sm-4 col-form-label">I am</label>
									<div class="col-12 col-sm-8 two-segment-radio" data-editors="gender" id="gender-radio">
										<div id="c59_gender" class="btn-group btn-group-toggle" name="gender" data-toggle="buttons">
											<label for="c59_gender-0" class="btn btn-selector-primary active">
												<input type="radio" name="gender" value="M" id="c59_gender-0" checked="">Male
											</label>
											<label for="c59_gender-1" class="btn btn-selector-primary">
												<input type="radio" name="gender" value="F" id="c59_gender-1">Female
											</label>
										</div>
									</div>
								</div>

								<div class="form-group row">
									<label for="height-inputs" class="col-12 col-sm-4 col-form-label">Height</label>
									<div class="inline_block col-12 col-sm-8" id="height-inputs">
										<div class="row">
											<div class="col-6 imperial_inputs">
												<input id="height-primary" name="height_primary" class="form-control inline_block" type="text">
												<label for="height-primary" class="imperial_inputs signup_input_label"> ft</label>
											</div>
											<div class="col-6">
												<input id="height-secondary" name="height_secondary" class="form-control inline_block" type="text">
												<label for="height-secondary" class="imperial_inputs signup_input_label"> in</label>
												<label for="height-secondary" class="metric_inputs signup_input_label" style="display: none;"> cm</label>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group row">
									<label for="weight-input" class="col-12 col-sm-4 col-form-label">Weight</label>
									<div class="inline_block col-12 col-sm-4" id="weight-input">
										<input id="weight" name="weight" class="form-control inline_block" type="text">
										<label for="weight" class="signup_input_label imperial_inputs"> lbs </label>
										<label for="weight" class="signup_input_label metric_inputs" style="display: none;"> kgs </label>
									</div>
								</div>

								<div class="form-group row">
									<label for="age" class="col-12 col-sm-4 col-form-label">Age</label>
									<div class="col-12 col-sm-4" id="age-input">
										<input name="age" id="age" class="form-control inline_block" type="text">
										<label for="age" class="signup_input_label"> years </label>
									</div>
								</div>

								<div class="form-group row">
									<label for="bodyfat-radio" class="col-12 col-sm-4 col-form-label">
										Bodyfat
									</label>
									<div class="col-12 col-sm-8">
										<div class="row">
											<div class="bfat_help_tooltip left_form_tooltip" data-original-title="" title="">
												<i class="fa fa-question-circle-o" aria-hidden="true"></i>
											</div>

											<div data-editors="bodyfat" id="bodyfat-radio" class="col-12 three-segment-radio">
												<div id="c59_bodyfat" class="btn-group btn-group-toggle" name="bodyfat" data-toggle="buttons">
													<label for="c59_bodyfat-0" class="btn btn-selector-primary ">
														<input type="radio" name="bodyfat" value="10" id="c59_bodyfat-0">Low
													</label>
													<label for="c59_bodyfat-1" class="btn btn-selector-primary active">
														<input type="radio" name="bodyfat" value="20" id="c59_bodyfat-1" checked="">Medium
													</label>
													<label for="c59_bodyfat-2" class="btn btn-selector-primary ">
														<input type="radio" name="bodyfat" value="30" id="c59_bodyfat-2">High
													</label>
												</div>
											</div>

											<div class="male_bfat_percent col-12">
												<div class="bfat_percent">under 14%</div>
												<div class="bfat_percent">14% to 22%</div>
												<div class="bfat_percent">above 22%</div>
											</div>
											<div class="female_bfat_percent col-12" style="display: none;">
												<div class="bfat_percent">under 22%</div>
												<div class="bfat_percent">22% to 35%</div>
												<div class="bfat_percent">above 35%</div>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group row">
									<label for="activity_level_dropdown" class="col-12 col-sm-4 col-form-label">Activity level</label>
									<div class="col-12 col-sm-8">
										<div class="left_form_tooltip activity_tooltip" data-original-title="" title="">
											<i class="fa fa-question-circle-o" aria-hidden="true"></i>
										</div>

										<div class="inline_block" style="width: 100%;" data-editors="activity_level" id="activity_level_dropdown">
											<select id="c59_activity_level" class="form-control" name="activity_level">
												<option value="1.2">Sedentary</option>
												<option selected="" value="1.375">Lightly Active</option>
												<option value="1.55">Moderately Active</option>
												<option value="1.725">Very Active</option>
												<option value="1.9">Extremely Active</option>
											</select>
										</div>
									</div>
								</div>

								<div class="form-group row">
									<label for="use_weight_goal" style="font-weight: normal" class="col-12 col-sm-4 col-form-label">
										Set a weight goal?
									</label>

									<div class="col-12 col-sm-8">
										<div class="two-segment-radio" id="use_weight_goal" data-editors="use_weight_goal">
											<div id="c59_use_weight_goal" class="btn-group btn-group-toggle" name="use_weight_goal" data-toggle="buttons">
												<label for="c59_use_weight_goal-0" class="btn btn-selector-primary ">
													<input type="radio" name="use_weight_goal" value="false" id="c59_use_weight_goal-0">No thanks
												</label>
												<label for="c59_use_weight_goal-1" class="btn btn-selector-primary active">
													<input type="radio" name="use_weight_goal" value="true" id="c59_use_weight_goal-1" checked="">Yeah let's do it!
												</label>
											</div>
										</div>
									</div>
								</div>

								<div class="weight_goal_form">
									<div class="form-group row">
										<label for="weight_field" style="font-weight: normal" class="col-12 col-sm-4 col-form-label">
											Enter your goal weight
										</label>

										<div class="col-12 col-sm-4">
											<div data-editors="weight_goal">
												<input id="c59_weight_goal" class="form-control" name="weight_goal" type="number" step="any" min="0">
											</div>
											<div class="signup_input_label weight_units">lbs</div>
										</div>
									</div>

									<div class="form-group row">
										<label for="weight_field" style="font-weight: normal" class="col-12 col-sm-4 col-form-label">
											Weight change rate
										</label>

										<div class="col-12 col-sm-6">
											<div class="inline-block gain_lose_label">Lose</div>
											<div class="weight_input_field" data-editors="weight_goal_weekly_rate">
												<input id="c59_weight_goal_weekly_rate" class="form-control" name="weight_goal_weekly_rate" step="0.1" type="number">
											</div>
											<div class="weight_units">lbs</div>
												per week
										</div>
									</div>

									<small class="col-12 col-sm-6 offset-sm-4 text-muted expected_weight_goal_date small_bottom_spacer"></small>

									<div class="weight_goal_bmi_warning alert alert-warning"></div>
									<div class="weight_goal_weekly_rate_warning alert alert-warning"></div>
									<div class="weight_goal_update_error alert alert-danger"></div>
									<div class="weight_goal_date_update_error alert alert-danger"></div>
								</div>

								<div class="offset-sm-2 col-12 col-sm-8 top_spacer bottom_spacer">
									<button class="btn btn-lg btn-block btn-orange" id="calculate_button">
										<i class="fa fa-calculator" aria-hidden="true"></i>
											Calculate
									</button>
								</div>

								<div class="low_calorie_warning alert alert-warning">
									Based on your entries, our equations came up with a target under 1200 Calories. 
									Eating under 1200 Calories per day is generally considered extreme, 
									and you should consult a health professional before doing so.
								</div>
							</fieldset>
						</form>
					</div>
					<div class="macro_recommendation">
						<table class="table">
							<thead>
								<tr>
									<th><strong>Suggested Calories</strong></th>
									<th><strong>Carbs</strong></th>
									<th><strong>Fat</strong></th>
									<th><strong>Protein</strong></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="suggested_calories"></td>
									<td class="suggested_carbs"></td>
									<td class="suggested_fats"></td>
									<td class="suggested_proteins"></td>
								</tr>
							</tbody>
						</table>

						<div class="text-center">
							<button class="btn btn-orange btn-lg use_calculated_settings">
								<i class="fa fa-check" aria-hidden="true"></i> Apply these settings
							</button>
						</div>
						<br>
					</div>
				</div>	
			</div>
		</div>
	</div>	
					
    <!-- ##### Footer Area Start ##### -->
     <?php include('include/footer.php');?>
    <!-- ##### All Javascript Files ##### -->

    <!-- jQuery-2.2.4 js -->
    <script src="../js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Bootstrap js -->
    <script src="../js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="../js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="../js/tools/active/active2.js"></script>
	<!-- Active js -->
	<script src="../js/canvas.js"></script>
	<!-- Meal Planner tools js -->
	<script src="../js/meal_planner.js"></script>

	<?php include('./include/connexion_profil.php'); ?>
</body>
</html>