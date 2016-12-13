<p><?php //print render($intro_text); ?></p>
<div class="giftyweb-user-login-form-wrapper">
  <?php //print drupal_render_children($form)?>
</div>

<div class="men">
	<div class="container">
		<div class="register">
			<div class="col-md-6 login-left">
				<h3>NEW CUSTOMER</h3>
				<p>By creating an account with our store, you will be able to move
					through the checkout process faster, store multiple shipping
					addresses, view and track your orders in your account and more.</p>
				<a class="acount-btn" href="user/register">Create an Account</a>
			</div>
			<div class="col-md-6 login-right">
				<h3><?php print render($intro_text); ?></h3>
				<p>If you have an account with us, please log in.</p>
				<form accept-charset="UTF-8" id="user-login" method="post"
					action="<?php //echo $GLOBALS['base_url'];?>/user">
					<div>
						<span>Username<label class="form-required"> * </label></span>
						<input type="text" class="form-text required error" maxlength="60" size="60"
								value="" name="name" id="edit-name" />
					</div>
					<div>
						<span>Password<label class="form-required"> * </label></span>
						<input type="password" class="form-text required error" maxlength="128"
								size="60" name="pass" id="edit-pass">
					</div><br />

					<input type="submit" class="form-submit btn-submit-login"
							value="Login" name="op" id="edit-submit">&nbsp;&nbsp;<a class="forgot" href="<?php echo $GLOBALS['base_url']?>/user/password">Forgot Your Password?</a>
					<input type="hidden"
						value="form-XpL8r4dRESrBIKl_Qoc5pDeECW6HmmO1lOJPG33MHms"
						name="form_build_id">
					<input type="hidden" value="user_login"
						name="form_id">

				</form>
			</div>
		</div>
	</div>
</div>
