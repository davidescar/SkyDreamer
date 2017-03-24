<?php
	require ("utility.php");
	session_start();
	if(!isset($_SESSION['loggato']))
		header("Location: index.php");
	if(!$_SESSION['admin'])
		header("Location: home.php");
	//recupero info form
	$t=$_SESSION['tab']; //tabella sulla quale eseguire l'operazione selezionata
	$offset=$_POST['sel']; //indice di riga del record selezionato
	$op=strtolower($_POST['operazione']); //operazione selezionata per il record
	$link=connectionDB();
	$selRec=mysqli_query($link,"select * from $t LIMIT ".$offset.",1");
	$nfields=mysqli_num_fields($selRec);
	while($row=mysqli_fetch_row($selRec)){
		for($i=0; $i<$nfields; $i++){
			$f[$i]=$row[$i];
		}
	}
	//creo variabile di sessione che memorizza il record che si vuole modificare o eliminare
	$_SESSION['record']=$f;
	$_SESSION['op']=$op;
	closeConnectionDB($link);
	header("Location: recordSelected.php");
?>