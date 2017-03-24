<?php
	require ("utility.php");
	session_start();
	if(!isset($_SESSION['loggato']))
		header("Location: index.php");
	if(!$_SESSION['admin'])
		header("Location: home.php");
	$link=connectionDB();
	$query_string=""; //SQl query selezionata
	$descr=""; //descrizione query selezionata
	if(isset($_POST['query'])){
		$q=$_POST['query'];
		if($q=="Query B"){
			//recupero dati form per query B
			$bigl=$_POST['nbig'];
			//salvo in $query_string il codice SQL per l'esecuzione della query B
			$query_string="	SELECT u.mail, u.cognome, u.nome, c.punti, SUM(p.numeroBiglietti) AS BigliettiAcquistati
							FROM utente u JOIN prenotazione p JOIN carta c ON u.mail=p.mailUtente AND u.mail=c.mailUtente
							GROUP BY u.mail
							HAVING SUM(p.numeroBiglietti)>'$bigl'
							ORDER BY SUM(p.numeroBiglietti) DESC";
			$descr="Clienti e punti sulla carta di quelli che hanno acquistato pi&ugrave; di ".$bigl." biglietti (in ordine per numero di biglietti acquistati)";
		}
		if($q=="Query C"){
			//recupero dati form per query C
			
			//ricavo informazioni sull'aeroporto di partenza
			$cliente=$_POST['client'];
			
			//salvo in $query_string il codice SQL per l'esecuzione della query C
			$query_string="	SELECT a.citta, COUNT(idVolo) AS numeroVoli
							FROM aeroporto p JOIN aeroporto a JOIN prenotazione JOIN volo ON p.codiceAeroporto=aeroportoPartenza AND a.codiceAeroporto=aeroportoArrivo AND idVoloPren=idVolo
							WHERE NOT a.nazione='Italia' AND p.nazione='Italia' AND mailUtente='".$cliente."'
							GROUP BY a.citta";
			$descr="Numero di voli internazionali (dall'Italia all'estero), divisi per citt&agrave;, effettuati dal cliente ".$cliente;
		}
		if($q=="Query D"){
			//recupero dati form per query D
			$part=$_POST['part'];
			$piste=$_POST['piste'];
			
			$x=new DateTime($part);
			$x->add(new DateInterval('P1D')); // aggiungo 1 giorno alla data selezionata
			$part2=$x->format('Y-m-d');
			//salvo in $query_string il codice SQL per l'esecuzione della query D
			$query_string="	SELECT v.idVolo, a1.nomeAeroporto AS Partenza, a2.nomeAeroporto AS Arrivo, (a1.numeroPiste+a2.numeroPiste)  AS Piste
							FROM volo v JOIN aeroporto a1 JOIN aeroporto a2 ON v.aeroportoPartenza=a1.codiceAeroporto AND v.aeroportoArrivo=a2.codiceAeroporto
							WHERE a1.numeroPiste+a2.numeroPiste>'$piste' AND v.dataPartenza>='$part' AND v.dataPartenza<'$part2'
							ORDER BY v.idVolo ASC";
			$data=date_create($part);
			$descr="Voli che viaggiano in data ".date_format($data,'d/m/Y').", la cui somma del numero di piste degli aeroporti coinvolti &egrave; maggiore di ".$piste;
		}
		if($q=="Query E"){
			//recupero dati form per query E
			$etaMin=$_POST['etaMin'];
			$etaMax=$_POST['etaMax'];
			
			//ricavo informazioni sull'aeroporto di partenza
			$part=$_POST['partenza'];
			$partenza=explode("-",$part);
			$codPart=$partenza[0];
			$aeroportoPart=$partenza[1];

			//ricavo informazioni sull'aeroporto di partenza
			$arr=$_POST['arrivo'];
			$arrivo=explode("-",$arr);
			$codArr=$arrivo[0];
			$aeroportoArr=$arrivo[1];

			//salvo in $query_string il codice SQL per l'esecuzione della query E
			$query_string="	SELECT mail, nome, cognome, TIMESTAMPDIFF(year, dataNascita, CURRENT_DATE) AS Anni
							FROM utente JOIN prenotazione JOIN volo ON mail=mailUtente AND idVoloPren=idVolo
							WHERE aeroportoPartenza='$codPart' AND aeroportoArrivo='$codArr' AND TIMESTAMPDIFF(year, dataNascita, CURRENT_DATE)>='$etaMin' AND TIMESTAMPDIFF(year, dataNascita, CURRENT_DATE)<='$etaMax'";
			$descr="Clienti con et&agrave; compresa tra ".$etaMin." e ".$etaMax." anni, che hanno viaggiato dall'aeroporto ".$aeroportoPart." all'aeroporto ".$aeroportoArr;
		}
	}
	if(!isset($_POST['query'])){
		$q="Query F";
		//salvo in $query_string il codice SQL per l'esecuzione della query F
		$query_string="	SELECT idVolo, a1.citta AS CittaPartenza, a1.nomeAeroporto AS AeroportoPartenza, a2.citta AS CittaArrivo, a2.nomeAeroporto AS AeroportoArrivo, dataPartenza, SUM(numeroBiglietti) AS BigliettiVenduti
						FROM volo JOIN prenotazione JOIN aeroporto a1 JOIN aeroporto a2 ON idVolo=idVoloPren AND aeroportoPartenza=a1.codiceAeroporto AND aeroportoArrivo=a2.codiceAeroporto
						GROUP BY idVolo
						HAVING SUM(numeroBiglietti)>=ALL(SELECT SUM(numeroBiglietti)
															FROM volo JOIN prenotazione ON idVolo=idVoloPren
															GROUP BY idVolo)
						";
		$descr="Citt&agrave;, aeroporto (partenza e arrivo) e numero di biglietti dei voli che hanno venduto di pi&ugrave;";

	}
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<title>Risultato <?php echo $q; ?></title>
		<?php printMetaTag(); ?>
		<link rel="stylesheet" href="css/execquery.css" type="text/css" />
	</head>
	<body>
		<?php printHeader(); ?>
		<div class="form">
			<h2 class="subtitle">Risultato esecuzione per <?php echo $q ?></h2>
			<?php
				echo "<p class='descrQuery'>$descr</p>";
				//eseguo la querydescr
				$result=mysqli_query($link,$query_string);
				if(mysqli_num_rows($result)>0){
					$nfields=mysqli_num_fields($result);
					$array=mysqli_fetch_fields($result);
					echo "<table id='";
					if($q=="Query B"){echo "queryb'";}
					if($q=="Query C"){echo "queryc'";}
					if($q=="Query D"){echo "queryd'";}
					if($q=="Query E"){echo "querye'";}
					if($q=="Query F"){echo "queryf'";}
					echo "><tr>";
					//intestazione tabella
					for($i=0; $i<$nfields; $i++)
						echo "<th>".ucfirst($array[$i]->name)."</th>";
					echo "</tr>";
					//contenuto tabella
					while($row=mysqli_fetch_row($result)){
						echo"<tr>";
						for($i=0; $i<$nfields; $i++)
							echo "<td>$row[$i]</td>";
						echo "</tr>";
					}
					echo "</table>";
				}else
					echo "<p>Nessun risultato trovato!</p>";
			?>
			<a class="button" href="adminMenu.php">Altre operazioni</a>
		</div>
		<?php closeConnectionDB($link); ?>
		<?php printFooter(); ?>
	</body>
</html>
