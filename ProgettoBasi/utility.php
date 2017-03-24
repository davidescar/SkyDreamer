<?php

function printMetaTag(){
	echo"<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<meta name='title' content='SkyDreamer Login' />
		<meta name='author' content='SkyDreamerTeam' />
		<meta name='language' content='italian it' />
		<meta name='keywords' content='Basi di Dati, Progetto, SkyDreamer, Booking Online' />
";
}

function printHeader(){
	echo"<div id='header'>
			<div id='logo'>
				<h1 class='title'><a href='home.php'>SkyDreamer</a></h1>
			</div>
		";
	if(isset($_SESSION['loggato'])){
		echo"	<div id='infolog'>
				<form action='logout.php' method='POST'>";
		$admin=$_SESSION['admin'];
		echo "
					<div id='usergroup'>
						<p>Utente</p>
						<p><a href='profile.php'>".$_SESSION['mail']."</a></p>
					</div> 
					<div id='adm'>
						<p>Admin</p>
						<p><span id='".(($admin) ? "boll_admin" : "boll_utente")."'></span></p>
					</div>
					<div id='log'><input type='submit' class='button' value='Logout' /></div>
				</form>
			</div>
		";
	}
	echo"</div>
";
}

function printFooter(){
	echo "<div id='footer'>
		<div>
			<p class='foot_title'>Universit&agrave; degli Studi di Padova</p>
			<ul id='unipd'>
				<li>Dipartimento di Matematica</li>
				<li>Via Trieste, 63 - 35121 Padova (Italia)</li>
			</ul>
		</div>
		<div>
			<p class='foot_title'>SkyDreamer Team</p>
			<ul id='team'>
				<li>Gianluca Pegoraro</li>
				<li>Davide Scarparo</li>
			</ul>
		</div>
	</div>";
}

function printMessageError($error_string){
	echo "<p class='msgerror'>".$error_string."</p>";
}

function connectionDB(){
	$link=mysqli_connect("basidati.studenti.math.unipd.it","dscarpar","1rbIEloN","dscarpar-PR");
	if(mysqli_connect_errno()) {
		printf("Connessione fallita: %s\n", mysqli_connect_error());
		exit();
	}
	return $link;
}

function closeConnectionDB($link){
	mysqli_close($link);
}

function flushSessionError(){
	if(isset($_SESSION['errorNewPsw']))
		unset($_SESSION['errorNewPsw']);
	if(isset($_SESSION['errorOldPsw']))
		unset($_SESSION['errorOldPsw']);
	if(isset($_SESSION['errorSamePsw']))
		unset($_SESSION['errorSamePsw']);
	if(isset($_SESSION['errorInsertRecord']))
		unset($_SESSION['errorInsertRecord']);
	if(isset($_SESSION['errorUpdate']))
		unset($_SESSION['errorUpdate']);
	if(isset($_SESSION['errorDelete']))
		unset($_SESSION['errorDelete']);
}

function createCodeCard($link){
	$searchCod=mysqli_query($link,"SELECT codiceCarta from carta");
	if(mysqli_num_rows($searchCod)==0) //non è mai stata creata una carta ==> creo il codice di partenza
		$cod="1234567890";
	else{
		//cerco codice massimo per creare quello per la successiva carta
		$codMax=mysqli_query($link,"SELECT MAX(codiceCarta) as codMax from carta");
		$row=mysqli_fetch_row($codMax);
		$cod=$row[0];
		$cod++;
	}
	return $cod;
}

function createCodPren($link){
	$searchCod=mysqli_query($link,"SELECT idPrenotazione from prenotazione");
	if(mysqli_num_rows($searchCod)==0) //non è mai stata fatta una prenotazione ==> creo il codice di partenza
		$cod="P001";
	else{
		//cerco codice massimo per creare quello per la successiva prenotazione
		$codMax=mysqli_query($link,"SELECT MAX(idPrenotazione) as idMax from prenotazione");
		$row=mysqli_fetch_row($codMax);
		$cod=$row[0];
		$cod++;
	}
	return $cod;
}

function createCodAereo($link){
	$searchCod=mysqli_query($link,"SELECT idAereo from aereo");
	if(mysqli_num_rows($searchCod)==0) //non è mai stato inserito un aereo ==> creo il codice di partenza
		$cod="A001";
	else{
		//cerco codice massimo per creare quello per il successivo aereo
		$codMax=mysqli_query($link,"SELECT MAX(idAereo) as idMax from aereo");
		$row=mysqli_fetch_row($codMax);
		$cod=$row[0];
		$cod++;
	}
	return $cod;
}

function createCodVolo($link){
	$searchCod=mysqli_query($link,"SELECT idVolo from volo");
	if(mysqli_num_rows($searchCod)==0) //non è mai stato inserito un volo ==> creo il codice di partenza
		$cod="V001";
	else{
		//cerco codice massimo per creare quello per il successivo volo
		$codMax=mysqli_query($link,"SELECT MAX(idVolo) as idMax from volo");
		$row=mysqli_fetch_row($codMax);
		$cod=$row[0];
		$cod++;
	}
	return $cod;
}
