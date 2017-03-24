<?php
	require ("utility.php");
	session_start();
	if(!isset($_SESSION['loggato']))
		header("Location: index.php");
	if(!$_SESSION['admin'])
		header("Location: home.php");
	//recupero info tabella e record da modificare
	$t=$_SESSION['tab'];
	$f=$_SESSION['record'];
	if($_SESSION['op']=='elimina')
		$read="readonly";
	else
		$read="";
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<title><?php echo ucfirst($_SESSION['op'])." ".ucfirst($t); ?></title>
		<?php printMetaTag(); ?>
		<link rel="stylesheet" href="css/showRecord.css" type="text/css" />
	</head>
	<body>
		<?php printHeader(); ?>
		<div class="form">
			<h2 class="subtitle">Procedura per la <?php echo $_SESSION['op']; ?> del record</h2>
			<h3>Tabella <?php echo $t; ?></h3>
			<form action="execDelUpd.php" method="POST">
				<?php
					$link=connectionDB();
					$getPK=mysqli_query($link,"show indexes from $t where Key_name='PRIMARY'");
					$nfieldskey=mysqli_num_rows($getPK); //numero di attributi che formano la chiave primaria della tabella $t
					$i=0;
					while($row=mysqli_fetch_row($getPK)){
						$pk[$i]=$row[4]; //indice 4 si riferisce all'attributo column_name
						$i++;
					}
					//Salvo la chiave primaria del record da modificare
					$_SESSION['primarykey']=$pk;
					
					//Visualizzo record selezionato
					$query=mysqli_query($link,"select * from $t");
					$fields=mysqli_fetch_fields($query);
					$i=0;
					$j=0;
					
					foreach($fields as $a){
						if ($i%2==0){echo "<div class='linea'>";}
						echo "<div class='info ";
						echo "<label for='".$j."'>".ucfirst($a->name)."</label>";
						if($i<count($pk) and $a->name==$pk[$i])
							echo "<input type='text' name='".$j."' value='".$f[$j]."' readonly />";
						else if($_SESSION['op']=="modifica"){
							if($a->name=="idAereoVolo"){
								echo "<select name='".$j."'>";
								echo "<option value='".$f[$j]."' selected='selected' >".$f[$j]."</option>";
								$q="SELECT idAereo FROM aereo WHERE idAereo!='".$f[$j]."'";
								$res=mysqli_query($link,$q);
								while($r=mysqli_fetch_row($res))
									echo "<option value='".$r[0]."'>".$r[0]."</option>";
								echo "</select>";
							}else if($a->name=="aeroportoPartenza" || $a->name=="aeroportoArrivo"){
								echo "<select name='".$j."'>";
								echo "<option value='".$f[$j]."' selected='selected' >".$f[$j]."</option>";
								$q="SELECT codiceAeroporto FROM aeroporto WHERE codiceAeroporto!='".$f[$j]."'";
								$res=mysqli_query($link,$q);
								while($r=mysqli_fetch_row($res))
									echo "<option value='".$r[0]."'>".$r[0]."</option>";
								echo "</select>";
							}else
								echo "<input type='text' name='".$j."' value='".$f[$j]."' ".$read." />";
						}else
							echo "<input type='text' name='".$j."' value='".$f[$j]."' ".$read." />";
						$i++;
						$j++;
						echo "</div>";
						if ($i%2==0) {echo "</div>";}
					}
					if($i%2==1) {echo "</div>";}
					if($_SESSION['op']=='modifica')
						if(isset($_SESSION['errorUpdate'])) printMessageError("Errore: modifica record fallita!");
					if($_SESSION['op']=='cancellazione')
						if(isset($_SESSION['errorDelete'])) printMessageError("Errore: cancellazione record fallita!");
				?>
				<div class="last">
					<input type="submit" class="button" value="<?php echo $_SESSION['op']; ?>" />
					<a class="button" href="view.php">Seleziona altro <?php echo $t; ?></a>
				</div>
			</form>
		</div>
		<?php closeConnectionDB($link); ?>
		<?php printFooter(); ?>
	</body>
</html>