<?php
	session_start();
	if(!isset($_SESSION['loggato']))
		header("Location: index.php");
	if(!$_SESSION['admin'])
		header("Location: home.php");
	
	//recupero info: tabella sulla quale eseguire l'operazione selezionata
	$tab=$_POST['tabella'];
	$op=$_POST['operazione'];

	//variabile di sessione per memorizzare tabella dove eseguire operazione
	//N.B.: $_SESSION['tab'] si sovrascrive ad ogni richiesta admin di operazione di gestione del database
	$_SESSION['tab']=$tab;
	if($op=="view")
		header("Location: view.php");
	if($op=="insert")
		header("Location: insert.php");
?>