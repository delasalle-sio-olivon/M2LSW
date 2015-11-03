<?php
	// Projet Réservations M2L - version web mobile
	// Fonction de la vue VueDemanderMdp.php : visualiser la vue de demande d'envoi d'un nouveau mot de passe
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
				<a href="index.php?action=Menu">Retour</a>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Confirmer réservation</h4>
				<form name="form1" id="form1" action="index.php?action=ConfirmerReservation" method="post">
					<div data-role="fieldcontain" class="ui-hide-label">
						<input type="number" name="numero" id="numero" placeholder="Entrez votre N° de réservation" value="" >
					</div>

					<div data-role="fieldcontain">
						<input type="submit" name="confirmerReservation" id=""ConfirmerReservation"" value="Confirmer la réservation">
					</div>
				</form>
			</div>
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeFooter; ?>">
				<h4><?php echo $msgFooter; ?></h4>
			</div>
		</div>
	</body>