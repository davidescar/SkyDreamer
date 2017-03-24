<?php
	require ("utility.php");
	session_start();
	if(!isset($_SESSION['loggato']))
		header("Location: index.php");
	if(!$_SESSION['admin'])
		header("Location: home.php");
	if(isset($_SESSION['op']))
		unset($_SESSION['op']);
	$link=connectionDB();
	flushSessionError();
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<title>Menu&grave; Admin</title>
		<?php printMetaTag(); ?>
		<link rel="stylesheet" href="css/admin.css" type="text/css" />
	</head>
	<body>
		<?php printHeader(); ?>
		<div class="form">
			<h2 class="subtitle">Gestione SkyDreamer</h2>
			<ul>
				<li>
				<p class="descrQuery">Operazioni di manutenzione del database</p>
					<form action="manage.php" method="POST">
						<li class="sel">
							<select name="tabella">
								<?php
									$tables=mysqli_query($link,"SHOW TABLES");
									//visualizzo solo le tabelle principali su cui si possono eseguire operazioni di inserimento,modifica e cancellazione
									while($row=mysqli_fetch_row($tables)){
										if($row[0]!="carta" && $row[0]!="viaggia" && $row[0]!="prenotazione")
											echo "<option value='$row[0]'>".ucfirst($row[0])."</option>";
									}
									closeConnectionDB($link);
								?>
							</select>
						</li>
						<li class="sel">
							<select name="operazione">
								<option value="view">Visualizza</option>
								<option value="insert">Inserisci</option>
							</select>
						</li>
						<li>
							<input type="submit" class="button" value="Procedi" />
						</li>
					</form>
				</li>
				<div id="queryList">
					<form action="getDataQuery.php" method="POST">
						<li>
							<p class="descrQuery">Clienti e punti sulla carta di quelli che hanno acquistato pi&ugrave; di n biglietti (in ordine per numero di biglietti acquistati)</p>
							<input type="submit" class="button" name="query" value="Query B" />
						</li>
						<li>
							<p class="descrQuery">Numero di voli internazionali (dall'Italia all'estero), divisi per citt&agrave;, effettuati dal cliente x</p>
							<input type="submit" class="button" name="query" value="Query C" />
						</li>
						<li>
							<p class="descrQuery">Voli che viaggiano in data z, la cui somma del numero di piste degli aeroporti coinvolti &egrave; maggiore di x</p>
							<input type="submit" class="button" name="query" value="Query D" />
						</li>
						<li>
							<p class="descrQuery">Clienti con et&agrave; compresa tra k e n anni, che hanno viaggiato dall'aeroporto x all'aeroporto y</p>
							<input type="submit" class="button" name="query" value="Query E" />
						</li>
					</form>
					<li>
						<p class="descrQuery">Citt&agrave;, aeroporto (partenza e arrivo) e numero di biglietti dei voli che hanno venduto di
						pi&ugrave;</p>
						<a href="execQuery.php" class="button button-query">Query F</a>
					</li>
				</div>
			</ul>
			<a class="button" href="home.php">Men&ugrave; Principale</a>
		</div>
		<?php printFooter(); ?>
	</body>
</html>