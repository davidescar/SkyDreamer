<?php
	require ("utility.php");
	session_start();
	//richiesta cancellazione account utente
	if(isset($_POST['delete'])){ 
		$link=connectionDB();
		$user=$_SESSION['mail'];
		$elimina=mysqli_query($link,"DELETE from utente where mail='$utente'");
		closeConnectionDB($link);
	}
	session_unset(); //svuoto l'array $_SESSION
	session_destroy(); //distruggo la sessione
	header("Location: index.php");
?>