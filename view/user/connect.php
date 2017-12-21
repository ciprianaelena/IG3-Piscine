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

<form method="post" action="index.php?controller=user&action=actionConnect">
	<p><input type="text" placeholder="Login" 
		name="login" value="<?php if (isset($user)): $user->echo('login'); endif; ?>" required /></p>

	<p><input type="password" placeholder="Password"
		name="password" value="<?php if (isset($user)): $user->echo('password'); endif; ?>" required /></p>

	<p><input type="submit" value="Connect" /></p>
</form>