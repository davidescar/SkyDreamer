<?php
	require ("utility.php");
	session_start();
	if(!isset($_SESSION['loggato']))
		header("Location: index.php");
	$link=connectionDB();

	//punti richiesti dal cliente per uno sconto
	$punti=$_POST['punti'];
	
	  //ricavo informazioni per inserimento record in tabella prenotazione
	  //idPrenotazione --> funzione createCodPren($link) in utility.php
	  //mailUtente --> $_SESSION['mail']
	  //idVoloPren --> $idVolo
	  //dataPrenotazione --> $curr_date
	  //numeroBiglietti --> $numPass
	  //costoBiglietto --> $costoBiglietto
	  //classe --> $classe

	  //creo codicePrenotazione per poter inserire un nuovo record nella tabella prenotazione
	  $idPrenotazione=createCodPren($link);

	  //ricavo informazione sull'id del volo per cui il cliente desidera prenotare $numPass biglietti di classe $classe
	  $idVolo=$_POST['volo'];

	  //info data corrente
	  $date=new DateTime();
	  $curr_date=$date->format('Y-m-d H:i:s');

	  //ricavo informazioni su numero passeggeri e classe di volo selezionata dal cliente
	  $numPass=$_POST['numPass'];
	  $classe=strtolower($_POST['classe']);	

	  //ricavo informazione sul costo per biglietto per la prenotazione selezionata
	  $costoBiglietto=$_POST['costo'];
	  $sconto=$punti/100;
	  $costoBiglietto-=10*$sconto;

	  $utente=$_SESSION['mail'];

	  //echo $idPrenotazione." ".$_SESSION['mail']." ".$idVolo." ".$curr_date." ".$numPass." ".$costoBiglietto." ".$classe;

	  $query="INSERT INTO prenotazione VALUES ('$idPrenotazione','$utente','$idVolo','$curr_date','$numPass','$costoBiglietto','$classe')";
	  $insert=mysqli_query($link,$query);
	  if($insert)
		  header("Location: bookings.php");
	  else{
		  $_SESSION['errorPren']=1;
		  header("Location: search.php");
	  }
	  closeConnectionDB($link);
?>