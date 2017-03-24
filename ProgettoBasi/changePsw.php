<?php
	require ("utility.php");
	session_start();
	if(!isset($_SESSION['loggato'])) //se l'utente non si è loggato viene reindirizzato alla pagina di login/registrazione
		header("Location: index.php");
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<title>Cambia Password</title>
		<?php printMetaTag(); ?>
		<link rel="stylesheet" href="css/profile.css" type="text/css" />
	</head>
	<body>
		<?php printHeader(); ?>
		<div class="form">
			<h2 class="subtitle">Procedura per il cambio password</h1>
			<form action="checkNewPsw.php" method="POST">
					<div class="linea">
						<div class="info">
							<label for="old_pass">Vecchia Password</label>
							<input type="password" name="old_pass" required />
						</div>
						<?php if(isset($_SESSION['errorOldPsw'])){ printMessageError("Errore: la password digitata non corrisponde alla password attuale"); } ?>
					</div>
					<div class="linea">
						<div class="info">
							<label for="pass1">Nuova Password</label>
							<input type="password" name="pass1" required pattern="[a-zA-Z0-9]{5,19}" title="La password deve essere di almeno 5 caratteri!" />
						</div>
						<div class="info">
							<label for="pass2">Conferma</label>
							<input type="password" name="pass2" required pattern="[a-zA-Z0-9]{5,19}" title="La password deve essere di almeno 5 caratteri!" />
						</div>
						<?php
						if(isset($_SESSION['errorNewPsw'])) printMessageError("Errore: la nuova password non è stata confermata in modo corretto");
						if(isset($_SESSION['errorSamePsw'])) printMessageError("Errore: impossibile cambiare la password perchè coincide con quella attuale");
					?>
					</div>
				<div class="last">
				  <input type="submit" class="button" value="Procedi"/>
				  <a class="button" href="home.php">Annulla</a>
				</div>
			</form>
			
		</div>
		<?php printFooter(); ?>
	</body>
</html>