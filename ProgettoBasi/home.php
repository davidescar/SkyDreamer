<?php
	require ("utility.php");
	session_start();
	if(!isset($_SESSION['loggato'])) //se l'utente non si è loggato viene reindirizzato alla pagina di login/registrazione
		header("Location: index.php");
	flushSessionError();
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<title>Home</title>
		<?php printMetaTag(); ?>
		<link rel="stylesheet" href="css/home.css" type="text/css" />
	</head>
	<body>
		<?php printHeader(); ?>
		<div id="content">
			<div id="menu">
				<h2>Menu&grave; SkyDreamer</h2>
				<ul>
					<li><a href="#link1">Account</a>
						<ul>
							<li id="link1"><a href="profile.php">Gestione Profilo</a></li>
							<?php if($_SESSION['admin']==0) echo "<li class='last' id='link1'><a href='bookings.php'>Storico Prenotazioni</a></li>"; ?>
						</ul>
					</li>
					<?php
						if($_SESSION['admin']){
							echo "	<li><a href='#link2'>Operazioni</a>
										<ul>
											<li id='link2'><a href='search.php'>Cerca Voli</a></li>
											<li class='last' id='link2'><a href='adminMenu.php'>Gestione SkyDreamer</a></li>
										</ul>
									</li>";
						}else{
							echo "<li><a href='search.php'>Cerca Voli</a></li>";
						}
					?>
				</ul>
			</div>
		</div>
		<?php printFooter(); ?>
	</body>
</html>