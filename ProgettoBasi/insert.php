<?php
	require ("utility.php");
	session_start();
	if(!isset($_SESSION['loggato']))
		header("Location: index.php");
	if(!$_SESSION['admin'])
		header("Location: home.php");
	$t=$_SESSION['tab'];
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<title>Inserimento <?php echo ucfirst($t); ?></title>
		<?php printMetaTag(); ?>
		<link rel="stylesheet" href="css/showRecord.css" type="text/css" />
	</head>
	<body>
		<?php printHeader(); ?>
		<div class="form">
			<h2 class="subtitle">Inserimento nuovo <?php echo $t; ?></h2>
			<form action="execInsert.php" method="POST">
				<?php
					$link=connectionDB();
					
					$colType=mysqli_query($link,"SELECT * from INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='$t'");
					$nfields=mysqli_num_rows($colType); //numero campi tabella $t

					//ricavo la chiave primaria della tabella $t
					$getPK=mysqli_query($link,"show indexes from $t where Key_name='PRIMARY'");
					//numero di campi che formano la chiave primaria della tabella $t
					$nfPK=mysqli_num_rows($getPK);

					$id="";
					$read="";
					//ricavo valori chiave primaria per tabella aereo e volo
					if($t=="aereo" || $t=="volo"){
						$read="readonly";
						if($t=="aereo")
							$id=createCodAereo($link);
						if($t=="volo")
							$id=createCodVolo($link);
					}

					$i=0;
					while($row=mysqli_fetch_row($colType)){
						//$row[3]=COLUMN_NAME --> nome colonna
						//$row[5]=COLUMN_DEFAULT --> valore default colonna
						//$row[6]=IS_NULLABLE --> indicazione se ammette valore nullo
						//$row[7]=DATA_TYPE --> tipo di dato
						//$row[8]=CHARACTER_MAXIMUM_LENGTH --> lunghezza massima
						if($i<$nfPK){
							echo "<div class='linea'><div class='info'><label for='".$i."'>".ucfirst($row[3])."</label><input type='".($t=="utente" ? "email" : "text")."' name='".$i."' value='".$id."' ".$read." ".($read=="" ? "required" : "")." />";
						}else{
							$cond="";
							if($row[7]=="tinyint")
								$type="radio";
							if($row[7]=="varchar"){
								if($row[3]=="password")
									$type="password";
								else
									$type="text";
								$cond.="maxlength='".$row[8]."'";
							}
							if($row[3]=="telefono")
								$cond.="pattern='\d{10}'";
							if($row[7]=="date"){
								$type="date";
							}
							if($row[7]=="datetime"){
								$type="text";
								$cond.="placeholder='YYYY-mm-dd hh:mm:ss'";
							}
							if($row[7]=="time"){
								$type="text";
								$cond.="placeholder='hh:mm:ss' ";
							}
							if($row[7]=="double"){
								$type="text";
								$cond.="pattern=[0-9]{1,5}.[0-9]{2} placeholder='es: 70.55'";
							}
							if($row[7]=="int"){
								$type="text";
								$cond.="pattern=[0-9]{1,3} placeholder='es: 5'";
							}
							if($row[6]=="NO")
								$cond.=" required";

							if($type=="radio")
								$val="true";
							else
								$val=$row[5];

							if ($i%2==0 && $i>=$nfPK){echo "<div class='linea'>";}

							echo "<div class='info ";
							if($type=="radio"){echo "info-radio";} 
							echo "'>";
							echo "<label for='".$i."'>".ucfirst($row[3])."</label>";
							if($row[3]=="aeroportoPartenza" || $row[3]=="aeroportoArrivo" || $row[3]=="idAereoVolo"){
								echo "<select name='".$i."'>";
								if($row[3]=="idAereoVolo")
									$query="SELECT idAereo,modello FROM aereo";
								else
									$query="SELECT codiceAeroporto,nomeAeroporto FROM aeroporto";
								$result=mysqli_query($link,$query);
								$nres=mysqli_num_rows($result);
								while($x=mysqli_fetch_row($result)){
									echo "<option value='".$x[0]."'>".$x[1]."</option>";
								}
								echo "</select>";
							}else{
								echo "<input type='".$type."' name='".$i."' value='$val' $cond />";
								if($type=="radio")
								echo "si<input type='".$type."' name='".$i."' value='false' required />no";
							}
						}
							echo "</div>";
							$i++;

							if ($i%2==0) {echo "</div>";}
					}
					if($i%2==1) {echo "</div>";}
					if(isset($_SESSION['errorInsertRecord']))
						printMessageError("Errore: impossibile inserire il record con questi dati");
					if(isset($_SESSION['errorVolo']))
						printMessageError("Errore: volo non valido, partenza e destinazione coincidono!");
					echo "<div class='last'>
						<input type='hidden' name='campi' value='".$i."' />
						<input type='submit' class='button' name='operazione' value='Inserisci' />
						<a class='button' href='adminMenu.php'>Annulla</a>
					</div>";
				?>
			</form>
		</div>
		<?php closeConnectionDB($link); ?>
		<?php printFooter(); ?>
	</body>
</html>