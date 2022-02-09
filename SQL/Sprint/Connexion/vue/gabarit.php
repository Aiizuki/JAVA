<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Ma page</title>
		<meta charset="utf-8">
		<link rel="stylesheet"  href="Connexion/vue/style/style_connexion.css" />
	</head>
	
	<body>
		<form action="connexion.php" method="post">
			<fieldset>
				
				<p>
					<label for='login'>Login : </label>
					<input type='text' name='login' id='login'>
				</p>
				
				<p>
					<label for='pwd'>Mot de passe : </label>
					<input type='text' name='pwd' id='pwd'>
				</p>
				
			</fieldset>
				
				<p>
					<input type='submit' name='connexion' value='Connexion'>
					<input type='reset'>
				</p>
			
		</form>
		<?php echo $contenu; ?>
	</body>
</html>