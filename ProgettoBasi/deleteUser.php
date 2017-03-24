<?php
	require ("utility.php");
	session_start();
	if(!isset($_SESSION['loggato']))
		header("Location: index.php");
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<title>Cancellazione Account</title>
		<?php printMetaTag(); ?>
		<link rel="stylesheet" href="css/profile.css" type="text/css" />
	</head>
	<body>
		<?php printHeader(); ?>
		<div class="form">
			<h2 class="subtitle">Cancellazione account SkyDreamer</h2>
			<form action="logout.php" method="POST">
				<p><?php echo $_SESSION['cognome']." ".$_SESSION['nome']; ?> sei sicuro di voler procedere alla cancellazione del tuo account SkyDreamer?</p>
				<div class="last">
					<input type="submit" class="button" name="delete" value="Elimina">
					<a class="button" href="profile.php">Annulla</a>
				</div>
			</form>
		</div>
		<?php printFooter(); ?>
	</body>
</html>