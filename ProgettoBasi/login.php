<?php
	require ("utility.php");
	session_start();

	//cancello variabili di sessione per gli errori
	if(isset($_SESSION['errorMail'])){
		unset($_SESSION['errorMail']);
	}
	if(isset($_SESSION['errorTel'])){
		unset($_SESSION['errorTel']);
	}
	if(isset($_SESSION['m'])){
		unset($_SESSION['m']);
	}
	if(isset($_SESSION['c'])){
		unset($_SESSION['c']);
	}
	if(isset($_SESSION['n'])){
		unset($_SESSION['n']);
	}
	if(isset($_SESSION['d'])){
		unset($_SESSION['d']);
	}
	if(isset($_SESSION['t'])){
		unset($_SESSION['t']);
	}

	$mail=$_POST['mail'];
	$password=$_POST['pass'];
	$link=connectionDB();
	$query="SELECT * FROM utente WHERE mail='$mail' AND password='$password'";
	if($result=mysqli_query($link,$query)){
		// controllo credenziali login (Mail+Password)
		if(mysqli_num_rows($result)==1){ // utente trovato
			// registro valori Mail,Password,Cognome,Nome nelle variabili di sessione
			while($row=mysqli_fetch_row($result)){
				$_SESSION['mail']=$row[0];
				$_SESSION['password']=$row[1];
				$_SESSION['cognome']=$row[2];
				$_SESSION['nome']=$row[3];
				$_SESSION['dataNascita']=$row[4];
				$_SESSION['telefono']=$row[5];
				$_SESSION['admin']=$row[6];
			}
			$_SESSION['loggato']=1; // utente loggato al sito
			if(isset($_SESSION['errorLogin'])){
				unset($_SESSION['errorLogin']);
			}
			header("Location: home.php");
		}else{ // utente NON trovato
			$_SESSION['errorLogin']=1; // errore dati login
			header("Location: index.php");
		}
	}
	closeConnectionDB($link);
?>