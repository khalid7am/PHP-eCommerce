<?php
	require 'inc/panierController.php';

	$erreur = "";
	if(isset($_POST['inscrire']) && !empty($_POST['inscrire']))
	{
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$email = $_POST['email'];
		$telephone = $_POST['telephone'];
		$password = $_POST['password'];

		$pattern = '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#';
		$pattern2 = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
		
		//Verifier si email n'existe pas déjà
		$sql = "SELECT COUNT(email) AS num FROM clients WHERE email = :email";
		$stmt = $db->prepare($sql);    
		$stmt->bindValue(':email', $email);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		
		if($row['num'] > 0)
			$erreur .= "Email déjà ultilisé<br>";
		else if(!preg_match($pattern2, $email))
			$erreur .= "Email n'est pas valide<br>";
		
		if($password != $_POST['password2'])
			$erreur .= "Mot de passe n'est pas identique<br>";
		else if(!preg_match($pattern, $password))
			$erreur .= "Mot de passe n'est pas très fort<br>";

		if($erreur === ""){
			$data = [
				'nom' => $nom,
				'prenom' => $prenom,
				'email' => $email,
				'password' => password_hash($password, PASSWORD_BCRYPT),
				'telephone' => $telephone,
			];
			$sql = "INSERT INTO clients (nom, prenom, email, password, telephone) VALUES (:nom, :prenom, :email, :password, :telephone)";
			$stt= $db->prepare($sql);
			if($stt->execute($data))
			{
				$_SESSION['client_id'] = $db->lastInsertId();
				$_SESSION['client_nom'] = $nom;
				$_SESSION['client_prenom'] = $prenom;
				$_SESSION['client_email'] = $email;
				$_SESSION['client_telephone'] = $telephone;
				header('Location: produits');
			}
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>S'inscrire | MySweater</title>
  <?php require 'inc/head-tags.php'; ?>
</head>
<body class="goto-here">
	<?php require 'inc/header.php'; ?>
	<section class="ftco-section contact-section bg-light">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 order-md-last d-flex">
					<form action="" method="POST" class="bg-white p-5 contact-form">
                        <div class="form-group">
                            <h3 class="text-center">Créer un compte</h3>
						</div>
						<?php if($erreur !== ""){ ?>
						<div class="alert alert-danger">							
								<?php echo $erreur ?>
						</div>
						<?php } ?>
						<div class="form-group">
							<input class="form-control" name="nom" placeholder="Votre nom" type="text" required>
                        </div>
                        <div class="form-group">
							<input class="form-control" name="prenom" placeholder="Votre prénom" type="text" required>
						</div>
						<div class="form-group">
							<input class="form-control" name="email" placeholder="Votre Email" type="email" required>
						</div>
						<div class="form-group">
							<input class="form-control" name="password" placeholder="Mot de passe" type="password" required>
                        </div>
                        <div class="form-group">
							<input class="form-control" name="password2" placeholder="Répéter le mot de passe" type="password" required>
						</div>
						<div class="form-group">
							<input class="form-control" name="telephone" placeholder="Téléphone" type="text">
						</div>
						<div class="form-group text-center">
							<input class="btn btn-primary py-3 px-5" name="inscrire" type="submit" value="Enregistrer">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
  <?php require 'inc/footer.php'; ?>
  <?php require 'inc/foot-tags.php'; ?>
</body>
</html>