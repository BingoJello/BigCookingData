<div class="modal fade" id="loginIHM" tabindex="-1" role="dialog" aria-labelledby="loginIHM" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				 <div class="modal-header">
					<button id="close-btn" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">Connexion</h4>
					</button>
				</div>
				<div class="modal-body">
					<div class="calculator_form">
						<form class="form-horizontal condensed_form" id="calculator_form" action="connexion" method="POST">
							<fieldset>	
								<div class="form-group row">
									<label for="email-login" class="col-12 col-sm-4 col-form-label label-email-login">Email</label>
									<div class="inline_block col-12 col-sm-7 col-md-7 col-lg-7" id="email-login-block">
										<input id="email-login" name="email" class="form-control inline_block" type="email">
									</div>
								</div>
								
								<div class="form-group row">
									<label for="password-login" class="col-12 col-sm-4 col-form-label label-password-login">Mot de passe</label>
									<div class="inline_block col-12 col-sm-7 col-md-7 col-lg-7" id="password-login">
										<input id="password-login" name="password" class="form-control inline_block" type="password">
									</div>
								</div>
							
								<div class="offset-sm-2 col-12 col-sm-8 top_spacer bottom_spacer">
									<button class="btn btn-lg btn-block btn-orange" id="calculate_button">
										<i class="fa fa-user" aria-hidden="true"></i>
											Soumettre
									</button>
								</div>
                                <!--
								<div class="alert alert-warning">
									Ici on met les alertes
								</div>
								-->
								<div class="row">
									<a href="./registration.php" style="font-size:16px;color:#1E90FF;margin:0 auto">Créer un compte</a>
								</div>
							</fieldset>
						</form>
					</div>
				</div>	
			</div>
		</div>
	</div>