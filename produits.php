<?php
	require 'inc/panierController.php';

	//récupérer tous les produits depuis la base de données
	$query = $db->prepare("SELECT * FROM produits");
	$query->execute();
	$produits = $query->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Produits | MySweater</title>
	<?php require 'inc/head-tags.php'; ?>
</head>
<body class="goto-here">
	<?php require 'inc/header.php'; ?>
	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index">Accueil</a></span> <span>Produits</span></p>
					<h1 class="mb-0 bread">COLLECTION CHEMISES</h1>
				</div>
			</div>
		</div>
	</div>
	<section class="ftco-section bg-light">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-lg-12 order-md-last">
					<div class="row">
						<?php
						if (is_array($produits) || is_object($produits))
						{
							foreach ($produits as $produit) {
						?>
						<div class="col-sm-6 col-md-6 col-lg-4 ftco-animate">
							<div class="product">
								<a class="img-prod" href="produit-detail?idp=<?php echo $produit['id'] ?>"><img alt="Colorlib Template" class="img-fluid" src="images/<?php echo $produit['image'] ?>.jpg">
								<div class="overlay"></div></a>
								<div class="text py-3 px-3">
									<h3><a href="produit-detail"><?php echo $produit['libelle'] ?></a></h3>
									<div class="d-flex">
										<div class="pricing">
											<p class="price"><span class="price-sale"><?php echo $produit['prix'] ?>.00 DHs</span></p>
										</div>
										<div class="rating">
											<p class="text-right"><a href="#"><span class="ion-ios-star-outline"></span></a> <a href="#"><span class="ion-ios-star-outline"></span></a> <a href="#"><span class="ion-ios-star-outline"></span></a> <a href="#"><span class="ion-ios-star-outline"></span></a> <a href="#"><span class="ion-ios-star-outline"></span></a></p>
										</div>
									</div>
									<p class="bottom-area d-flex px-3"><a class="add-to-cart text-center py-2 mr-1" href="panier?action=ajouter&amp;idp=<?php echo $produit['id'] ?>&amp;q=1" ><span>Ajouter au panier <i class="ion-ios-add ml-1"></i></span></a> <a class="buy-now text-center py-2" href="produit-detail?idp=<?php echo $produit['id'] ?>">Acheter<span><i class="ion-ios-cart ml-1"></i></span></a></p>
								</div>
							</div>
						</div>
						<?php }} ?>
					</div>
					<div class="row mt-5">
						<div class="col text-center">
							<div class="block-27">
								<ul>
									<li>
										<a href="#">&lt;</a>
									</li>
									<li class="active"><span>1</span></li>
									<li>
										<a href="#">2</a>
									</li>
									<li>
										<a href="#">3</a>
									</li>
									<li>
										<a href="#">4</a>
									</li>
									<li>
										<a href="#">5</a>
									</li>
									<li>
										<a href="#">&gt;</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php require 'inc/footer.php'; ?>
	<?php require 'inc/foot-tags.php'; ?>
</body>
</html>