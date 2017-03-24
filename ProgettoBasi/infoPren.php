<?php
	require ("utility.php");
	session_start();
	if(!isset($_SESSION['loggato']))
		header("Location: index.php");
	$link=connectionDB();

	//ricavo informazioni su numero passeggeri e classe di volo selezionata dal cliente
	$numPass=$_POST['numPass'];
	$classe=$_POST['classe'];

	//recupero altre informazioni sul volo selezionato
	$idVolo=$_POST['volo'];
	$cittaPart=$_POST['cittaPart'];
	$cittaArr=$_POST['cittaArr'];
	$dataPart=$_POST['data'];

	$query1="SELECT ap.nomeAeroporto AS Partenza, aa.nomeAeroporto AS Arrivo, DATE_FORMAT(v.dataPartenza,'%d/%m/%Y %H:%i') AS DataPartenza, ROUND(v.costo,2) as CostoBiglietto
			FROM volo v JOIN aeroporto ap ON v.aeroportoPartenza=ap.codiceAeroporto JOIN aeroporto aa ON v.aeroportoArrivo=aa.codiceAeroporto
			WHERE v.idVolo='".$idVolo."'";
	$result=mysqli_query($link,$query1);
	$row=mysqli_fetch_row($result);
	$array=mysqli_fetch_fields($result);
	$n=mysqli_num_fields($result);
	//calcolo costo per biglietto in base alla classe di volo scelta dal cliente
	$costo=$row[3];
	if($classe=="prima")
		$costo+=50;
	if($classe=="business")
		$costo+=20;
	//totale della prenotazione
	$tot=$costo*$numPass;
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<title>Informazioni Prenotazione</title>
		<?php printMetaTag(); ?>
		<link rel="stylesheet" href="css/pren.css" type="text/css" />
		<script src="js/check_punti.js" type="text/javascript" ></script>
	</head>
	<body>
		<?php printHeader(); ?>
		<div class="form">
			<h2 class="subtitle">Informazioni Prenotazione</h2>
			<form action="prenota.php" method="POST">
				<?php
					for($i=0; $i<$n; $i++){
						if($i%2==0){echo "<div class='linea'>";}
						echo "<div class='info'><label for='".$i."'>".ucfirst($array[$i]->name)."</label><input type='text' name='$i' value='".($array[$i]->name=="CostoBiglietto" ? "$row[$i] &euro;" : "$row[$i]")."' readonly /></div>";
					  if($i%2==1){echo "</div>";}
					}
					$query2="SELECT punti FROM carta WHERE mailUtente='".$_SESSION['mail']."'";
					$res=mysqli_query($link,$query2);
					$p=mysqli_fetch_row($res);
					$puntiDisp=$p[0];
				?>
				<div class='linea'><div class='info'><label>Passeggeri</label>
				<input type="text" name="numPass" value="<?php echo $numPass; ?>" readonly /></div>
				<div class='info'><label>Classe</label>
				<input type="text" name="classe" value="<?php echo ucfirst($classe); ?>" readonly /></div></div>
				<div class="linea"><div class="info"><label>Punti disponibili</label>
				<input type="text" name="puntiDisp" value="<?php echo $puntiDisp; ?>" readonly /></div>
				<div class="info"><label>Punti per sconto</label>
				<input type="text" id="punti" name="punti" value="0" onblur="isnum(this,<?php echo $puntiDisp; ?> )" required /></div></div>
				<div class="info info-last"><label>Totale</label>
				<input type="text" name="totale" value="<?php echo $tot." &euro;";  ?>" /></div>
				<p class='note'>Si ricorda che ogni 10 punti utilizzati, si ottiene uno sconto di 1&euro; su ogni biglietto</p>
				<p class='note'>La quantit&agrave; di punti utilizzabili in una prenotazione pu&ograve; essere solo un multiplo di 10!</p>
				<p class='note'>Inoltre, per ogni biglietto acquistato si guadagnano 10 punti sulla propria carta</p>
				<input type="hidden" name="volo" value="<?php echo $idVolo; ?>" />
				<input type="hidden" name="costo" value="<?php echo $costo; ?>" />
				<input type="submit" class="button" value="Prenota" />
			</form>
			<form action="sceltaPren.php" method="POST">
				<input type="hidden" name="volo" value="<?php echo $idVolo; ?>" />
				<input type="hidden" name="cittaPart" value="<?php echo $cittaPart; ?>" />
				<input type="hidden" name="data" value="<?php echo $dataPart; ?>" />
				<input type="hidden" name="cittaArr" value="<?php echo $cittaArr; ?>" />
				<input type="submit" class="button" value="Cambia prenotazione" />
			</form>
		</div>
		<?php closeConnectionDB($link); ?>
		<?php printFooter(); ?>
	</body>
</html>