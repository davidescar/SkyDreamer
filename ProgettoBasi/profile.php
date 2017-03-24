<?php
	require ("utility.php");
	session_start();
	if(!isset($_SESSION['loggato'])) //se l'utente non si è loggato viene reindirizzato alla pagina di login/registrazione
		header("Location: index.php");
	$user=$_SESSION['mail'];
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<title>Gestione Profilo</title>
		<?php printMetaTag(); ?>
		<link rel="stylesheet" href="css/profile.css" type="text/css" />
	</head>
	<body>
		<?php printHeader(); ?>
		<?php
			$link=connectionDB();

			$viewUser=mysqli_query($link,"SELECT * from utente where mail='$user'");
			$row=mysqli_fetch_row($viewUser);
			
			$mail=$row[0];
			$password=$row[1];
			$cognome=$row[2];
			$nome=$row[3];
			$dataNasc=date_create($row[4]);
			$telefono=$row[5];
			$admin=$row[6];
			$codice="";
			if($admin=="0"){
				$card=mysqli_query($link,"SELECT codiceCarta,punti from carta where mailUtente='$user'");
				$row=mysqli_fetch_row($card);
				$codice=$row[0];
				$punti=$row[1];
			}

		?>
		<div class="form">
			<h2 class="subtitle">Informazioni Profilo</h2>
			<div class="linea">
				<div class="info">
					<label for="mail">Email</label>
					<input type="text" name="mail" value="<?php echo $mail; ?>" readonly />
				</div>
				<div class="info info-psw">
						<label for="password">Password</label>
						<div>
							<input type="text" name="password" value="<?php for($i=0; $i<strlen($password); $i++) echo "*"; ?>" readonly />
							<a class="button" href="changePsw.php">Modifica</a>
						</div>
				</div>
			</div>
			<div class="linea">
				<div class="info">
					<label for="cognome">Cognome</label>
					<input type="text" name="cognome" value="<?php echo $cognome; ?>" readonly />
				</div>
				<div class="info">
					<label for="nome">Nome</label>
					<input type="text" name="nome" value="<?php echo $nome; ?>" readonly />
				</div>
			</div>
			<div class="linea">
				<div class="info">
					<label for="ddn">Data di nascita</label>
					<input type="text" name="ddn" value="<?php echo date_format($dataNasc,'d/m/Y'); ?>" readonly />
				</div>
				<div class="info">
					<label for="telefono">Telefono</label>
					<input type="text" name="telefono" value="<?php echo $telefono; ?>" readonly />
				</div>
			</div>
			<?php
				if($codice!=""){
					echo
					"<div class='linea'>
						<div class='info'>
							<label for='carta'>Numero carta</label>
							<input type='text' name='carta' value='$codice' readonly />
						</div>
						<div class='info'>
							<label for='punti'>Saldo punti</label>
							<input type='text' name='punti' value='$punti' readonly />
						</div>
					</div>";
				}
			?>
			<div class="last">
				<a class="button" href="deleteUser.php">Elimina Account</a>
				<a class="button" href="home.php">Indietro</a>
			</div>
		</div>
		<?php closeConnectionDB($link); ?>
		<?php printFooter(); ?>
	</body>
</html>