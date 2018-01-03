<!doctype html>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
		<!-- Reset css style -->
		<link href="<?php echo File::buildPath(array('style', 'reset.css')) ?>" rel="stylesheet">
		<link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<!-- Apply global css style -->
		<link href="<?php echo File::buildPath(array('style', 'style.css')) ?>" rel="stylesheet">
		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		<title><?php echo $title; ?></title>
	</head>

	<body>
		<header>
			<ul>
				<li><a href="/index.php?controller=user&action=viewConnect">Home</a></li>
				<?php if (isConnected()): ?>
					<li><a href="/index.php?controller=festival&action=readAll">Festival</a></li>
					<li><a href="/index.php?controller=editeur&action=readAll">Editeur</a></li>
					<li><a href="/index.php?controller=jeu&action=readAll">Jeux</a></li>
					<li><a href="/index.php?controller=colis&action=readAll">Colis</a></li>
					<li><a href="/index.php?controller=user&action=actionDisconnect">Disconnect</a></li>
				<?php else: ?>
					<li><a href="/index.php?controller=user&action=viewConnect">Log in</a></li>
					<li><a href="/index.php?controller=user&action=viewRegister">Register</a></li>
				<?php endif ?>
			</ul>
		</header>


		<main>
			<div>
				<?php
					require File::buildPath(array('view', $controller, $view . '.php'));
				?>
			</div>
		</main>

		<footer>

		</footer>
	</body>
</html>
