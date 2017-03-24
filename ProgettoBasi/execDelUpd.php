<?php
	require ("utility.php");
	session_start();
	if(!isset($_SESSION['loggato']))
		header("Location: index.php");
	if(!$_SESSION['admin'])
		header("Location: home.php");
	
	$link=connectionDB();
	$t=strtolower($_SESSION['tab']);
	$pk=$_SESSION['primarykey'];

	//record memorizzato nella tabella $t
	$f=$_SESSION['record'];

	//operazione di modifica selezionata
	if($_SESSION['op']=='modifica'){
	
		//recupero nomi attributi tabella $t per costruire la clausola SET della query UPDATE
		$getFields=mysqli_query($link,"SELECT Column_name from INFORMATION_SCHEMA.COLUMNS where TABLE_SCHEMA='progettobasi' and TABLE_NAME='$t'");
		$i=0;
		while($row=mysqli_fetch_row($getFields)){
			$fieldsName[$i]=$row[0];
			$i++;
		}
		//recupero info campi modificati del record selezionato
		$val="";
		$j=0;
		while($j<count($f)){
			//se il valore è stato modificato allora lo inserisco nella clausola SET della query di UPDATE
			if($_POST[$j]!=$f[$j])
				$val.=" ".$fieldsName[$j]."='".$_POST[$j]."',";
			$j++;
		}
		//elimino ultimo carattere che è uno spazio
		$val=substr($val,0,-1);
	}

	//variabile che contiene la condizione della clausola WHERE per la query di UPDATE o DELETE
	$cond="";
	$i=0;
	while($i<count($pk)){
		$cond.=$pk[$i]."='".$_SESSION['record'][$i]."'";
		$i++;
		if($i<count($pk))
			$cond.=" and ";
	}
	
	//costruisco la query
	if($_SESSION['op']=='modifica')
		$query="UPDATE $t set $val where $cond;";
	if($_SESSION['op']=='elimina'){
		if($t=='utente'){
			if($_SESSION['record'][0]==$_SESSION['mail']){ //si sta tentando di cancellare il proprio account
				header("Location: deleteUser.php");
				exit();
			}
		}
		$query="DELETE from $t where $cond;";
	}

	$result=mysqli_query($link,$query);
	if($result){
		if(isset($_SESSION['errorUpdate']))
			unset($_SESSION['errorUpdate']);
		if(isset($_SESSION['errorDelete']))
			unset($_SESSION['errorDelete']);
		header("Location: view.php");
	}else{
		if($_SESSION['op']=='modifica')
			$_SESSION['errorUpdate']=1;
		if($_SESSION['op']=='cancellazione')
			$_SESSION['errorDelete']=1;
		header("Location: recordSelected.php");
	}
	closeConnectionDB($link);
?>