<?php
	require ("utility.php");
	session_start();
	if(!isset($_SESSION['loggato']))
		header("Location: index.php");
	$link=connectionDB();
	$idVolo=$_POST['volo'];
	$cittaPart=$_POST['cittaPart'];
	$cittaArr=$_POST['cittaArr'];
	$dataPart=$_POST['data'];
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<title>Scelta Prenotazione</title>
		<?php printMetaTag(); ?>
		<link rel="stylesheet" href="css/pren.css" type="text/css" />
	</head>
	<body>
		<?php printHeader(); ?>
		<div class="form">
			<h2 class="subtitle">Scelta Prenotazione Volo <?php echo $idVolo; ?></h2>
			<form action="infoPren.php" method="POST">
				<div class='linea'>
				<ul>
					<li>
					<label for="numPass">Passeggeri</label>
					<select name="numPass">
						<?php
							for($i=1; $i<6; $i++)
								echo "<option value='$i'>$i</option>";
						?>
					</select>
				      </li>
					<li>
						<label for="classe">Classe</label>
						<select name="classe">
						<?php
							$query="SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
	    							WHERE TABLE_NAME='prenotazione' AND COLUMN_NAME='classe'";
							$result=mysqli_query($link,$query);
							$row=mysqli_fetch_array($result);
							$enumList=explode(",",str_replace("'","",substr($row['COLUMN_TYPE'],5,(strlen($row['COLUMN_TYPE'])-6))));
							foreach($enumList as $value)
	    						echo "<option value='".$value."'>".ucfirst($value)."</option>";
						?>
						</select>
					</li>
				</ul>
				</div>
				<div>
					<p class="note">Attenzione: è possibile prenotare fino ad un massimo di 5 biglietti per prenotazione.</p>
					<p class="note">Si ricorda che ogni biglietto prenotato subir&agrave; la seguente maggiorazione, in base alla classe di volo scelta.</p>
					<ul>
						<li>Prima: +50&euro;</li>
						<li>Business: +20&euro;</li>
						<li>Economy: nessuna maggiorazione</li>
					</ul>
				</div>
				<input type="hidden" name="volo" value="<?php echo $idVolo; ?>" />
				<input type="hidden" name="cittaPart" value="<?php echo $cittaPart; ?>" />
				<input type="hidden" name="data" value="<?php echo $dataPart; ?>" />
				<input type="hidden" name="cittaArr" value="<?php echo $cittaArr; ?>" />
				<input type="submit" class="button" value="Avanti" />
			</form>
			<form action="searchResult.php" method="POST">
				<input type="hidden" name="partenza" value="<?php echo $cittaPart; ?>" />
				<input type="hidden" name="dataPart" value="<?php echo $dataPart; ?>" />
				<input type="hidden" name="arrivo" value="<?php echo $cittaArr; ?>" />
				<input type="submit" class="button" value="Seleziona altro volo" />
			</form>
		</div>
		<?php closeConnectionDB($link); ?>
		<?php printFooter(); ?>
	</body>
</html>