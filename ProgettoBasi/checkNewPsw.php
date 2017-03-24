<?php
	require ("utility.php");
	session_start();
	if(!isset($_SESSION['loggato'])) //se l'utente non si è loggato viene reindirizzato alla pagina di login/registrazione
		header("Location: index.php");
	$user=$_SESSION['mail'];
	flushSessionError();
	
	//recupero dati immessi dall'utente
	$old_pass=$_POST['old_pass'];
	$pass1=$_POST['pass1'];
	$pass2=$_POST['pass2'];

	//connessione al database + controllo stato connessione
	$link=connectionDB();
	
	//controllo che l'utente abbia inserito la password attuale corretta + la nuova password uguale per due volte
	if($old_pass==$_SESSION['password']){
		if($pass1!=$pass2){ //errore nell'inserimento della nuova password
			$_SESSION['errorNewPsw']=1;
		}else{
			//password corrente corretta + nuova password digitata correttamente due volte
			if($old_pass==$pass1){ //controllo che la nuova password sia diversa dalla corrente
				$_SESSION['errorSamePsw']=1;
			}else{ //posso effettuare il cambio password
				mysqli_query($link,"update utente set password='$pass1' where mail='$user'");
				$_SESSION['password']=$pass1; //aggiorno la variabile di sessione contenente la password dell'utente
				//cancello le variabili di sessione per segnalare eventuali errori
				if(isset($_SESSION['errorNewPsw']))
					unset($_SESSION['errorNewPsw']);
				if(isset($_SESSION['errorOldPsw']))
					unset($_SESSION['errorOldPsw']);
				if(isset($_SESSION['errorSamePsw']))
					unset($_SESSION['errorSamePsw']);
				header("Location: profile.php");
				exit();
			}
		}
	}else{ //l'utente ha sbagliato ad inserire la password corrente
		$_SESSION['errorOldPsw']=1;
	}
	header("Location: changePsw.php");
	closeConnectionDB($link);
?>