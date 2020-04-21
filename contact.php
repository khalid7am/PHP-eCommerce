<?php
	require 'inc/panierController.php';
	
	//vérifier si le bouton envoyer a été cliqué par le visiteur
	if(isset($_POST['envoyer-msg']) && !empty($_POST['envoyer-msg'])) {

		//valider les données insérés
		$nom = trim(htmlspecialchars($_POST['nom']));
		$email = trim(htmlspecialchars($_POST['email']));
		$message = trim(htmlspecialchars($_POST['message']));

		$data = [
			'nom' => $nom,
			'email' => $email,
			'message' => $message,
		];

		//requet pour inserer les données dans la base de données
		$sql = "INSERT INTO messages (nom, email, message) VALUES (:nom, :email, :message)";
		$stat= $db->prepare($sql);
		//vérifier si le message a été enregistré dans la base de données
		if($stat->execute($data)) {
			//afficher une alert pour informer le visiteur que son message a été envoyé avec succès
			echo '<script>alert("Votre message a été bien envoyé")</script>';
			header("Refresh:0");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contacter nous | MySweater</title>
  <?php require 'inc/head-tags.php'; ?>
</head>
<body class="goto-here">
	<?php require 'inc/header.php'; ?>
	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index">Accueil</a></span> <span>Contacter nous</span></p>
					<h1 class="mb-0 bread">Contacter nous</h1>
				</div>
			</div>
		</div>
	</div>
	<section class="ftco-section contact-section bg-light">
		<div class="container">
			<div class="row d-flex mb-5 contact-info">
				<div class="w-100"></div>
				<div class="col-md-3 d-flex">
					<div class="info bg-white p-4">
						<p><span>Address:</span> Rue Almoqawama Imm. B Agadir, Maroc</p>
					</div>
				</div>
				<div class="col-md-3 d-flex">
					<div class="info bg-white p-4">
						<p><span>Phone:</span> <a href="tel://1234567920">+212 6 00 00 00 00</a></p>
					</div>
				</div>
				<div class="col-md-3 d-flex">
					<div class="info bg-white p-4">
						<p><span>Email:</span> <a href="mailto:info@yoursite.com">info@mysweater.com</a></p>
					</div>
				</div>
				<div class="col-md-3 d-flex">
					<div class="info bg-white p-4">
						<p><span>Website</span> <a href="#">mysweater.com</a></p>
					</div>
				</div>
			</div>
			<div class="row block-9">
				<div class="col-md-6 order-md-last d-flex">
					<form action="" method="POST" class="bg-white p-5 contact-form">
						<div class="form-group">
							<input class="form-control" name="nom" placeholder="Notre nom" type="text" required>
						</div>
						<div class="form-group">
							<input class="form-control" name="email" placeholder="Votre Email" type="text" required>
						</div>
						<div class="form-group">
							<textarea class="form-control" cols="30" id="" name="message" placeholder="Message" rows="7" required></textarea>
						</div>
						<div class="form-group">
							<input class="btn btn-primary py-3 px-5" name="envoyer-msg" type="submit" value="Envoyer">
						</div>
					</form>
				</div>
				<div class="col-md-6 d-flex">
					<div>
						<img src="images/logo.png" style="display: block; margin: 0 auto" width="83%" height="80%" alt="">
					</div>
				</div>
			</div>
		</div>
	</section>
  <?php require 'inc/footer.php'; ?>
  <?php require 'inc/foot-tags.php'; ?>
</body>
</html>
