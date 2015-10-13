<?php
	// Projet Réservations M2L - version web mobile
	// Fonction de la vue VueConsulterReservations.php : visualiser les reservations
	// cette vue est appelée par le lien "index.php?action=Menu", sans passer par un contôleur
	// la barre d'entête possède un lien de déconnexion permettant de retourner à la page de connexion
	// Ecrit le 12/10/2015 par Jim
?>
<!doctype html>
<html>
	<head>
		<?php include_once ('vues/head.php'); ?>
	</head> 
	<body>
		<div data-role="page">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>M2L-GRR</h4>
				<a href="index.php?action=Deconnecter">Déconnexion</a>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 20px; margin-bottom: 20px;">Utilisateur : <?php echo $nom; ?></h4>
				<ul data-role="listview" data-inset="true">
					<?php foreach($listeRes as $res){ ?>
						<li>
						<h5>Réservation n°<?php echo $res->getId()?></h5>
						<p>Passée le <?php echo $res->getTimestamp()?></p>
						<p>Début : <?php echo $res->getStart_time()?></p>
						<p>Fin : <?php echo $res->getStart_end()?></p>
						<p>Salle : <?php echo $res->getStart_end()?></p>
						<p>Fin <?php echo $res->getStart_end()?></p>
						<p>Etat <?php if($res->getStatus()==4)echo "En attente"; else echo "Confirmée"?></p>
						<h5>Digicode <?php echo $res->getDigicode() ?></h5>
						</li>
					<?php } ?>
				</ul>
				
				<?php if($debug == true) {
					echo "<p>SESSION['nom'] = " . $_SESSION['nom'] . "</p>";
					echo "<p>SESSION['mdp'] = " . $_SESSION['mdp'] . "</p>";
					echo "<p>SESSION['niveauUtilisateur'] = " . $_SESSION['niveauUtilisateur'] . "</p>";
				} ?>
				
			</div>
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal; ?>">
				<h4><?php $msgFooter?></h4>
			</div>
		</div>
	</body>
</html>