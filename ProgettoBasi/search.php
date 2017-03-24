<?php
	require ("utility.php");
	session_start();
	if(!isset($_SESSION['loggato']))
		header("Location: index.php");
	$link=connectionDB();
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<title>Ricerca Voli</title>
		<?php printMetaTag(); ?>
		<link rel="stylesheet" href="css/search.css" type="text/css" />
	</head>
	<body>
		<?php printHeader(); ?>
		<div class="form">
			<h2 class="subtitle">Ricerca Voli</h2>
			<form action="searchResult.php" method="POST">
				<div>
					<label for="partenza">Partenza</label>
					<input list="partenza" name="partenza" required>
						<datalist id="partenza">
							<?php
								$query="SELECT DISTINCT citta,nazione FROM aeroporto";
								$andata=mysqli_query($link,$query);
								while($row=mysqli_fetch_row($andata))
									echo "<option value='$row[0]'>$row[1]</option>";
							?>
						</datalist>
				</div>
				<div>
					<label for="arrivo">Arrivo</label>
					<input list="arrivo" name="arrivo" required>
						<datalist id="arrivo">
							<?php
								$ritorno=mysqli_query($link,$query);
								while($row=mysqli_fetch_row($ritorno))
									echo "<option value='$row[0]'>$row[1]</option>";
							?>
						</datalist>
				</div>
				<div>
					<label for="dataPart">Data Partenza</label>
					<input type="date" name="dataPart" id="dataPart" required/>
				</div>
				<?php if(isset($_SESSION['errorSearch'])) printMessageError("Errore: parametri di ricerca non adatti!"); ?>
				<?php if(isset($_SESSION['errorPren'])) printMessageError("Errore: impossibile prenotare il volo selezionato, numero posti insufficiente!"); ?>
				<div id='op_buttons'>
					<input type="submit" class="button" value="Cerca"/>
					<a class="button" href="home.php">Indietro</a>
				</div>
			</form>
		</div>
		<?php closeConnectionDB($link); ?>
		<?php printFooter(); ?>
	</body>
</html>