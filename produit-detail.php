<?php
	require 'inc/panierController.php';

	//rvérifier si l'id du produit existe dans l'url ou pas!
	$idp = isset($_GET['idp'])? $_GET['idp'] : header('Location: produits');
	//récupérer les informations du produit depuis la base de données
	$query = $db->prepare("SELECT * FROM produits WHERE id='$idp'");
	$query->execute();
	$produit = $query->fetch();

	//récupérer les commentaires depuis la base de données
	$query = $db->prepare("SELECT * FROM commentaires WHERE idProduit='$idp'");
	$query->execute();
	$commentaires = $query->fetchAll(PDO::FETCH_ASSOC);

	//récupérer le nombre de commentaires sur le produit
	$sql = "SELECT COUNT(id) AS num FROM commentaires WHERE idProduit = :idp";
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':idp', $idp);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$nbrCommantaires = $row['num'];

	//ajouter un commentaire
	if(isset($_POST['ajouter-commentaire']) && !empty($_POST['ajouter-commentaire']))
	{
		//récupérer et valider le commentaire
		$commentaire = trim(htmlspecialchars($_POST['commentaire']));
		$date = date("Y-m-d h:i:s");

		$data = [
			'idClient' => $_SESSION['client_id'],
			'commentaire' => $commentaire,
			'idProduit' => $idp,
			'date' => $date,
		];

		$sql = "INSERT INTO commentaires (idClient, commentaire, idProduit, date) VALUES (:idClient, :commentaire, :idProduit, :date)";
		$stat= $db->prepare($sql);
		if($stat->execute($data)) {
			header("Refresh:0");
      }
	}

	//cette fonction pour récupérer le nom et prénom de client
	function clientNomComplet($idc, $db)
	{
		$sql = "SELECT * FROM clients WHERE id = :idc";
		$stmt = $db->prepare($sql);    
		$stmt->bindValue(':idc', $idc);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
			
		return $row['nom'] . " " . $row['prenom'];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $produit['libelle'] ?> | MySweater</title>
	<?php require 'inc/head-tags.php'; ?>
</head>
<body class="goto-here">
	<?php require 'inc/header.php'; ?>
	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index">Accueil</a></span> <span class="mr-2"><a href="index.html">Produit</a></span> <span>détail du produit</span></p>
					<h1 class="mb-0 bread">détail du produit</h1>
				</div>
			</div>
		</div>
	</div>
	<section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 mb-5 ftco-animate">
					<a class="image-popup" href="images/menu-2.jpg"><img alt="Colorlib Template" class="img-fluid" src="images/<?php echo $produit['image'] ?>.jpg"></a>
				</div>
				<div class="col-lg-6 product-details pl-md-5 ftco-animate">
					<h3><?php echo $produit['libelle'] ?></h3>
					<div class="rating d-flex">
						<p class="text-left mr-4"><a class="mr-2" href="#">5.0</a> <a href="#"><span class="ion-ios-star-outline"></span></a> <a href="#"><span class="ion-ios-star-outline"></span></a> <a href="#"><span class="ion-ios-star-outline"></span></a> <a href="#"><span class="ion-ios-star-outline"></span></a> <a href="#"><span class="ion-ios-star-outline"></span></a></p>
						<p class="text-left mr-4"><a class="mr-2" href="#" style="color: #000;">100 <span style="color: #bbb;">Évaluation</span></a></p>
						<p class="text-left"><a class="mr-2" href="#" style="color: #000;">500 <span style="color: #bbb;">Vendue</span></a></p>
					</div>
					<p class="price"><span><?php echo $produit['prix'] ?>.00 DHs</span></p>
					<p><?php echo $produit['description'] ?></p>
					<div class="row mt-4">
						<div class="col-md-6">
							<div class="form-group d-flex">
								<div class="select-wrap">
									<div class="icon">
										<span class="ion-ios-arrow-down"></span>
									</div><select class="form-control" id="" name="">
										<option value="">
											S
										</option>
										<option value="">
											M
										</option>
										<option value="">
											L
										</option>
										<option value="">
											XL
										</option>
									</select>
								</div>
							</div>
						</div>
						<div class="w-100"></div>
						<div class="input-group col-md-6 d-flex mb-3">
							<span class="input-group-btn mr-2"><button class="quantity-left-minus btn" data-field="" data-type="minus" type="button"><span class="input-group-btn mr-2"><i class="ion-ios-remove"></i></span></button></span> <input class="form-control input-number" id="quantity" max="100" min="1" name="quantity" type="text" value="1"> <span class="input-group-btn ml-2"><button class="quantity-right-plus btn" data-field="" data-type="plus" type="button"><span class="input-group-btn ml-2"><i class="ion-ios-add"></i></span></button></span>
						</div>
						<div class="w-100"></div>
						<div class="col-md-12">
							<p style="color: #000;"><?php echo $produit['quantite'] ?> pièce disponible</p>
						</div>
					</div>
					<p><a class="btn btn-black py-3 px-5" href="panier?action=ajouter&amp;idp=<?php echo $produit['id'] ?>&amp;q=1">Ajouter au panier</a></p>
				</div>
			</div>
		</div>
	</section>
	<section class="ftco-section bg-light">
		<div class="container">
			<div class="pt-5 mt-5">
				<h3 class="mb-5"><?php echo $nbrCommantaires ?> Commentaires</h3>
				<ul class="comment-list">
					<?php foreach ($commentaires as $commentaire) { ?>
					<li class="comment">
						<div class="vcard bio"><img alt="Image placeholder" src="images/client.png"></div>
						<div class="comment-body">
							<h3><?php echo clientNomComplet($commentaire['idClient'], $db) ?></h3>
							<div class="meta"><?php echo $commentaire['date'] ?></div>
							<p><?php echo $commentaire['commentaire'] ?></p>
						</div>
					</li>
					<?php } ?>
				</ul>
				<div class="comment-form-wrap pt-5">
					<h3 class="mb-5">Laissez un commentaire</h3>
					<?php if(!isset($_SESSION['client_id'])){ ?>
						<div class="row justify-content-center">
							<a class="btn btn-primary py-3 px-4" href="connexion">S'identifer</a>
						</div>
					<?php } else { ?>
						<form action="" method="POST" class="p-5 bg-light">
							<div class="form-group">
								<label for="commentaire">Commentaire :</label> 
								<textarea class="form-control" cols="30" id="commentaire" name="commentaire" rows="5"></textarea>
							</div>
							<div class="form-group">
								<input class="btn py-3 px-4 btn-primary" name="ajouter-commentaire" type="submit" value="Poster le commentaire">
							</div>
						</form>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
	<?php require 'inc/footer.php'; ?>
	<?php require 'inc/foot-tags.php'; ?>
	<script>
	       $(document).ready(function(){

	       var quantitiy=0;
	          $('.quantity-right-plus').click(function(e){
	               e.preventDefault();
	               var quantity = parseInt($('#quantity').val());              
	               $('#quantity').val(quantity + 1);               
	           });

	            $('.quantity-left-minus').click(function(e){
	               e.preventDefault();
	               var quantity = parseInt($('#quantity').val());
	               if(quantity>0){
	                   $('#quantity').val(quantity - 1);
	               }
	           });
	       });
	</script>
</body>
</html>