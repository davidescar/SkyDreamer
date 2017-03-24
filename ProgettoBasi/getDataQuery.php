<?php
	require ("utility.php");
	session_start();
	if(!isset($_SESSION['loggato']))
		header("Location: index.php");
	if(!$_SESSION['admin'])
		header("Location: home.php");
	$link=connectionDB();
	$q=$_POST['query'];
	if($q!="Query B" && $q!="Query C" && $q!="Query D" && $q!="Query E")
		$q="Query F";
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<title>Dati Query Admin</title>
		<?php printMetaTag(); ?>
		<link rel="stylesheet" href="css/showRecord.css" type="text/css" />
	</head>
	<body>
		<?php printHeader(); ?>
		<div class="form">
			<h2 class="subtitle">Inserimento dati per <?php echo $q ?></h2>
			<form action="execQuery.php" method="POST">
				<?php
					//se è stata selezionata la query B, chiedo l'informazione sul numero di biglietti
					if($q=="Query B")
						echo "<div class='linea'><div class='info'><label for='nbig'>Numero biglietti</label><input type='number' name='nbig' min='1' required /></div></div>";
					//se è stata selezionata la query C, chiedo le informazioni sul cliente
					if($q=="Query C"){
						echo "	<div class='linea'>
								<div class='info'><label for='client'>Cliente</label>
								<select name='client' class='cliente'>";
									$client=mysqli_query($link,"select mail,cognome,nome from utente where admin='0'");
									while($row=mysqli_fetch_row($client))
										echo "<option value='$row[0]'>$row[1] $row[2]</option>";
						echo "	</select></div></div>";
					}
					//se è stata selezionata la query D, chiedo le informazioni sulla data del volo e somma numero piste aeroporti
					if($q=="Query D"){
						echo "<div class='linea'><div class='info'><label for='part'>Data partenza</label><input type='date' name='part' required /></div>";
						echo "<div class='info'><label for='piste'>Somma n. piste</label><input type='number' name='piste' min='2' required /></div></div>";
					}
					//se è stata selezionata la query E, chiedo le informazioni sulla fascia di età, sull'aeroporto di partenza e di arrivo
					if($q=="Query E"){
						echo "<div class='linea'><div class='info'><label for='etaMin'>Et&agrave; minima</label><input type='number' name='etaMin' min='1' max='100' required /></div>";
						echo "<div class='info'><label for='etaMax'>Et&agrave; massima</label><input type='number' name='etaMax' min='1' max='100' required /></div></div>";
						echo "	<div class='linea'><div class='info'><label for='partenza'>Partenza</label>
									<input list='partenza' name='partenza' required>
										<datalist id='partenza'>";
											$andata=mysqli_query($link,"select codiceAeroporto,nomeAeroporto,citta from aeroporto");
											while($row=mysqli_fetch_row($andata))
												echo "<option value='$row[0] - $row[1]'>$row[2]</option>";
						echo "		</datalist></div>";
						echo "	<div class='info'><label for='arrivo'>Arrivo</label>
									<input list='arrivo' name='arrivo' required>
										<datalist id='arrivo'>";
											$andata=mysqli_query($link,"select codiceAeroporto,nomeAeroporto,citta from aeroporto");
											while($row=mysqli_fetch_row($andata))
												echo "<option value='$row[0] - $row[1]'>$row[2]</option>";
						echo "			</datalist></div></div>";
					}


				?>
				<div class='last'>
					<input type="hidden" name="query" value="<?php echo $q; ?>" />
					<input type="submit" class="button" value="Procedi" />
					<a class="button" href="adminMenu.php">Cambia Query</a>
				</div>
			</form>
		</div>
		<?php closeConnectionDB($link); ?>
		<?php printFooter(); ?>
	</body>
</html>