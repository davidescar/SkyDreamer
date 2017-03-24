<?php
	require ("utility.php");
	session_start();
	if(!isset($_SESSION['loggato']))
		header("Location: index.php");
	if(!$_SESSION['admin'])
		header("Location: home.php");
	if(isset($_SESSION['op']))
		unset($_SESSION['op']);
	$t=$_SESSION['tab'];
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<title>Visualizza <?php echo ucfirst($t); ?></title>
		<?php printMetaTag(); ?>
		<link rel="stylesheet" href="css/view.css" type="text/css" />
	</head>
	<body>
		<?php printHeader(); ?>
		<div class="form">
			<h2 class="subtitle">Visualizza <?php echo ucfirst($t); ?></h2>
			<?php
				$link=connectionDB();
				//query dinamica --> mostra in forma tabellare tuti i campi della tabella $t

				$view=mysqli_query($link,"select * from $t");
				$nfields=mysqli_num_fields($view);
				$array=mysqli_fetch_fields($view);
				$n=mysqli_num_rows($view);
				echo "<form action='delUpd.php' method='POST'>";
				$j=0;
				if($n>0){
				    echo "<table id='$t'><tr>";
				    //stampa degli attributi della tabella $t
				    for($i=0; $i<$nfields; $i++){
					    echo "<th>".ucfirst($array[$i]->name)."</th>";
				    }
				    echo "<th></th></tr>";
				    //stampa dei record della tabella $t
				    while($row=mysqli_fetch_row($view)){
					    echo "<tr>";
					    for($i=0; $i<$nfields; $i++){
						    echo "<td>";
						    if($array[$i]->name == 'password')
							    for($k=0; $k<strlen($row[$i]); $k++)
								    echo "*";
						    else if($array[$i]->name == 'admin')
							    echo "<img src='images/bollino_$row[$i].png' alt='".(($row[$i]) ? "admin" : "utente")."'/>";
						    else if($array[$i]->name == 'dataNascita'){
							    $data=date_create($row[$i]);
							    echo date_format($data,'d/m/Y');
						    }
						    else
							    echo $row[$i];						
						    echo "</td>";
					    }
					    echo "<td><input type='radio' name='sel' value='".$j."' required/></td></tr>";
					    $j++;
				    }
				    echo "</table>";
				    echo "<input type='submit' class='button' name='operazione' value='Modifica' /><input type='submit' class='button' name='operazione' value='Elimina' /></form>";
				}else
				    echo "<p class='note'>Nessun record presente nella tabella ".$t."</p>";
			?>
			<a class="button" href="adminMenu.php">Indietro</a>
		</div>
		<?php closeConnectionDB($link); ?>
		<?php printFooter(); ?>
	</body>
</html>