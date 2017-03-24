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
		<title>Storico Prenotazioni</title>
		<?php printMetaTag(); ?>
		<link rel="stylesheet" href="css/view.css" type="text/css" />
	</head>
	<body>
		<?php printHeader(); ?>
		<div class="form">
			<h2 class="subtitle">Storico Prenotazioni</h2>
		<?php
			$utente=$_SESSION['mail'];
			$prenotazioni=mysqli_query($link,"	SELECT idPrenotazione,date_format(dataPrenotazione,'%d/%m/%Y') AS DataPrenotazione,numeroBiglietti,ROUND(costoBiglietto,2)
												FROM prenotazione
												WHERE mailUtente='$utente'");
			if(mysqli_num_rows($prenotazioni)>0){
				$nfields=mysqli_num_fields($prenotazioni);
				$array=mysqli_fetch_fields($prenotazioni);
				echo "<table id='prenotazione'><tr>";
				//intestazione tabella
				for($i=0; $i<$nfields-1; $i++)
					echo "<th>".ucfirst($array[$i]->name)."</th>";
				echo "<th>Totale</th></tr>";
				//contenuto tabella
				while($row=mysqli_fetch_row($prenotazioni)){
					echo"<tr>";
					for($i=0; $i<$nfields-1; $i++)
						echo "<td>$row[$i]</td>";
					echo "<td>".($row[3]*$row[2])."&euro;</td>";
					echo "</tr>";
				}
				echo "</table>";
			}else
				echo "<p>Nessuna prenotazione effettuata!</p>";
		?>
		<a class="button" href="home.php">Indietro</a>
		</div>
		<?php closeConnectionDB($link); ?>
		<?php printFooter(); ?>
	</body>
</html>