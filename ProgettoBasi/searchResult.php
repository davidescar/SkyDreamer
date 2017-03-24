<?php
	require ("utility.php");
	session_start();
	if(!isset($_SESSION['loggato']))
		header("Location: index.php");
	$link=connectionDB();
	if(isset($_SESSION['errorPren']))
		unset($_SESSION['errorPren']);
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<title>Risultato Ricerca</title>
		<?php printMetaTag(); ?>
		<link rel="stylesheet" href="css/search.css" type="text/css" />
	</head>
	<body>
		<?php printHeader(); ?>
		<div class="form">
			<?php
				//recupero parametri indicati dall'utente
				$cittaPartenza=$_POST['partenza'];
				$dataPart=$_POST['dataPart'];
				$cittaArrivo=$_POST['arrivo'];

				$data=new DateTime($dataPart);
				echo "<h2 class='subtitle'>Voli da ".$cittaPartenza." a ".$cittaArrivo." dal ".date_format($data,'d/m/Y')."</h2>";

				//info data corrente
				$date=new DateTime();
				$curr_date=$date->format('Y-m-d');
			
				//controlli sulla consistenza della ricerca richiesta dall'utente
				if($dataPart<$curr_date || $cittaPartenza==$cittaArrivo){
					$_SESSION['errorSearch']=1;
					header("Location: search.php");
				}
				else{
					if(isset($_SESSION['errorSearch']))
						unset($_SESSION['errorSearch']);

					$query="SELECT v.idVolo, ap.nomeAeroporto AS AeroportoPartenza, aa.nomeAeroporto AS AeroportoArrivo, DATE_FORMAT(v.dataPartenza,'%d/%m/%Y %H:%i') AS DataPartenza, ROUND(v.costo, 2) AS Costo, TIME_FORMAT(v.durataTratta, '%H:%i') AS Durata
							FROM volo v JOIN aeroporto ap ON v.aeroportoPartenza=ap.codiceAeroporto JOIN aeroporto aa ON v.aeroportoArrivo=aa.codiceAeroporto
							WHERE ap.citta='".$cittaPartenza."' AND aa.citta='".$cittaArrivo."' AND v.dataPartenza>='".$dataPart."'";

					//query per selezionare i voli che rientrano nei parametri specificati dall'utente
					$voli=mysqli_query($link,$query);
					if($voli){
						$nfields=mysqli_num_fields($voli);
						$array=mysqli_fetch_fields($voli);
						$n=mysqli_num_rows($voli);
						if($n>0){
							echo ($n>1 ? "<p class='note'>Ci sono $n voli che possono interessarti</p>" : "<p class='note'>C'&egrave; un solo volo in programma</p>");
							echo "<div>".($_SESSION['admin']==0 ? "<form action='sceltaPren.php' method='POST'>" : "")."<table id='voliResult'><tr>";
							//intestazione tabella
							for($i=0; $i<$nfields; $i++)
								echo "<th>".ucfirst($array[$i]->name)."</th>";
							//nel caso di utente cliente, allora ho la colonna per la selezione del volo che vuole prenotare
							if($_SESSION['admin']==0)
								echo "<th></th>";
							echo "</tr>";
							//contenuto tabella
							while($row=mysqli_fetch_row($voli)){
								echo"<tr>";
								for($i=0; $i<$nfields; $i++){
									echo "<td>$row[$i]";
									if($array[$i]->name=="Costo")
										echo " &euro;";
									if($array[$i]->name=="Durata")
										echo " h";
									echo "</td>";
								}
								//nel caso di utente cliente, allora ho la colonna per la selezione del volo che vuole prenotare
								if($_SESSION['admin']==0)
									echo "<td><input type='radio' name='volo' value='$row[0]' required /></td>";
								echo "</tr>";
							}
							echo "</table>".($_SESSION['admin']==0 ? "<input type='hidden' name='cittaPart' value='".$cittaPartenza."' /><input type='hidden' name='cittaArr' value='".$cittaArrivo."' /><input type='hidden' name='data' value='".$dataPart."' /><input type='submit' class='button button-pren' value='Prenota' /></form>" : "")."</div>";	
						}else
							echo "<p class='note'>Siamo spiacenti, ma non &egrave; stato trovato nessun volo</p>";
					}
				}
			?>
			<a class="button" href="search.php">Cerca altri voli</a>
		</div>
		<?php closeConnectionDB($link); ?>
		<?php printFooter(); ?>
	</body>
</html>