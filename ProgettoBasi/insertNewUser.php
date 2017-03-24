<?php
	require ("utility.php");
	session_start();
	if(isset($_SESSION['errorLogin'])){
		unset($_SESSION['errorLogin']);
	}

	//recupero campi del form (funzione trim per eliminare eventuali spazi inseriti per errore dall'utente dell'interfaccia
	$mail=trim($_POST['mail']);
	$password=$_POST['pass'];
	$cognome=ucfirst(trim($_POST['cognome']));
	$nome=ucfirst(trim($_POST['nome']));
	$dataNasc=$_POST['data_nascita'];
	$telefono=$_POST['telefono'];		
	
	//connessione al database + controllo stato connessione
	$link=connectionDB();
		
	//se l'email è già in uso, non serve controllare gli altri campi, sicuramente l'inserimento non può andare a buon fine
	//perchè viene violato il vincolo di chiave primaria
	$checkMail=mysqli_query($link,"SELECT * from utente where mail='$mail'");
	if(mysqli_num_rows($checkMail)==1)
		$_SESSION['errorMail']=1;
					
	//controlla che il numero di telefono inserito non sia già in uso --> viola unicità campi
	$checkTel=mysqli_query($link,"SELECT * from utente where telefono='$telefono'");
	if(mysqli_num_rows($checkTel)==1)
		$_SESSION['errorTel']=1;
				
	//se email e n.telefono non esistono già prova ad effettuare l'inserimento, altrimenti segnala gli eventuali errori
	if(mysqli_num_rows($checkMail)==0 && mysqli_num_rows($checkTel)==0){
		//cancello le variabili di sessione create in caso di errore nel form
		if(isset($_SESSION['m']))
			unset($_SESSION['m']);
		if(isset($_SESSION['c']))
			unset($_SESSION['c']);
		if(isset($_SESSION['n']))
			unset($_SESSION['n']);
		if(isset($_SESSION['d']))
			unset($_SESSION['d']);
		if(isset($_SESSION['t']))
			unset($_SESSION['t']);

		$inserimento=mysqli_query($link,"INSERT INTO utente (mail,password,cognome,nome,dataNascita,telefono,admin) values ('$mail','$password','$cognome','$nome','$dataNasc','$telefono','false')");
		if($inserimento){ //inserimento a buon fine

			//creo codice carta per il nuovo utente
			$codice=createCodeCard($link);
				
			//invoco procedura per aggiunta carta nuovo utente registrato al sito
			$carta=mysqli_query($link,"CALL aggiungiCarta('$codice','$mail')");
			
			//cancello variabili di sessione per gli errori
			if(isset($_SESSION['errorMail']))
				unset($_SESSION['errorMail']);
			if(isset($_SESSION['errorTel']))
				unset($_SESSION['errorTel']);
		}
	}else{
		//memorizzo valori inseriti dall'utente in modo che non debba reinserirli in caso di errori
		$_SESSION['m']=$mail;
		$_SESSION['c']=$cognome;
		$_SESSION['n']=$nome;
		$_SESSION['d']=$dataNasc;
		$_SESSION['t']=$telefono;
	}
	closeConnectionDB($link);
	header("Location: index.php");		
?>