
<body class="bg-slate-800">
	<!-- Page container -->
	<div class="page-container login-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Advanced login -->
					<form action="" method="POST">
					
                	<?php if ($sf_user->hasFlash('error')): ?>
    	            	<div
    							style="padding: 6px; text-align: center; color: #ff5555">
    	            		<?php echo html_entity_decode($sf_user->getFlash('error')); ?>
    	            	</div>
                	<?php endif; ?>
						<div class="panel panel-body login-form">

							<div class="text-center">
				                <h5 class="content-group">Authentification <small class="display-block">Saisissez votre login et mot de passe</small></h5>
				            </div>
							<div class="form-group has-feedback has-feedback-left">
								<input type="text" class="form-control" placeholder="Username" name="login">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" placeholder="Password" name= "pass">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>
							<div class="row">
								<div class="clearfix"></div>
								<div class="input-prepend" title="captcha" data-rel="tooltip">
									<input class="input-large span10" name="captcha" id="captcha" required="required"
									type="text" width="30px" height="30px" />
									<img src="/images/Captcha/captcha.jpg" />
								</div>
							</div>	
							<div class="form-group">
								<button type="submit" class="btn bg-blue btn-block" style="background-color: #013e7b;">
									Login <i class="icon-circle-right2 position-right"></i>
								</button>
							</div>


						</div>
					</form>
					<!-- /advanced login -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
</body>