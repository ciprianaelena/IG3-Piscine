<?php if (isset($error)): ?>
	<p class="error">
		<?php echo $error; ?>
	</p>
<?php endif; ?>

<?php if (isset($info)): ?>
	<p class="info">
		<?php echo $info; ?>
	</p>
<?php endif; ?>

<form method="post" action="index.php?controller=user&action=actionRegister">
	<p><input type="text" placeholder="Login" 
		pattern=".{3,}" title="The login must be at least 3 characters long" maxlength=20 
		name="login" value="<?php if (isset($user)): $user->echo('login'); endif; ?>" required /></p>

	<p><input type="password" placeholder="Password" 
		pattern=".{4,}" title="The password must be at least 4 characters long" maxlength=30
		name="password" value="<?php if (isset($user)): $user->echo('password'); endif; ?>" required /></p>

	<p><input type="password" placeholder="Password (again)"
		pattern=".{4,}" title="The password must be at least 4 characters long" maxlength=30 
		value="<?php if (isset($user)): $user->echo('passwordRetype'); endif; ?>" name="passwordRetype" required /></p>

	<p><input type="email" placeholder="Email" name="email" maxlengt=320 
		value="<?php if (isset($user)): $user->echo('email'); endif; ?>" required /></p>

	<p><input type="submit" value="Register!" /></p>
</form>