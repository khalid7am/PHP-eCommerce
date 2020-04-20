<div class="py-1 bg-black">
	<div class="container">
		<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
			<div class="col-lg-12 d-block">
				<div class="row d-flex">
					<div class="col-md pr-4 d-flex topper align-items-center">
						<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						<span class="text">+212 6 00 00 00 00</span>
					</div>
					<div class="col-md pr-4 d-flex topper align-items-center">
						<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
						<span class="text">info@mysweater.com</span>
					</div>
					<div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
						<span class="text">Livraison 3-5 jours ouvrables et retours gratuits</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	<div class="container">
		<a class="navbar-brand" href="index">My Sweater</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="oi oi-menu"></span> Menu
		</button>
		<div class="collapse navbar-collapse" id="ftco-nav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active"><a href="index" class="nav-link">Accueil</a></li>
				<li class="nav-item dropdown">
					<a class="nav-link" href="produits">Produits</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link" href="Rapport-MySweater.pdf" download>Rapport</a>
				</li>
				<li class="nav-item"><a href="contact" class="nav-link">Contact</a></li>
				<?php if(isset($_SESSION['client_id'])){ ?>
				
				<li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bonjour, <?php echo $_SESSION['client_nom'] ?></a>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
						<a class="dropdown-item" href="profile">Profil</a>
						<a class="dropdown-item" href="inc/deconnexion">Déconnexion</a>
					</div>
				</li>
					
				<?php } else {?>
				<li class="nav-item"><a href="inscrire" class="nav-link">S'inscrire</a></li>
				<li class="nav-item"><a href="connexion" class="nav-link">Connexion</a></li>
				<?php }?>
				<li class="nav-item cta cta-colored"><a href="panier" class="nav-link"><span class="icon-shopping_cart"></span>[<?php if(isset($_SESSION['client_id'])) echo nombreProduits($_SESSION['client_id'], $db); else echo "0"; ?>]</a></li>
			</ul>
		</div>
	</div>
</nav>
