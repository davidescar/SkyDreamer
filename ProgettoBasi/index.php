<?php
	require ("utility.php");
	session_start();
	if(isset($_SESSION['loggato'])) //se l'utente è già loggato viene reindirizzato alla home
		header("Location: home.php");
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<title>Login</title>
		<?php printMetaTag(); ?>
		<link rel="stylesheet" href="css/index.css" type="text/css" />
	</head>
	<body>
		<?php printHeader(); ?>
		<div class="form">
			
			<ul class="tab-group">
				<li class="tab active"><a href="#login">Accedi</a></li>
				<li class="tab"><a href="#signup">Registrazione</a></li>
			</ul>

			<div class="tab-content">
				
				<div id="login">
					<h2>Entra in SkyDreamer</h2>
					<form action="login.php" method="post">
						<div class="field-wrap">
							<label for="mail">Email</label>
							<input type="email" name="mail" placeholder="Email" autocomplete="off" required />
						</div>
						<div class="field-wrap">
							<label for="pass">Password</label>
							<input type="password" name="pass" placeholder="Password" required pattern="[a-zA-Z0-9]{5,19}" title="La password deve essere di almeno 5 caratteri!" />
						</div>
						<?php if(isset($_SESSION['errorLogin'])){ printMessageError("Errore Login: mail e/o password sbagliate"); } ?>
						<input type="submit" class="button button-block" value="Login"/>
					</form>
				</div>

				<div id="signup">
					<h2>Creazione Account</h2>
					<form action="insertNewUser.php" method="post">
						<div class="top-row">
							<div class="field-wrap">
								<label for="nome">Nome</label>
								<input type="text" name="nome" placeholder="Nome" autocomplete="off" <?php if(isset($_SESSION['n'])){ echo "value='".$_SESSION['n']."'"; }?> required />
							</div>
							<div class="field-wrap">
								<label for="cognome">Cognome</label>
								<input type="text" name="cognome" placeholder="Cognome" autocomplete="off" <?php if(isset($_SESSION['c'])){ echo "value='".$_SESSION['c']."'"; }?> required />
							</div>
						</div>
						<div class="top-row">
							<div class="field-wrap">
								<label for="data_nascita">Data di Nascita</label>
								<input type="date" name="data_nascita" placeholder="Data di Nascita" <?php if(isset($_SESSION['d'])){ echo "value='".$_SESSION['d']."'"; }?> required />
							</div>
							<div class="field-wrap">
								<label for="telefono">Telefono</label>
								<input type="text" name="telefono" placeholder="Telefono" autocomplete="off" pattern="\d{10}" title="Deve contenere 10 cifre" <?php if(isset($_SESSION['t'])){ echo "value='".$_SESSION['t']."'"; }?> required />
								<?php if(isset($_SESSION['errorTel'])){ printMessageError("Errore: numero di telefono gia&grave; in uso"); } ?>
							</div>
						</div>
						<div class="field-wrap">
							<label for="mail">Email</label>
							<input type="email" name="mail" placeholder="Email" autocomplete="off" <?php if(isset($_SESSION['m'])){ echo "value='".$_SESSION['m']."'"; }?> required />
							<?php if(isset($_SESSION['errorMail'])){ printMessageError("Errore: mail gia&grave; in uso"); } ?>
						</div>
						<div class="field-wrap">
							<label for="pass">Password</label>
							<input type="password" name="pass" placeholder="Password" required pattern="[a-zA-Z0-9]{5,19}" title="La password deve essere di almeno 5 caratteri!" />
						</div>
						<input type="submit" class="button button-block" value="Procedi" />
					</form>
				</div>

			</div>

		</div>
		<?php printFooter(); ?>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
	</body>
</html>