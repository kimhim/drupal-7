<p><?php //print render($intro_text); ?></p>
<div class="giftyweb-user-login-form-wrapper">
  <?php  // print drupal_render_children($form)?>
</div>

<div class="col-md-12 register">
	<form>
		<div class="register-top-grid">
			<h3><?php print render($intro_text); ?></h3>
			<div>
				<span>First Name<label>*</label></span> <input type="text">
			</div>
			<div>
				<span>Email Address<label>*</label></span> <input type="text">
			</div>
			<div class="register-but">
				<div class="clearfix"></div>
				<input type="submit" value="submit">
			</div>
		</div>
	</form>
</div>