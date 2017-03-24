<?php
	require ("utility.php");
	session_start();
	if(!isset($_SESSION['loggato']))
		header("Location: index.php");
	if(!$_SESSION['admin'])
		header("Location: home.php");
	
	$t=$_SESSION['tab'];
	$link=connectionDB();
	
	//numero campi letti che compongono il nuovo record della tabella $t
	$nf=$_POST['campi'];
	$val="";
	for($i=0; $i<$nf; $i++){
		$val.="'".ucfirst($_POST[$i])."',";
	}

	if($t=="volo"){
		if($_POST['1']==$_POST['2']){
			$_SESSION['errorVolo']=1;
			header("Location: insert.php");
			exit;
		}
	}

	//eliminazione ultimo carattere (virgola in eccesso)
	$val=substr($val,0,-1);

	$query="INSERT INTO ".$t." values (".$val.")";
	
	$insert=mysqli_query($link,$query);
	if($insert){

		//nel caso si stia inserendo un utente base, occorre richiamare la procedura per l'inserimento della carta associata
		if($t=="utente" && $_POST[$nf-1]=="false"){
			//utente possessore della carta
			$mail=$_POST[0];
			//creo codice carta per il nuovo utente
			$codice=createCodeCard($link);
			$carta=mysqli_query($link,"CALL aggiungiCarta('$codice','$mail')");
		}

		//nel caso si stia aggiungendo un nuovo volo, occorre richiamare la procedura per l'inserimento di record nella tabella viaggia
		if($t=="volo"){
			//idAereoVolo
			$aereo=$_POST[3];
			//aeroportoPartenza
			$partenza=$_POST[1];
			//aeroportoArrivo
			$arrivo=$_POST[2];
			$viaggia=mysqli_query($link,"CALL aggiungiViaggia('$aereo','$partenza')");
			$viaggia=mysqli_query($link,"CALL aggiungiViaggia('$aereo','$arrivo')");
		}

		if(isset($_SESSION['errorInsertRecord']))
			unset($_SESSION['errorInsertRecord']);
		if(isset($_SESSION['errorVolo']))
			unset($_SESSION['errorVolo']);
		closeConnectionDB($link);
		header("Location: adminMenu.php");
	}else{
		$_SESSION['errorInsertRecord']=1;
		header("Location: insert.php");
	}
?>